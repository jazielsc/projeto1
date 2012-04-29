<?php 
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
	$cod_curso = $_REQUEST['id'];
	$res = mysql_query("SELECT cod_turma, nome FROM turma WHERE cod_instituicao = ".$_SESSION['id_instituicao']." AND cod_curso = ".$cod_curso." ORDER BY nome") or die ("Error na consulta");
	echo '<option value="0" disabled="disabled">Selecione a Turma</option>';
	while($linha = mysql_fetch_array($res)){
		echo utf8_encode('<option value='.$linha[0].'>'.$linha[1].'</option>');
	}
?>
