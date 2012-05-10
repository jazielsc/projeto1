<?php 

//script de segurança 
// autor: leonardo marinho

function seguranca($campos){



// remove palavras que contenham sintaxe sql:
$campos = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$campos);

//espaços em branco no fim e inicio da string
$campos = trim($campos);

//tira tags html 
$campos = strip_tags($campos);

//Adiciona barras invertidas a uma string
$campos = mysql_real_escape_string($campos);


$campos = str_replace("http", "", $campos);
$campos = str_replace("https", "", $campos);
$campos = str_replace("ftp", "", $campos);
$campos = str_replace(".dat", "", $campos);
$campos = str_replace(".txt", "", $campos);
$campos = str_replace(".gif", "", $campos);
$campos = str_replace("wget", "", $campos);
$campos = str_replace("cmd", "", $campos);

return $campos;
}
?>

