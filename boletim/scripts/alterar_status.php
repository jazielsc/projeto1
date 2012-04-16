<?php

session_start();

    // evita que o script seja armazenado no cache
	header("Content-type: text/html; charset=iso-8859-1");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

include("conecta.php"); // chamando arquivo de conexao
// valores vindos do flash 

$codigo = $_POST['codigo'];
$opcao = $_POST['opcao'];

if($opcao == 1){
$tabela = "aluno";
$campo = "cod_aluno";
$referencia = 1;
$atrib = 3;
} else if($opcao == 2){
$tabela = "professor";
$campo = "cod_professor";
$referencia = 2;
$atrib = 4;
} else if($opcao == 3){
$tabela = "funcionario";
$campo = "cod_funcionario";
$referencia = 3;
$atrib = 1;
} else {


$tabela = "funcionario";
$campo = "cod_funcionario";
$referencia = 3;
$atrib = 2;
}


if ($codigo != ""){ // testando se veio algum valor do flash

// alterando registros
$query = mysql_query("UPDATE $tabela SET cod_status = 1 WHERE $campo = '$codigo'",$conn) or die("Error na altera��o");

$query_update = mysql_query("UPDATE usuario SET usuario_atrib = '$atrib' WHERE cod_aluno_professor = '$codigo' AND referencia = '$referencia'") or die("ERRO!");
$query_update = mysql_query("UPDATE usuario SET usuario_atrib = 3 WHERE cod_aluno_professor = '$codigo' AND referencia = 4") or die("ERRO!");

echo "&resultado=Alteracao realizada com Sucesso!";

mysql_close();
                

}else // caso n tenha recebido valor do flash
echo"&resultado=vazio"; 


?>

