<?php

// arquivo que preenche o combo bairros no flash no formul�rio de cadastro de contratos

// evita que arquivo fique no cache 
	
    header("Content-type: text/html; charset=iso-8859-1");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

// arquivo de consulta do combo cidades no flash referente ao cadastro de contratos

include("conecta.php"); // arquivo de conexao

// vari�vel vinda do flash com o c�digo da cidade

$cod_cidade = $_POST['cod_cidade'];  
	
// consulta para retornar as informa��es dos bairros

$query_autor = mysql_query("SELECT bairro_id, bairro_nome FROM bairro WHERE cidade_id = '$cod_cidade' ORDER BY bairro_nome",$conn);

// verificando se a query retornou algum valor
$quant = mysql_num_rows($query_autor);

// se retornou ent�o preenche os dados no flash

if ($quant > 0){
$i = 0;
while ($result_autor = mysql_fetch_array($query_autor)){
    
	echo "&cod$i=$result_autor[0]";	
	echo "&nome$i=$result_autor[1]";
	
	$i++;
	} 
		
	echo "&mensagemtemas=OK";
} else
    echo "&mensagemtemas=nao";
	
	
mysql_close();
?>