<?php

session_start();

if ($_SESSION['id_instituicao'] == 0)
    Header("Location: ../index.php");

if ($_SESSION['id_instituicao'] == "")
Header("Location: ../index.php");



if ($_SESSION['id_instituicao'] != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'])

Header("Location: principal.php");



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
#Layer1 {
	position:absolute;
	left:50%;
	top:0px;
	margin-left: -383px;
	z-index:1;
	border:0px;

}
-->
</style>

<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="AC_RunActiveContent.js" language="javascript"></script>
</head>
<body bgcolor="#cde6ed">
<!--url's used in the movie-->
<div id="Layer1">
  <script language="javascript">

if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js. In Flash, run \"Apply Active Content Update\" in the Commands menu to copy AC_RunActiveContent.js to the HTML output folder.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0',
			'width', '766',
			'height', '870',
			'src', 'index',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'index',
			'bgcolor', '#FFFFFF',
			'name', 'index',
			'menu', 'true',
			'allowScriptAccess','sameDomain',
			'movie', 'index',
			'salign', ''
			); //end AC code
	}
</script>

</div>


</body>
</html>