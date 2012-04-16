<?php

include("conecta.php");


// vari�vel do flash
$cod_turma = $_POST['cod_turma'];
$cod_curso = $_POST['cod_curso'];

if ($cod_turma != "") {

$query = mysql_query("SELECT cod_disciplina, nome FROM disciplina WHERE cod_turma = '$cod_turma' ORDER BY nome",$conn) or die("Error na consulta");
$indice=0;

while ($result = mysql_fetch_row($query)) {
	
	echo "&cod$indice=$result[0]";
	echo "&nome$indice=$result[1]";
	
	$indice++;
}

}else if ($cod_curso != ""){


    $query = mysql_query("SELECT cod_disciplina, nome FROM disciplina WHERE cod_curso = '$cod_curso' ORDER BY nome",$conn) or die("Error na consulta");
$indice=0;

while ($result = mysql_fetch_row($query)) {

	echo "&cod$indice=$result[0]";
	echo "&nome$indice=$result[1]";

	$indice++;
}

}

 else

echo "ERRO";


?>