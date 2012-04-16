<?php

session_start();
$cod_instituicao = (int) $_SESSION['id_instituicao'];

include("conecta.php");

// vari�vel do flash
$opcao = $_POST['opcao'];


if(isset($_POST['letra'])){

$letra = $_POST['letra'];
$like = "AND nome LIKE '$letra%'";

} else{

    $like = "";
}

if ($opcao == 1){

$campos = "cod_aluno, nome, email, telefone ";
$tabela = "aluno ";
$order_by = "nome";
$where = "";
} else if ($opcao == 2){

$campos = "cod_professor, nome, email, telefone ";
$tabela = "professor ";
$order_by = "nome";
$where = "";

} else if ($opcao == 3){

$campos = "cod_funcionario, nome, email, telefone ";
$tabela = "funcionario ";
$order_by = "nome";
$where = "AND cargo = 'direção'";


} else {

$campos = "cod_funcionario, nome, email, telefone ";
$tabela = "funcionario ";
$order_by = "nome";
$where = "AND cargo = 'secretaria'";
}




if ($opcao != "") {

$query = mysql_query("SELECT $campos FROM $tabela WHERE cod_status > 1 AND cod_instituicao = '$cod_instituicao' $like $where ORDER BY $order_by",$conn) or die("Error na consulta");
$indice=0;

while ($result = mysql_fetch_row($query)) {
	
	echo "&cod$indice=$result[0]";
	echo "&nome$indice=$result[1]";
        echo "&email$indice=$result[2]";
        echo "&telefone$indice=$result[3]";
	
	$indice++;
}

} else

echo "ERRO";


?>