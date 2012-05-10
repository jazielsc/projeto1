<?php 
	session_start();

	require_once("../boletim/scripts/conecta.php");
		
	if(isset($_GET['acao'])){
		$acao = $_GET['acao'];
	}
	else {
		$acao = 0;
	}
	/* CDIGO PARA ORDENAR A TABELA PELO CABEALHO CLICADO */
	if(!isset($_GET['ordem'])){
		$ordem = 'disciplina.nome';
	}
	else{
		switch($_GET['ordem']){
			case 0: $ordem = 'disciplina.cod_disciplina'; break;
			case 1: $ordem = 'disciplina.nome'; break;
			case 2: $ordem = 'curso.nome'; break;
			case 3: $ordem = 'turma.1_'; break;
		}
	}
	
	/* CDIGO PARA O CARREGAMENTO DOS CAMPOS CASO SEJA UMA ALTERAO */
	if(isset($_GET['id'])){
		$recupera = mysql_query("SELECT turma.cod_turma, turma.1_, curso.nome as cnome, turma.turno, turma.semestre FROM turma, curso WHERE turma.cod_instituicao = ".$_SESSION['id_instituicao']." AND turma.cod_curso = curso.cod_curso AND turma.cod_turma = ".$_GET['id']) or die ("Error na consulta");
		$result = mysql_fetch_array($recupera);
	}
	else{
		header("Location: consulta_turma_disciplina.php?id=0");
	}
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="../css/estilo.css" />
	</head>
	<body>
		<div class="corpo">
			<?php  require_once('../partes/menu_login.php');?>	
			<div class="conteudo">
				<div class="titulo">
					<img src="../img/Bandeira_consulta_turmas.png" />
				</div>
				<br><br><br><br><br>
				<div style="position: relative; height: 200px; width: 600px; left: 50%; margin-left: -300px; overflow-x: none; overflow-y: scroll; border: 1px solid blue;">
					<center>
						<table>
							<form action="./action/action_cdt.php" method="POST">
							<tr>
								<td class="rotulo">Consulta: </td>
								<td>
									<select name="consulta" class="campo" style="width: 200px;">
										<option selected="selected" value=-1>Selecione a Turma</option>
										<?php 
											$query = mysql_query("SELECT cod_turma, 1_ FROM turma WHERE cod_instituicao = ".$_SESSION['id_instituicao']) or die ("Error na consulta");
											while ($res = mysql_fetch_array($query)){
										?>
										<option value="<?php echo $res[0];?>"><?php echo $res[1];?></option>
										<?php 
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td class="rotulo">Nome: </td>
								<td><input name="nome" disabled="disabled" value="<?php echo $result[1];?>" class="campo" style="width: 400px;"/></td>
							</tr>
							<tr>
								<td class="rotulo">Curso: </td>
								<td><input name="cod_curso" disabled="disabled" value="<?php echo $result[2];?>" class="campo" style="width: 200px;"/></td>
							</tr>
							<tr>
								<td class="rotulo">Turno: </td>
								<td><input name="cod_turno" disabled="disabled" value="<?php echo $result[3];?>" class="campo" style="width: 200px;"/></td>
							</tr>
							<tr>
								<td class="rotulo">Semestre: </td>
								<td><input name="semestre" disabled="disabled" value="<?php echo $result[4];?>" class="campo" style="width: 100px;"/></td>
							</tr>
						</table>
					</center>
			</div>
			<div>
				<center>
					<br>
					<input name="submit" type="submit" value="Consultar" class="botao"/>
					</form>
					<input type="button" onClick="window.open('/boletim/fpdf/imprimir_turma_disciplina.php?cod_turma=<?php echo $_GET['id'];?>')" value="Imprimir Lista" class="botao"/>
				</center>
			</div>
			<div class="lista_selecao" style="width: 730px; height:400px; top: 350px; left: 50%; margin-left: -365px;">
				<table id="box-table-a">
					<thead>
						<tr>
							<th scope="col" style="width: 40px;"><a href="consulta_turma_disciplina.php?ordem=0&acao=-1&id=<?php echo $_GET['id'];?>">ID</a></th>
							<th scope="col" style="width: 230px;"><a href="consulta_turma_disciplina.php?ordem=1&acao=-1&id=<?php echo $_GET['id'];?>">Disciplina</a></th>
							<th scope="col" style="width: 230px;"><a href="consulta_turma_disciplina.php?ordem=2&acao=-1&id=<?php echo $_GET['id'];?>">Curso</a></th>
							<th scope="col" style="width: 230px;"><a href="consulta_turma_disciplina.php?ordem=3&acao=-1&id=<?php echo $_GET['id'];?>">Turma</a></th>
						</tr>
					</thead>
					<tbody>
					<?php 
						/* IMPRESSO DA LISTAGEM DE CURSOS */
						$query_grid = mysql_query("SELECT disciplina.cod_disciplina, disciplina.nome, curso.nome as cnome, turma.1_ as tnome FROM disciplina, curso, turma WHERE curso.cod_instituicao = ".$_SESSION['id_instituicao']." AND disciplina.cod_turma = turma.cod_turma AND curso.cod_curso = turma.cod_curso AND turma.cod_turma = ".$_GET['id']." ORDER BY $ordem") or die ("Error na consulta");
						while ($result = mysql_fetch_array($query_grid)){
					?>
						<tr>
							<td><a href="#" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[0];?></a></td>
							<td><a href="#" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[1];?></a></td>
							<td><a href="#" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[2];?></a></td>
							<td><a href="#" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[3];?></a></td>
						</tr>
					<?php 	
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>