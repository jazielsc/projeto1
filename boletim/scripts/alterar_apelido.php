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

$txt_usuario = $_POST['txt_usuario'];

if ($cod != ""){ // testando se veio algum valor do flash

$query_select = mysql_query("SELECT usuario_login FROM usuario WHERE usuario_login = '$txt_usuario'");

$quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                echo"&resultado=NAO";
                echo "&resultado=login em uso, por favor escolha outro!";
            } else
                 {

// alterando registros
$query = mysql_query("UPDATE usuario SET usuario_login = '$txt_usuario' WHERE cod_usuario = '$cod'",$conn) or die("Error na altera��o");

echo "&resultado=Cadastro realizado com Sucesso!";

mysql_close();
                 }
}else // caso n tenha recebido valor do flash
echo"&resultado=vazio"; 


?>

