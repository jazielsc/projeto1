<?php
session_start();

    // evita que o script seja armazenado no cache
	header("Content-type: text/html; charset=iso-8859-1");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

include("conecta.php"); // chamando arquivo de conexao

// valores vindos do flash 

$codigo = $_POST['codigo'];
$cod_status = $_POST['cod_status'];

if ($cod_status != ""){ // testando se veio algum valor do flash

// alterando registros
$query = mysql_query("UPDATE colaborador SET cod_status = '$cod_status' WHERE cod_colaborador = '$codigo'",$conn) or die("Error na altera��o");

echo "&resultado=ok&nada=nada";


mysql_close();

}else{ // caso n tenha recebido valor do flash
echo"&resultado=vazio"; 
}

?>

