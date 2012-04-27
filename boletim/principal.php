<?php

session_start();

require_once("verifica.php");

if($_SESSION["permissao"] > 4)
{ 
    echo "Você não tem permissão para entrar nessa Área!"; 
    exit; 
} 

require_once("scripts/logado.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Boletim FLEX</title>


<style type="text/css">
<!--
body {
	background-color: #E6E6E6;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	border:0px;
}
-->
</style>
<script type="text/javascript" src="app/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="app/js/jquery.form.js"></script>
<script type="text/javascript" src="app/js/global.js"></script>

<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#cde6ed">
<!--url's used in the movie-->
<div class="envolve" align="center">
	<div id="corpo" align="left">
		<div id="topo" >
			<table id="topo_tabela">
				<tr height="49" valign="bottom">
					<td> </td>
					<td width="92" height="49">&nbsp;</td>
					<td width="261"><?php echo $area_login ?></td>
				</tr>	
				<tr>
					<td> </td>
					<td colspan="2">
					<?php echo $instituicao  ?>
					</td>
				</tr>
			</table>
		</div>
		<div id="topo_inferior">
			<table width="764">
				<tr valign="middle">
					<td width="35">&nbsp;</td>
					<td width="112"><a href="principal.php">Inicio</a></td>
					<td width="90"><a href="logoff.php">Sair</a></td>
					<td width="311"><strong>Usuarios: </strong><?php echo $nome?></td>
					<td width="192"><?php echo date("d\ \d\e\ F\ \d\e\ Y - h:i:s") ?></td>
				</tr>	
		  </table>
		</div>
		<div id="menu">
		<!-- AKI ENTRARA O MENU CSS -->
		</div>
		<div id="conteudo">
		<!--AKI ENTRA OS SCRIPTS FLASH -->
		
		</div>
	</div>
</div>

</body>
</html>