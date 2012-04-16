<?php
session_start();
$cod_instituicao = (int) $_SESSION['id_instituicao'];
include("conecta.php");

$opcao = $_POST['opcao'];

$query_cons = mysql_query("SELECT cod_disciplina, disciplina.nome, curso.nome, turma.nome, EXTRACT(YEAR FROM data) as ANO  FROM disciplina, curso, turma WHERE curso.cod_instituicao = '$cod_instituicao' AND curso.cod_curso = disciplina.cod_curso AND turma.cod_turma = disciplina.cod_turma AND turma.cod_curso = curso.cod_curso AND disciplina.nome LIKE '$opcao%' ORDER BY disciplina.nome",$conn);
$i=0;

echo "&opcao=$opcao";

//Preenche o combo tabloide
while ($result_cons = mysql_fetch_array($query_cons)){
	echo "&codigo$i=$result_cons[0]";
	echo "&nome$i=$result_cons[1] - $result_cons[2] - $result_cons[3] - $result_cons[4]";
	$i++;
	}
echo "&mensagemtemas=OK";
echo "&opcao=$opcao";	
mysql_close();
?>