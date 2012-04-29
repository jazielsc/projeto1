<?php 
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
	$cod_turma = $_REQUEST['id'];
	$res = mysql_query("SELECT cod_disciplina, nome FROM disciplina WHERE cod_turma = ".$cod_turma." ORDER BY nome") or die ("Error na consulta");
	echo '<option value="0" disabled="disabled">Selecione a Disciplina</option>';
	while($linha = mysql_fetch_array($res)){
		echo utf8_encode('<option value='.$linha[0].'>'.$linha[1].'</option>');
	}
?>