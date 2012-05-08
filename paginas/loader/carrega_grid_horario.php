<?php
/********PAGINA QUE GERA TABELA APRA JQUERY
         TABELA HORAIO POR TURMA
*****/

	session_start();	
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
	$cod_turma = $_REQUEST['turma'];
	
	$res = mysql_query("SELECT cod_horario, dia, inicio, termino, horario, disciplina.nome, professor.2_, turma.1_, disciplina.cod_disciplina, professor.cod_professor FROM horario, disciplina, professor, turma WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor AND horario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND horario.cod_turma = turma.cod_turma AND horario.cod_professor = professor.cod_professor ORDER BY  dia_numero, horario, inicio") or die ("Error na consulta");
	
	while($linha = mysql_fetch_array($res)){
		echo "<tr class='linha' onclick='prepara_update_horario(this)'>";
		echo utf8_encode('<td>'.$linha[0].'</td><td>'.$linha[1].'</td><td>'."$linha[4] - $linha[2] - $linha[3]".'</td><td>'.$linha[5].'</td><td>'.$linha[6]."</td><td style='display:none'>".$linha[8]."</td><td style='display:none'>".$linha[9].'</td>');
		echo '</tr>'."\n";
	}
	
?>