<?php
session_start();
$cod_instituicao = (int) $_SESSION['id_instituicao'];
include("conecta.php");

//EXTRACT(YEAR FROM data) as ANO 
//DATE_FORMAT(data, '%d/%m/%Y') AS data


$opcao = $_POST['opcao'];

$query_cons = mysql_query("SELECT cod_turma, nome, EXTRACT(YEAR FROM data) as ANO FROM turma WHERE cod_instituicao = '$cod_instituicao' AND nome LIKE '$opcao%' ORDER BY data DESC, nome",$conn);
$i=0;

echo "&opcao=$opcao";

//Preenche o combo tabloide
while ($result_cons = mysql_fetch_array($query_cons)){
	echo "&codigo$i=$result_cons[0]";
	echo "&nome$i=$result_cons[1] - $result_cons[2]";
	$i++;
	}
echo "&mensagemtemas=OK";
echo "&opcao=$opcao";	
mysql_close();
?>