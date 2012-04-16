<?php

session_start();
$cod_instituicao = (int) $_SESSION['id_instituicao'];

include("conecta.php");

// vari�vel do flash
$opcao = $_POST['opcao'];

if ($opcao == 1){

$campos = "cod_aluno, nome ";
$tabela = "aluno ";
$order_by = "nome";

} else if ($opcao == 2){

$campos = "cod_professor, nome ";
$tabela = "professor ";
$order_by = "nome";


} else {

$campos = "cod_funcionario, nome ";
$tabela = "funcionario ";
$order_by = "nome";

}




if ($opcao != "") {

$query = mysql_query("SELECT $campos FROM $tabela WHERE cod_instituicao = '$cod_instituicao' ORDER BY $order_by",$conn) or die("Error na consulta");
$indice=0;

while ($result = mysql_fetch_row($query)) {
	
	echo "&cod$indice=$result[0]";
	echo "&nome$indice=$result[1]";
	
	$indice++;
}

} else

echo "ERRO";


?>