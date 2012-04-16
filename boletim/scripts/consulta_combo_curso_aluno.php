<?php

session_start();
$cod_instituicao = (int) $_SESSION['id_instituicao'];
$cod_aluno = (int)$_SESSION['id_aluno_professor'];

// evita que arquivo fique no cache 
	
    header("Content-type: text/html; charset=iso-8859-1");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

// arquivo de consulta do combo bairro no flash referente ao cadastro de contratos

include("conecta.php"); // arquivo de conexao

	
// consulta para retornar as informa��es dos bairros

$query_autor = mysql_query("SELECT DISTINCT(curso.cod_curso), curso.nome FROM disciplina, item2, curso
WHERE item2.cod_aluno = '$cod_aluno'
AND disciplina.cod_disciplina = item2.cod_disciplina
AND  curso.cod_curso = disciplina.cod_curso AND cod_instituicao = '$cod_instituicao' ORDER BY nome",$conn);

// verificando se a query retornou algum valor
$quant = mysql_num_rows($query_autor);

// se retornou ent�o preenche os dados no flash

if ($quant > 0){
$i = 0;
while ($result_autor = mysql_fetch_array($query_autor)){
    
	echo "&cod$i=$result_autor[0]";	
	echo "&nome$i=$result_autor[1]";
	
	$i++;
	} 
		
	echo "&mensagemtemas=OK";
} else
    echo "&mensagemtemas=nao";
	
	
mysql_close();
?>