<?php
/********PAGINA QUE GERA TABELA APRA JQUERY
         TABELA ALUNO POR DISCIPLINA
*****/

	session_start();	
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
	$cod_curso = $_REQUEST['cod_curso'];
	$cod_turma = $_REQUEST['cod_turma'];
	$cod_aluno = $_REQUEST['cod_aluno'];
	
	$res = mysql_query("SELECT disciplina.cod_disciplina, disciplina.nome, professor.cod_professor, professor.2_ FROM curso, turma, item2, professor, aluno, disciplina WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor  AND curso.cod_curso = turma.cod_curso AND curso.cod_curso = disciplina.cod_curso AND item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND item2.cod_aluno = '$cod_aluno' AND curso.cod_curso = '$cod_curso' AND item2.cod_status = 1 ORDER BY disciplina.nome") or die ("Error na consulta");
	
	while($linha = mysql_fetch_array($res)){
		echo "<tr class='linha_disciplina_professor' onclick=\"prepara_insert_notas_disciplina_professor(this);\">";
		echo utf8_encode('<td>'.$linha[0].'</td><td>'.$linha[1].'</td><td>'.$linha[2].'</td><td>'.$linha[3].'</td>');
		echo '</tr>'."\n";
	}
	
?>