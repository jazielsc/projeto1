<?
	session_start();
	$id = $_POST['consulta'];
	header("Location: /paginas/consulta_turma_disciplina.php?acao=-1&id=".$id);
?>