<?php

// arquivo que preenche o combo rua no flash no formul�rio de cadastro de contratos

// evita que arquivo fique no cache 
	
    header("Content-type: text/html; charset=iso-8859-1");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");



include("conecta.php"); // arquivo de conexao

// vari�vel vinda do flash com o c�digo do bairro

$cod_bairro = $_POST['cod_bairro'];  
	
// consulta para retornar as informa��es das ruas

$query_autor = mysql_query("SELECT rua_id, rua_nome FROM rua WHERE bairro_id = '$cod_bairro' ORDER BY rua_nome",$conn);

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