<?php

session_start();
$cod_instituicao = (int) $_SESSION['id_instituicao'];

include("conecta.php");

// vari�vel do flash
$opcao = $_POST['opcao'];


if ($opcao == 1){

$tabela = "aluno ";
$order_by = "nome";
$where = '1 AND cod_aluno = cod_aluno_professor';
} else if ($opcao == 2){

$tabela = "professor ";
$order_by = "nome";
$where = '2 AND cod_professor = cod_aluno_professor';

} else if ($opcao == 3){


$tabela = "funcionario ";
$order_by = "nome";
$where = "3 AND cod_funcionario = cod_aluno_professor";


} else {

$tabela = "aluno ";
$order_by = "nome";
$where = '4 AND cod_aluno = cod_aluno_professor';
}




if ($opcao != "") {

$query = mysql_query("SELECT DISTINCT usuario.nome, usuario_login, identidade FROM usuario, $tabela
 WHERE usuario.cod_instituicao = '$cod_instituicao' AND
 referencia = $where ORDER BY usuario.nome",$conn) or die("Error na consulta");
$i=0;
$posicao = 1;


while ($result = mysql_fetch_row($query)) {
	
	 echo "&codigo$i=$posicao";
         echo "&nome$i=$result[0]";
         echo "&usuario$i=$result[1]";
         echo "&identidade$i=$result[2]";
	
	$i++;
        $posicao++;
}

} else

echo "ERRO";


?>