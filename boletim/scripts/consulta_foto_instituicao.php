<?php

session_start();
$cod_instituicao = (int) $_SESSION['id_instituicao'];

// evita que arquivo fique no cache 
	
    header("Content-type: text/html; charset=iso-8859-1");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

// arquivo de consulta do combo bairro no flash referente ao cadastro de contratos

include("conecta.php"); // arquivo de conexao

	
// consulta para retornar as informa��es dos bairros

$query_autor = mysql_query("SELECT foto, nome FROM instituicao WHERE cod_instituicao = '$cod_instituicao'",$conn);

// verificando se a query retornou algum valor
$quant = mysql_num_rows($query_autor);

// se retornou ent�o preenche os dados no flash

if ($quant > 0){

$result_autor = mysql_fetch_array($query_autor);
    
	echo "&foto=$result_autor[0]";
        echo "&nome=$result_autor[1]";
	 
		
	echo "&mensagem=OK";
} else
    echo "&mensagem=nao";
	
	
mysql_close();
?>