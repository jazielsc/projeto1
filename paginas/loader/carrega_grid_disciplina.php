<?php
/********PAGINA QUE GERA TABELA APRA JQUERY
         TABELA ALUNO POR DISCIPLINA
*****/

	session_start();	
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
	$cod_professor = $_REQUEST['cod_professor'];
	$ano = date('Y');
	
	$res = mysql_query("SELECT cod_disciplina, curso.nome, disciplina.nome, professor.2_, turma.1_ FROM disciplina, professor, curso, turma WHERE disciplina.cod_professor = professor.cod_professor AND disciplina.cod_curso = curso.cod_curso AND turma.cod_turma = disciplina.cod_turma AND professor.cod_professor = '$cod_professor' AND turma.ano = '$ano' ORDER BY disciplina.nome") or die ("Error na consulta");
	
	while($linha = mysql_fetch_array($res)){
		echo "<tr class='linha_disciplina_professor'>";
		echo utf8_encode('<td>'.$linha[3].'</td><td>'.$linha[2].'</td><td>'.$linha[1].'</td><td>'.$linha[4].'</td>');
		echo '</tr>'."\n";
	}
	
?>