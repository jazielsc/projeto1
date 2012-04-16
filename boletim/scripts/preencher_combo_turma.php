<?php

include("conecta.php");



// vari�vel do flash
$cod_curso = $_POST['cod_curso'];

if ($cod_curso != "") {

$query = mysql_query("SELECT cod_turma, nome, EXTRACT(YEAR FROM data) as ANO FROM turma WHERE cod_curso = '$cod_curso' ORDER BY nome",$conn) or die("Error na consulta");
$indice=0;

while ($result = mysql_fetch_row($query)) {
	
	echo "&cod$indice=$result[0]";
	echo "&nome$indice=$result[1] - $result[2]";
	
	$indice++;
}

} else

echo "ERRO";


?>