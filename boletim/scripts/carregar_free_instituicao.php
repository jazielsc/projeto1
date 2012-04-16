<?php

include("conecta.php");
$cod_tipo = $_POST['cod_tipo'];
$cod_uf = $_POST['cod_uf'];

if($cod_uf != ""){

    $where = "AND cod_uf = '$cod_uf'";

} else{

    $where = "";
}

$query = mysql_query("SELECT instituicao.cod_instituicao, instituicao.nome, instituicao.email, instituicao.telefone, uf_sigla, instituicao.nome FROM instituicao, uf WHERE instituicao.cod_uf  = uf_id AND cod_tipo = '$cod_tipo' $where",$conn) or die("Error na consulta". mysql_error());
$indice=0;

while ($result = mysql_fetch_row($query)) {
	
	
        echo "&codigo$indice=$result[0]";
        echo "&nome$indice=$result[1]";
	echo "&email$indice=$result[2]";
        echo "&telefone$indice=$result[3]";
        echo "&uf$indice=$result[4]";
        echo "&instituicao$indice=$result[5]";
        
	
	$indice++;
}



$query_cont1 = mysql_query("SELECT count(*) FROM instituicao WHERE cod_tipo = '$cod_tipo' $where",$conn) or die("Error na consulta". mysql_error());
$resultado = mysql_fetch_row($query_cont1);

echo"&quantidade=$resultado[0]"


?>