<?
	session_start();
	$id = $_POST['consulta'];
	header("Location: /paginas/consulta_turma_aluno.php?acao=-1&id=".$id);
?>