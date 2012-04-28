<?php 
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
	$cod_disciplina = $_REQUEST['id'];
	$res = mysql_query("SELECT professor.cod_professor, professor.nome FROM professor, disciplina WHERE 
			disciplina.cod_professor = professor.cod_professor AND cod_disciplina =".$cod_disciplina) or die ("Error na consulta");
	echo '<option value="0" disabled="disabled">Selecione o Professor</option>';
	while($linha = mysql_fetch_array($res)){
		echo utf8_encode('<option value='.$linha[0].'>'.$linha[1].'</option>');
	}
?>