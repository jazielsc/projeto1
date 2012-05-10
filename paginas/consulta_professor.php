<?php 
	session_start();

	require_once("../boletim/scripts/conecta.php");
		
	/* CDIGO PARA ORDENAR A TABELA PELO CABEALHO CLICADO */
	if(!isset($_GET['ordem'])){
		$ordem = '2_';
	}
	else{
		switch($_GET['ordem']){
			case 0: $ordem = 'cod_professor'; break;
			case 1: $ordem = '2_'; break;
			case 2: $ordem = '3_'; break;
			case 3: $ordem = '13_'; break;
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
				<div class="titulo">
					<!--<img src="../img/Bandeira_cadastro_disciplinas.png" />-->
					Consulta de Professor
				</div>
			<div class="lista_selecao" style="position: relative; width: 730px; height:700px; top: 0px; left: 50%; margin-left: -365px;">
				<table id="box-table-a">
					<thead>
						<tr>
							<th scope="col" style="width: 40px;"><a href="cadastro_professor.php?ordem=0">ID</a></th>
							<th scope="col" style="width: 230px;"><a href="cadastro_professor.php?ordem=1">Nome</a></th>
							<th scope="col" style="width: 230px;"><a href="cadastro_professor.php?ordem=2">Email</a></th>
							<th scope="col" style="width: 230px;"><a href="cadastro_professor.php?ordem=3">CPF</a></th>
						</tr>
					</thead>
					<tbody>
					<?php 
						/* IMPRESSO DA LISTAGEM DE CURSOS */
						$k = 1;
						$query_grid = mysql_query("SELECT cod_professor, 2_, 3_, 13_ FROM professor WHERE professor.cod_instituicao = ".$_SESSION['id_instituicao']." AND cod_status = 1 ORDER BY $ordem") or die ("Error na consulta");
						while ($result = mysql_fetch_array($query_grid)){
					?>
						<tr>
							<td><a href="cadastro_professor.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $k++;?></a></td>
							<td><a href="cadastro_professor.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[1];?></a></td>
							<td><a href="cadastro_professor.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[2];?></a></td>
							<td><a href="cadastro_professor.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[3];?></a></td>
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