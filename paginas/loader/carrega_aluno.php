<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
	$cod_instituicao = (int) $_SESSION['id_instituicao'];
	$cod_curso = $_REQUEST['cod_curso'];
	$cod_turma = $_REQUEST['cod_turma'];
		
	$res = mysql_query("SELECT cod_aluno, aluno.2_nome_completo FROM aluno, turma WHERE turma.cod_curso = '$cod_curso' AND turma.cod_turma = '$cod_turma' AND aluno.cod_instituicao = '$cod_instituicao' AND cod_status = 1 ORDER BY aluno.2_nome_completo") or die ("Error na consulta");
	echo '<option value="0" >Selecione o Aluno</option>';
	while($linha = mysql_fetch_array($res)){
		echo utf8_encode('<option value='.$linha[0].'>'.$linha[1].'</option>');
	}
?>