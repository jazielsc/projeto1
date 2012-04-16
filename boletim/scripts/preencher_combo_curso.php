<?php

session_start();
$cod_instituicao = (int) $_SESSION['id_instituicao'];

include("conecta.php");

// vari�vel do flash



if ($cod_instituicao != "") {

$query = mysql_query("SELECT cod_curso, nome FROM curso WHERE cod_instituicao = '$cod_instituicao' ORDER BY nome",$conn) or die("Error na consulta");
$indice=0;

while ($result = mysql_fetch_row($query)) {
	
	echo "&cod$indice=$result[0]";
	echo "&nome$indice=$result[1]";
	
	$indice++;
}

} else

echo "ERRO";


?>