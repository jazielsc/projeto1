<?php

include("conecta.php");

if(isset($_POST['cod_professor'])){

$cod_professor = $_POST['cod_professor'];

$query2 = mysql_query("SELECT cod_instituicao FROM professor WHERE cod_professor = '$cod_professor' ORDER BY nome",$conn) or die("Error na consulta");


$resultado = mysql_fetch_array($query2);

$cod_instituicao = $resultado[0];

} else {

// vari�vel do flash
$cod_instituicao = $_POST['cod_instituicao'];
}
if ($cod_instituicao != "") {

$query = mysql_query("SELECT cod_aluno, nome FROM aluno WHERE cod_instituicao = '$cod_instituicao' AND cod_status = 1 ORDER BY nome",$conn) or die("Error na consulta");
$indice=0;

while ($result = mysql_fetch_row($query)) {
	
	echo "&cod$indice=$result[0]";
	echo "&nome$indice=$result[1]";
	
	$indice++;
}



} else

echo "ERRO";


?>