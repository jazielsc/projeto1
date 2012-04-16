<?php

include("conecta.php");


// vari�vel do flash
$cod_turma = $_POST['cod_turma'];
$cod_curso = $_POST['cod_curso'];
$cod_professor = $_POST['cod_professor'];



$query = mysql_query("SELECT cod_disciplina, nome FROM disciplina WHERE cod_professor = '$cod_professor' AND cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' ORDER BY nome",$conn) or die("Error na consulta");
$indice=0;

while ($result = mysql_fetch_row($query)) {
	
	echo "&cod$indice=$result[0]";
	echo "&nome$indice=$result[1]";
	
	$indice++;
}




?>