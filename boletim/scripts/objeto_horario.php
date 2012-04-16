<?php


	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_horario.php");
        $horarios = new Class_horario;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "insert_horario":

			
                        			
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
			$horario = seguranca($_POST['horario']);
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

                        
			$horarios->insert_horario($dia, $inicio, $termino, $cod_turma, $cod_disciplina, $cod_professor, $horario, $dia_numero, $cod_curso);
                        
                        echo"&resultado=$horarios->resultado";

		        break;

                        case "select_grid_horario":

                         if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}
                        
                        $horarios->select_grid_horario($cod_turma);

                        break;

                        case "select_grid_horario_professor":

                         if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

                        if(isset($_POST['ano'])){
			$ano = (int)$_POST['ano'];
			} else{
                            $ano = date("Y");
                        }

                        $horarios->select_grid_horario_professor($cod_professor,$ano);

                        break;

                        case "select_grid_horario_professor2":

                         if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

                        if(isset($_POST['semestre'])){
			$semestre = (int)$_POST['semestre'];
			}

                        $horarios->select_grid_horario_professor2($cod_professor, $semestre);

                        break;

                        case "select_grid_horario_aluno":

                         
                        if(isset($_POST['semestre'])){
			$semestre = (int)$_POST['semestre'];
			}

                        $horarios->select_grid_horario_aluno($semestre);

                        break;

                        case "select_grid_horario_professor_logado":


                        if(isset($_POST['semestre'])){
			$semestre = (int)$_POST['semestre'];
			}

                        $horarios->select_grid_horario_professor_logado($semestre);

                        break;

                        case "select_horario":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $horarios->select_horario($codigo);
                        echo"&resultado=$horarios->resultado";

                        break;

                        case "update_horario":

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
			$horario = seguranca($_POST['horario']);
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
			
			$horarios->update_horario($dia, $inicio, $termino, $cod_turma, $cod_disciplina, $cod_professor, $horario, $dia_numero, $cod_curso, $codigo);

                        echo"&resultado=$horarios->resultado";

		        break;


                        case "delete_horario":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        $horarios->delete_horario($codigo, $cod_turma);
                        echo"&resultado=$horarios->resultado";

                        break;


	}



}else{

//

}
?>
