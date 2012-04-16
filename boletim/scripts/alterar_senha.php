<?php
session_start();

    // evita que o script seja armazenado no cache
	header("Content-type: text/html; charset=iso-8859-1");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

include("conecta.php"); // chamando arquivo de conexao

// valores vindos do flash 
$cod = $_SESSION['id_usuario'];

$txt_senha = md5($_POST['txt_senha']);
$txt_novasenha = md5($_POST['txt_novasenha']);
$txt_confirmar = md5($_POST['txt_confirmar']);

if ($cod != ""){ // testando se veio algum valor do flash
$query_cidade = mysql_query("SELECT cod_usuario FROM usuario WHERE usuario_pass = '$txt_senha'",$conn) or die ("Error na consulta");

// verificando se a query retornou algum valor
$quant = mysql_num_rows($query_cidade);

// se retornou ent�o preenche os dados no flash
if ($quant < 1){
echo "&resultado=NAO&nada=nada";
}else{
// alterando registros
$query = mysql_query("UPDATE usuario SET usuario_pass = '$txt_novasenha' WHERE cod_usuario = '$cod'",$conn) or die("Error na altera��o");

echo "&resultado=ok&nada=nada";
}

mysql_close();

}else{ // caso n tenha recebido valor do flash
echo"&resultado=vazio"; 
}

?>

