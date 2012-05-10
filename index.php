<?php
	session_start();
	if (isset($_SESSION['id_instituicao']) != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT']){
		header("Location: paginas/principal.php");
	}
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr">
	<head>
		<title>Boletim Flex</title>
		<link type="text/css" rel="stylesheet" href="./css/estilo.css" />
	</head>
	<body>
		<div class="corpo">
			<?php require_once('partes/menu_logout.php');?>	
			<div class="conteudo">
				<div style="position: absolute; top: 0px; left: 0px; width: 766px; height: 700px; background: url(./img/corpo_index.png) no-repeat;">

				</div>
			</div>
		</div>
	</body>
</html>