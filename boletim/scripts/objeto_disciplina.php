<?php
	if (isset($_POST['acao'])){
		require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
		require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_disciplina.php");
        $disciplina = new Class_disciplina;
		$action = $_POST['acao'];

		switch ($action){
			
			case "insert_disciplina":{
				$nome = seguranca($_POST['nome']);                       
				$cod_professor = (int)$_POST['cod_professor'];
				$cod_curso = (int)$_POST['cod_curso'];
				$cod_turma = (int)$_POST['cod_turma'];
				$cargahoraria = seguranca($_POST['cargahoraria']);
				$numero_faltas = seguranca($_POST['numerofaltas']);                       
				$disciplina->insert_disciplina($nome, $cod_professor, $cod_curso, $cod_turma, $cargahoraria, $numero_faltas);
				header("Location: /paginas/cadastro_disciplina.php?sucesso=0");
			} break;

			case "insert_disciplina_lancamento": {
				$nome = seguranca($_POST['nome']);
				$cod_professor = (int)$_POST['cod_professor'];
				$cod_curso = (int)$_POST['cod_curso'];
				$cod_turma = (int)$_POST['cod_turma'];                      
				$disciplina->insert_disciplina_lancamento($nome, $cod_professor, $cod_curso, $cod_turma);
			} break;
			
			case "delete_disciplina": {
				$codigo = (int)$_POST['codigo'];
				$result = $disciplina->delete_disciplina($codigo);
				if($result == 2){
					header("Location: /paginas/cadastro_disciplina.php?sucesso=2");
				}
				else {
					header("Location: /paginas/cadastro_disciplina.php?sucesso=302");
				}
			} break;

			case "update_disciplina": {
				$nome = seguranca($_POST['nome']);
				$cod_professor = (int)$_POST['cod_professor'];
				$cod_curso = (int)$_POST['cod_curso'];
				$cod_turma = (int)$_POST['cod_turma'];
				$codigo = (int)$_POST['cod_disciplina'];
				$cargahoraria = seguranca($_POST['cargahoraria']);
				$numero_faltas = seguranca($_POST['numerofaltas']);	
				$disciplina->update_disciplina($nome,$cod_professor,$cod_curso,$cod_turma,$codigo,$cargahoraria,$numero_faltas);
				header("Location: /paginas/cadastro_disciplina.php?sucesso=1");
			} break;


		}
	}
?>