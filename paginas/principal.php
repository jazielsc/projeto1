<?php 
	session_start();
?>

<html>
	<head>
		<title>Boletim Flex</title>
		<link type="text/css" rel="stylesheet" href="../css/estilo.css" />
	</head>
	<body>
		<div class="corpo">
			<?php  require_once('../partes/menu_login.php');?>	
			<br><br><br>
			<div class="conteudo">
				<br>
				<div id="desktop">
					<a href="cadastro_aluno.php"><img src="../img/cadastrar_aluno.png" /></a>
					<img src="../img/lancar_turma.png" />
					<img src="../img/lancar_disciplina.png" />
					<img src="../img/lancar_notas.png" />
					<img src="../img/consultar_aluno.png" />
					<img src="../img/consultar_turmas.png" />
					<img src="../img/consultar_disciplina.png" />
					<img src="../img/mensagens.png" />
					<img src="../img/datas_provas.png" />
					<img src="../img/horarios.png" />
					<img src="../img/configuracoes.png" />
					<img src="../img/ranking.png" />
					<img src="../img/historico.png" />
				</div>
			</div>
		</div>
	</body>
</html>