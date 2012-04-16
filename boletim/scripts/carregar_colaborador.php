<?php

include("conecta.php");
$cod_colaborador = $_POST['cod_colaborador'];

$query = mysql_query("SELECT cod_colaborador, colaborador.nome, colaborador.email, colaborador.celular, uf_sigla FROM colaborador, uf WHERE colaborador.cod_uf  = uf_id AND colaborador.cod_colaborador = '$cod_colaborador'",$conn) or die("Error na consulta". mysql_error());
$indice=0;

while ($result = mysql_fetch_row($query)) {
	

        echo "&codigo$indice=$result[0]";
        echo "&nome$indice=$result[1]";
	echo "&email$indice=$result[2]";
        echo "&telefone$indice=$result[3]";
        echo "&uf$indice=$result[4]";
       
	
	$indice++;
}



$query_cont1 = mysql_query("SELECT count(*) FROM instituicao, colaborador_instituicao WHERE colaborador_instituicao.cod_instituicao = instituicao.cod_instituicao AND colaborador_instituicao.cod_colaborador = '$cod_colaborador'",$conn) or die("Error na consulta". mysql_error());
$resultado = mysql_fetch_row($query_cont1);

echo"&quantidade=$resultado[0]"


?>