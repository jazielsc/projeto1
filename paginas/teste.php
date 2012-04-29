<?php 
	//ver possibilidade de dar um include que verifique as permissoes
	session_start();
	if (!(isset($_SESSION['id_instituicao']) != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'])){
		header("Location: /index.php");
	}
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="../css/estilo.css" />
		<script language="javascript" type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/jquery.tablesorter.min.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/funcoes.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
	<div class="corpo">
	  <?php  require_once('../partes/menu_login.php');?>
	  <div class="conteudo">
	   <embed width="100%" height="100%" name="plugin" src="../boletim/notas.swf" type="application/x-shockwave-flash">
	  </div>
  </div>
</body>
</html>