<?php
	
	if (isset($_POST['acao'])){
		require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
		require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_calendario.php");
        $calendarios = new Class_calendario;
		$action = $_POST['acao'];

		switch ($action){
			case "insert_calendario": {
				$dia = seguranca($_POST['dia']);
				$inicio = seguranca($_POST['horainicio']);
				$termino = seguranca($_POST['horatermino']);
				$calendario = seguranca($_POST['horario']);
				$cod_professor = (int)$_POST['cod_professor'];
				$cod_disciplina = (int)$_POST['cod_disciplina'];
				$cod_turma = (int)$_POST['cod_turma'];
				$dia_numero = (int)$_POST['dia_numero'];
				$cod_curso = (int)$_POST['cod_curso'];                      
				$calendarios->insert_calendario($dia, $inicio, $termino, $cod_turma, $cod_disciplina, $cod_professor, $calendario, $dia_numero, $cod_curso);      
			} break;

                        case "select_grid_calendario":

                         if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}
                        
                        $calendarios->select_grid_calendario($cod_turma);

                        break;

                        case "select_grid_calendario_unidade":

                         if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        if(isset($_POST['unidade'])){
			$unidade = (int)$_POST['unidade'];
			}

                        $calendarios->select_grid_calendario_unidade($cod_turma,$unidade);

                        break;

                        case "select_grid_calendario_professor":

                         if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

                        $calendarios->select_grid_calendario_professor($cod_professor);

                        break;

                        case "select_grid_calendario_professor2":

                         if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

                        if(isset($_POST['semestre'])){
			$semestre = (int)$_POST['semestre'];
			}

                        $calendarios->select_grid_calendario_professor2($cod_professor, $semestre);

                        break;

                        case "select_grid_calendario_aluno":

                         
                        if(isset($_POST['semestre'])){
			$semestre = (int)$_POST['semestre'];
			}

                        $calendarios->select_grid_calendario_aluno($semestre);

                        break;

                        case "select_grid_calendario_aluno_unidade":


                        if(isset($_POST['unidade'])){
			$unidade = (int)$_POST['unidade'];
			}

                        $calendarios->select_grid_calendario_aluno_unidade($unidade);

                        break;

                        case "select_grid_calendario_professor_logado":


                        if(isset($_POST['semestre'])){
			$semestre = (int)$_POST['semestre'];
			}

                        $calendarios->select_grid_calendario_professor_logado($semestre);

                        break;

                        case "select_grid_calendario_professor_logado_unidade":


                        if(isset($_POST['unidade'])){
			$unidade = (int)$_POST['unidade'];
			}

                        $calendarios->select_grid_calendario_professor_logado_unidade($unidade);

                        break;

                        case "select_calendario":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $calendarios->select_calendario($codigo);
                        echo"&resultado=$calendarios->resultado";

                        break;

                        case "update_calendario":

                        if(isset($_POST['dia'])){
			$dia = seguranca($_POST['dia']);
                        }

                        if(isset($_POST['horainicio'])){
			$inicio = seguranca($_POST['horainicio']);
                        }

                        if(isset($_POST['horatermino'])){
			$termino = seguranca($_POST['horatermino']);
                        }

                        if(isset($_POST['horario'])){
			$calendario = seguranca($_POST['horario']);
                        }

                        if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

			if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        if(isset($_POST['dia_numero'])){
			$dia_numero = (int)$_POST['dia_numero'];
			}

                        if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}


                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}
			
			$calendarios->update_calendario($dia, $inicio, $termino, $cod_turma, $cod_disciplina, $cod_professor, $calendario, $dia_numero, $cod_curso, $codigo);

                        echo"&resultado=$calendarios->resultado";

		        break;


                        case "delete_calendario":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        $calendarios->delete_calendario($codigo, $cod_turma);
                        echo"&resultado=$calendarios->resultado";

                        break;


	}



}else{

//

}
?>
