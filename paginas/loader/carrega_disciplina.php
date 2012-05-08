<?php
	session_start();
	require_once("../../boletim/scripts/conecta.php");
	$cod_curso = $_POST['id'];
	
	$res = mysql_query("SELECT cod_disciplina, nome FROM disciplina WHERE cod_curso = ".$cod_curso) or die ("Error na consulta");
	echo '<option value="0" selected="selected" disabled="disabled">Selecione a Disciplina</option>';
	while($linha = mysql_fetch_array($res)){
		echo '<option value='.$linha[0].'>'.$linha[1].'</option>';
	}
?>
