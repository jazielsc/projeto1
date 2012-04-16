<?php
session_start();
         $cod_instituicao = (int) $_SESSION['id_instituicao'];

include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
         

$query_select = mysql_query("SELECT media, config.cod_tipo, tipo.nome, ranking, paralela.cod_paralela, paralela.nome FROM config, tipo, paralela WHERE paralela.cod_paralela = config.cod_paralela AND tipo.cod_tipo = config.cod_tipo AND cod_instituicao = '$cod_instituicao'") or die ("Erro select ". mysql_error());

$result = mysql_fetch_array($query_select);

echo "&media=$result[0]";
echo "&cod_tipo=$result[1]";
echo "&nome_tipo=$result[2]";
echo "&ranking=$result[3]";
echo "&cod_paralela=$result[4]";
echo "&nome_paralela=$result[5]";

?>