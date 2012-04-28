<?php
/********PAGINA QUE GERA TABELA APRA JQUERY
         TABELA ALUNO POR DISCIPLINA
*****/

	session_start();	
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
	$cod_disciplina = $_REQUEST['disciplina'];
	$cod_professor = $_REQUEST['professor'];
	
	$res = mysql_query("SELECT aluno.cod_aluno, aluno.nome, disciplina.nome FROM item2, disciplina, aluno WHERE item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND item2.cod_disciplina = '$cod_disciplina' AND cod_professor = '$cod_professor' AND item2.cod_status = 1 ORDER BY aluno.nome") or die ("Error na consulta");
	
	while($linha = mysql_fetch_array($res)){
		echo "<tr >";
		echo utf8_encode('<td>'.$linha[0].'</td><td>'.$linha[1].'</td><td>'.$linha[2].'</td>');
		echo '</tr>'."\n";
	}
	
?>