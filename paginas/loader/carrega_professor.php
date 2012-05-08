<?php
	session_start();
	require_once("../../boletim/scripts/conecta.php");
	$cod_disciplina = $_POST['id'];
	$res = mysql_query("SELECT professor.cod_professor, professor.2_ FROM professor, disciplina WHERE disciplina.cod_professor = professor.cod_professor AND disciplina.cod_disciplina = ".$cod_disciplina) or die ("Error na consulta");
	echo '<option value="0" selected="selected" disabled="disabled">Selecione o Professor</option>';
	while($linha = mysql_fetch_array($res)){
		echo '<option value='.$linha[0].'>'.$linha[1].'</option>';
	}
?>
