<?php

// script que insere as informações das cidades no banco de dados
// Desenvolvido por: Leonardo Marinho Capistrano Silva

// evita que o script seja armazenado no cache
	header("Content-type: text/html; charset=iso-8859-1");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

include("conecta.php");  // arquivo de conexao

// variáveis vindas do flash

$txt_nome_cidade = $_POST['txt_nome_cidade'];
$cod_uf = $_POST['cod_uf'];

if ($txt_nome_cidade != ""){ // testa se foi passado algum valor para variável 

// consulta referente a cidades

$query_cidade = mysql_query("SELECT * FROM cidade WHERE cidade_nome = '$txt_nome_cidade' AND cidade_uf = '$cod_uf'",$conn) or die ("Error na consulta");

// verificando se a query retornou algum valor
$quant = mysql_num_rows($query_cidade);

// se retornou então preenche os dados no flash
if ($quant > 0){
echo "&resultado=NAO";
}
else{


// inserindo os valores no banco de dados

$query = mysql_query("INSERT INTO cidade VALUES(NULL,'$cod_uf','$txt_nome_cidade')",$conn) or die("Error na inclusão");
echo "&resultado=ok";



// consulta para inserir os dados no grid do flash após inserir os dados no banco, atualiza o grid
$query_grid = mysql_query("SELECT * FROM cidade ORDER BY  cidade_nome",$conn) or die ("Error na consulta");

$i = 0;
$cont = 0;
while ($result = mysql_fetch_array($query_grid)){
    
		
	echo "&codigo$i=$result[0]";
	echo "&nome$i=$result[2]";
			
$i++;

// select para selecionar o nome da UF

$query_cid = mysql_query("SELECT uf_sigla FROM uf WHERE uf_id = '$result[1]'",$conn) or die ("Error na consulta");

while ($resultado = mysql_fetch_array($query_cid)){

echo "&uf$cont=$resultado[0]";
$cont++;

} 


} // fim primeiro while


// consulta para selecionar o registro cadastrado no combo quando o cadastro for feito dentro do cadastro de contratos
$query_combo = mysql_query("SELECT cidade_id, cidade_nome FROM cidade ORDER BY cidade_id DESC LIMIT 0,1",$conn) or die ("Error na consulta");

while ($resultado = mysql_fetch_array($query_combo)){
    
		
	echo "&codcidade=$resultado[0]";
	echo "&nomecidade=$resultado[1]";

}

mysql_close();

} // fim else
}else
// caso n tenha passado nenhum valor para variável
echo "vazio";
?>