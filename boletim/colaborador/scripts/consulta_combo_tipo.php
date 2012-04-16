<?php

// arquivo de consulta do combo cliente no flash referente ao cadastro de despesas

include("conecta.php");
	
// consulta para retornar as informa��es do fornecedor

$query_autor = mysql_query("SELECT cod_tipo, nome FROM tipo ORDER BY nome",$conn);

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