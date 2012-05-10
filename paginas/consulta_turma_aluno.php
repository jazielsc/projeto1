<?php 
	session_start();
	if (!(isset($_SESSION['id_instituicao']) != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'])){
		header("Location: /index.php");
	}
	require_once("../boletim/scripts/conecta.php");
		
	if(isset($_GET['acao'])){
		$acao = $_GET['acao'];
	}
	else {
		$acao = 0;
	}
	/* CDIGO PARA ORDENAR A TABELA PELO CABEALHO CLICADO */
	if(!isset($_GET['ordem'])){
		$ordem = 'aluno.2_nome_completo';
	}
	else{
		switch($_GET['ordem']){
			case 0: $ordem = 'aluno.matricula'; break;
			case 1: $ordem = 'aluno.2_nome_completo'; break;
			case 2: $ordem = 'curso.nome'; break;
		}
	}
	
	/* CDIGO PARA O CARREGAMENTO DOS CAMPOS CASO SEJA UMA ALTERAO */
	if(isset($_GET['id'])){
		$recupera = mysql_query("SELECT turma.cod_turma, turma.1_, curso.nome as cnome, turma.turno, turma.semestre FROM turma, curso WHERE turma.cod_instituicao = ".$_SESSION['id_instituicao']." AND turma.cod_curso = curso.cod_curso AND turma.cod_turma = ".$_GET['id']) or die ("Error na consulta");
		$result = mysql_fetch_array($recupera);
	}
	else{
		header("Location: consulta_turma_aluno.php?id=0");
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr">
	<head>
		<link type="text/css" rel="stylesheet" href="../css/estilo.css" />
	</head>
	<body>
		<div class="corpo">
			<?php  require_once('../partes/menu_login.php');?>	
			<div class="conteudo">
				<div class="titulo">
					<img src="../img/Bandeira_consulta_turmas_aluno.png" />
				</div>
				<br><br><br><br><br>
				<div style="position: relative; height: 200px; width: 600px; left: 50%; margin-left: -300px; overflow-x: none; overflow-y: scroll; border: 1px solid blue;">
					<center>
						<table>
							<form action="./action/action_cat.php" method="POST">
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
					<input type="button" onClick="window.open('/boletim/fpdf/imprimir_turma_aluno.php?cod_turma=<?php echo $_GET['id'];?>')" value="Imprimir Lista" class="botao"/>
				</center>
			</div>
			<div class="lista_selecao" style="width: 730px; height:400px; top: 350px; left: 50%; margin-left: -365px;">
				<table id="box-table-a">
					<thead>
						<tr>
							<th scope="col" style="width: 80px;"><a href="consulta_turma_aluno.php?ordem=0&acao=-1&id=<?php echo $_GET['id'];?>">Matricula</a></th>
							<th scope="col" style="width: 280px;"><a href="consulta_turma_aluno.php?ordem=1&acao=-1&id=<?php echo $_GET['id'];?>">Aluno</a></th>
							<th scope="col" style="width: 230px;"><a href="consulta_turma_aluno.php?ordem=2&acao=-1&id=<?php echo $_GET['id'];?>">Curso</a></th>
						</tr>
					</thead>
					<tbody>
					<?php 
						/* IMPRESSO DA LISTAGEM DE CURSOS */
						$query_grid = mysql_query("SELECT DISTINCT aluno.matricula, aluno.2_nome_completo, curso.nome as cnome FROM aluno, disciplina, item2, curso WHERE disciplina.cod_turma = ".$_GET['id']." AND disciplina.cod_disciplina = item2.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND curso.cod_curso = aluno.cod_curso AND aluno.cod_status = 1 ORDER BY $ordem") or die ("Error na consulta");
						while ($result = mysql_fetch_array($query_grid)){
					?>
						<tr>
							<td><a href="#" style=""><?php echo $result[0];?></a></td>
							<td><a href="#" style=""><?php echo $result[1];?></a></td>
							<td><a href="#" style=""><?php echo $result[2];?></a></td>
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