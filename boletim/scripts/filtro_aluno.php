<?php
session_start();
$cod_instituicao = (int) $_SESSION['id_instituicao'];
include("conecta.php");

$opcao = $_POST['opcao'];

$query_cons = mysql_query("SELECT cod_aluno, nome FROM aluno WHERE cod_instituicao = '$cod_instituicao' AND cod_status = 1 AND nome LIKE '$opcao%' ORDER BY nome",$conn);
$i=0;

echo "&opcao=$opcao";

//Preenche o combo tabloide
while ($result_cons = mysql_fetch_array($query_cons)){
	echo "&codigo$i=$result_cons[0]";
	echo "&nome$i=$result_cons[1]";
	$i++;
	}
echo "&mensagemtemas=OK";
echo "&opcao=$opcao";	
mysql_close();
?>