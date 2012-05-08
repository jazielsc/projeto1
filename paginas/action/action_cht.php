<?
	session_start();
	$id = $_POST['consulta'];
	header("Location: /paginas/consulta_turma_horario.php?acao=-1&id=".$id);
?>