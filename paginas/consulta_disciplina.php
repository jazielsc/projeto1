<?php 
	session_start();

	require_once("../boletim/scripts/conecta.php");
		
	/* CDIGO PARA ORDENAR A TABELA PELO CABEALHO CLICADO */
	if(!isset($_GET['ordem'])){
		$ordem = 'nome';
	}
	else{
		switch($_GET['ordem']){
			case 0: $ordem = 'cod_disciplina'; break;
			case 1: $ordem = 'disciplina.nome'; break;
			case 2: $ordem = 'professor.2_'; break;
			case 3: $ordem = 'turma.1_'; break;
		}
	}
	
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="../css/estilo.css" />
	</head>
	<body>
		<div class="corpo">
			<?php  require_once('../partes/menu_login.php');?>	
				<div class="lista_selecao" style="position: relative; width: 730px; height:750px; top: 0px; left: 50%; margin-left: -365px;">
					<table id="box-table-a">
						<thead>
							<tr>
								<th scope="col" style="width: 40px;"><a href="cadastro_disciplina.php?ordem=0">ID</a></th>
								<th scope="col" style="width: 200px;"><a href="cadastro_disciplina.php?ordem=1">Nome</a></th>
								<th scope="col" style="width: 200px;"><a href="cadastro_disciplina.php?ordem=2">Professor</a></th>
								<th scope="col" style="width: 200px;"><a href="cadastro_disciplina.php?ordem=3">Turma</a></th>
								<th scope="col" style="width: 60px;"><a>Excluir</a></th>
							</tr>
						</thead>
						<tbody>
						<?php 
							/* IMPRESSO DA LISTAGEM DE CURSOS */
							$k = 1;
							$query_grid = mysql_query("SELECT cod_disciplina, disciplina.nome, professor.2_ as pnome, turma.1_ as tnome, turma.cod_curso FROM disciplina, professor, turma WHERE turma.cod_instituicao = ".$_SESSION['id_instituicao']." AND professor.cod_professor = disciplina.cod_professor AND turma.cod_turma = disciplina.cod_turma ORDER BY $ordem") or die ("Error na consulta");
							while ($result = mysql_fetch_array($query_grid)){
						?>
							<tr>
								<td><a href="cadastro_disciplina.php?acao=2&id=<?php echo $result[0];?>&curso=<?php echo $result[4];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $k++;?></a></td>
								<td><a href="cadastro_disciplina.php?acao=2&id=<?php echo $result[0];?>&curso=<?php echo $result[4];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[1];?></a></td>
								<td><a href="cadastro_disciplina.php?acao=2&id=<?php echo $result[0];?>&curso=<?php echo $result[4];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[2];?></a></td>
								<td><a href="cadastro_disciplina.php?acao=2&id=<?php echo $result[0];?>&curso=<?php echo $result[4];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[3];?></a></td>
								<form name="f_exclusao" action="/boletim/scripts/objeto_disciplina.php" method="POST">
									<input type="hidden" name="codigo" value="<?php echo $result[0];?>" />
									<input type="hidden" name="acao" value="delete_disciplina" />
									<td style="text-align: center;"><input type="submit" value="-" style="display: block; width: 40px; height: 18px;"/></td>
								</form>
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