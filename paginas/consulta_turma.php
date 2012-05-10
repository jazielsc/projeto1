<?php 
	session_start();
	if (!(isset($_SESSION['id_instituicao']) != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'])){
		header("Location: /index.php");
	}
	require_once("../boletim/scripts/conecta.php");
		
	/* CDIGO PARA ORDENAR A TABELA PELO CABEALHO CLICADO */
	if(!isset($_GET['ordem'])){
		$ordem = '1_';
	}
	else{
		switch($_GET['ordem']){
			case 0: $ordem = 'cod_turma'; break;
			case 1: $ordem = '1_'; break;
			case 2: $ordem = 'curso.nome'; break;
			case 3: $ordem = 'turno'; break;
		}
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
				<div class="lista_selecao" style="position: relative; width: 730px; height:750px; top: 0px; left: 50%; margin-left: -365px;">
					<table id="box-table-a">
						<thead>
							<tr>
								<th scope="col" style="width: 40px;"><a href="cadastro_turma.php?ordem=0">ID</a></th>
								<th scope="col" style="width: 210px;"><a href="cadastro_turma.php?ordem=1">Nome</a></th>
								<th scope="col" style="width: 210px;"><a href="cadastro_turma.php?ordem=2">Curso</a></th>
								<th scope="col" style="width: 100px;"><a href="cadastro_turma.php?ordem=3">Turno</a></th>
								<th scope="col" style="width: 20px;"><a>Excluir</a></th>
							</tr>
						</thead>
						<tbody>
						<?php 
							/* IMPRESSO DA LISTAGEM DE CURSOS */
							$k = 1;
							$query_grid = mysql_query("SELECT cod_turma, turma.1_, curso.nome as curso_nome, turno FROM turma, curso WHERE turma.cod_curso = curso.cod_curso AND turma.cod_instituicao = ".$_SESSION['id_instituicao']." ORDER BY $ordem") or die ("Erro na consulta");
							while ($result = mysql_fetch_array($query_grid)){
						?>
							<tr>
								<td><a href="cadastro_turma.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php =$k++;?></a></td>
								<td><a href="cadastro_turma.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[1];?></a></td>
								<td><a href="cadastro_turma.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[2];?></a></td>
								<td><a href="cadastro_turma.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[3];?></a></td>
								<form name="f_exclusao" action="/boletim/scripts/objeto_turma.php" method="POST">
									<input type="hidden" name="codigo" value="<?php echo $result[0];?>" />
									<input type="hidden" name="acao" value="delete_turma" />
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