<?php

session_start();

$cod_professor = $_SESSION['id_aluno_professor'];

include("conecta.php");


// vari�vel do flash
$cod_disciplina = $_POST['cod_disciplina'];

if ($cod_disciplina != "") {

$query = mysql_query("SELECT cod_avaliacao, nome FROM avaliacao WHERE cod_disciplina = '$cod_disciplina' AND cod_professor = '$cod_professor' ORDER BY nome",$conn) or die("Error na consulta");
$indice=0;

while ($result = mysql_fetch_row($query)) {
	
	echo "&cod$indice=$result[0]";
	echo "&nome$indice=$result[1]";
	
	$indice++;
}

} else

echo "ERRO";


?>