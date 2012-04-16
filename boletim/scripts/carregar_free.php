<?php

include("conecta.php");
$cod_colaborador = $_POST['cod_colaborador'];

$query = mysql_query("SELECT colaborador.nome, colaborador.email, colaborador.celular, uf_sigla, instituicao.nome FROM colaborador, uf, instituicao, colaborador_instituicao WHERE colaborador_instituicao.cod_instituicao = instituicao.cod_instituicao AND colaborador_instituicao.cod_colaborador = colaborador.cod_colaborador AND colaborador.cod_uf  = uf_id AND colaborador.cod_colaborador = '$cod_colaborador'",$conn) or die("Error na consulta". mysql_error());
$indice=0;

while ($result = mysql_fetch_row($query)) {
	
	echo "&nome$indice=$result[0]";
	echo "&email$indice=$result[1]";
        echo "&telefone$indice=$result[2]";
        echo "&uf$indice=$result[3]";
        echo "&instituicao$indice=$result[4]";
	
	$indice++;
}



$query_cont1 = mysql_query("SELECT count(*) FROM instituicao, colaborador_instituicao WHERE colaborador_instituicao.cod_instituicao = instituicao.cod_instituicao AND colaborador_instituicao.cod_colaborador = '$cod_colaborador'",$conn) or die("Error na consulta". mysql_error());
$resultado = mysql_fetch_row($query_cont1);

echo"&quantidade=$resultado[0]"


?>