<?php
	session_start();
	require_once("../../boletim/scripts/conecta.php");
	$cod_curso = $_POST['id'];
	$res = mysql_query("SELECT cod_turma, 1_ FROM turma WHERE cod_instituicao = ".$_SESSION['id_instituicao']." AND cod_curso = ".$cod_curso) or die ("Error na consulta");
	echo '<option value="0" selected="selected" disabled="disabled">Selecione a Turma</option>';
	while($linha = mysql_fetch_array($res)){
		echo '<option value='.$linha[0].'>'.$linha[1].'</option>';
	}
?>
