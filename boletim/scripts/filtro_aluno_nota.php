<?php
session_start();
$cod_instituicao = (int) $_SESSION['id_instituicao'];
$cod_curso = (int) $_POST['cod_curso'];
$cod_turma = (int) $_POST['cod_turma'];

include("conecta.php");

$opcao = $_POST['opcao'];

$query_cons = mysql_query("SELECT cod_aluno, aluno.nome FROM aluno, turma WHERE turma.cod_curso = '$cod_curso' AND turma.cod_turma = '$cod_turma' AND aluno.cod_instituicao = '$cod_instituicao' AND cod_status = 1 AND aluno.nome LIKE '$opcao%' ORDER BY aluno.nome",$conn) or die(mysql_error());
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