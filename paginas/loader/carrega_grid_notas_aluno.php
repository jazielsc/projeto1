<?php
/********PAGINA QUE GERA TABELA APRA JQUERY
         TABELA ALUNO POR DISCIPLINA
*****/

	session_start();	
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
	$cod_curso = $_REQUEST['curso'];
	$cod_turma = $_REQUEST['turma'];
	$cod_disciplina = $_REQUEST['disciplina'];
	$cod_professor = $_REQUEST['professor'];
	$cod_aluno = $_REQUEST['aluno'];
	
	$res = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade, aluno.cod_aluno FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' AND boletim.cod_aluno = '$cod_aluno' ORDER BY aluno.nome") or die ("Error na consulta");
	
	while($linha = mysql_fetch_array($res)){
		echo "<tr class='linha' onclick=\"prepara_update_notas(this)\">";
		echo utf8_encode('<td>'.$linha[0].'</td><td>'.$linha[1].'</td><td>'.$linha[2].'</td>'.
		'<td>'.$linha[3].'</td><td>'.$linha[4].'</td><td>'.$linha[5].'</td>'.
		'<td>'.$linha[6].'</td><td>'.$linha[7].'</td><td>'.$linha[8].'</td>'.
		'<td>'.$linha[9].'</td><td>'.$linha[10].'</td><td >'.$linha[11].'</td>');
		echo '</tr>'."\n";
	}
	
?>