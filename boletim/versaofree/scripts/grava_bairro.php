<?php

// evita que o script seja armazenado no cache
	header("Content-type: text/html; charset=iso-8859-1");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

include("conecta.php");


$txt_nome_bairro = $_POST['txt_nome_bairro'];
$cod_cidade = $_POST['cod_cidade'];



if ($txt_nome_bairro != ""){


$query_bairro = mysql_query("SELECT * FROM bairro WHERE bairro_nome = '$txt_nome_bairro' AND cidade_id = '$cod_cidade'",$conn) or die ("Error na consulta");

// verificando se a query retornou algum valor
$quant = mysql_num_rows($query_bairro);

// se retornou então preenche os dados no flash
if ($quant > 0){
echo "&resultado=NAO";
}
else{


$query = mysql_query("INSERT INTO bairro VALUES(NULL,'$txt_nome_bairro','$cod_cidade')",$conn) or die("Error na inclusão");
echo "&resultado=ok";


$query_grid = mysql_query("SELECT * FROM bairro ORDER BY  bairro_nome",$conn) or die ("Error na consulta");

$i = 0;
$cont = 0;
while ($result = mysql_fetch_array($query_grid)){
    
		
	echo "&codigo$i=$result[0]";
	echo "&nome$i=$result[1]";
			
$i++;



$query_cid = mysql_query("SELECT cidade_nome FROM cidade WHERE cidade_id = '$result[2]'",$conn) or die ("Error na consulta");

while ($resultado = mysql_fetch_array($query_cid)){

echo "&cidade$cont=$resultado[0]";
$cont++;

}


} // fim primeiro while


// consulta para selecionar o registro cadastrado no combo quando o cadastro for feito dentro do cadastro de contratos
$query_combo = mysql_query("SELECT bairro_id, bairro_nome FROM bairro ORDER BY bairro_id DESC LIMIT 0,1",$conn) or die ("Error na consulta");

while ($resultado = mysql_fetch_array($query_combo)){
    
		
	echo "&codbairro=$resultado[0]";
	echo "&nomebairro=$resultado[1]";

}

mysql_close();
} // fim do else

}else
echo "vazio";
?>