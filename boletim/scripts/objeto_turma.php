<?php


	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_turma.php");
        $turma = new Class_turma;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "insert_turma":

			
                        			
			if(isset($_POST['nome'])){
			$nome = seguranca($_POST['nome']);
                        }

                        if(isset($_POST['data_inicial'])){
			$data = $_POST['data_inicial'];
                        }

                        if(isset($_POST['data_final'])){
			$data_final = $_POST['data_final'];
                        }

                        if(isset($_POST['cod_instituicao'])){
			$cod_instituicao = (int)$_POST['cod_instituicao'];
			}

			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                        if(isset($_POST['turno'])){
			$turno = seguranca($_POST['turno']);
			}

                        if(isset($_POST['semestre'])){
			$semestre = (int) $_POST['semestre'];
			}

                        
			$turma->insert_turma($nome, $data, $cod_instituicao, $cod_curso, $turno, $semestre, $data_final);
                        
                        echo"&resultado=$turma->resultado";

		        break;

                        case "select_grid_turma":

                        $turma->select_grid_turma();

                        break;

                        case "select_grid_disciplina":

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        $turma->select_grid_disciplina($cod_turma);

                        break;

                        case "select_grid_aluno":

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        $turma->select_grid_aluno($cod_turma);

                        break;

                        case "select_turma":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $turma->select_turma($codigo);
                        echo"&resultado=$turma->resultado";

                        break;

                        case "update_turma":

                        if(isset($_POST['nome'])){
			$nome = seguranca($_POST['nome']);
                        }

                        if(isset($_POST['data_inicial'])){
			$data = $_POST['data_inicial'];
                        }

                        if(isset($_POST['data_final'])){
			$data_final = $_POST['data_final'];
                        }

                        if(isset($_POST['cod_instituicao'])){
			$cod_instituicao = (int)$_POST['cod_instituicao'];
			}

			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        if(isset($_POST['turno'])){
			$turno = seguranca($_POST['turno']);
			}

                        if(isset($_POST['semestre'])){
			$semestre = (int) $_POST['semestre'];
			}

			$turma->update_turma($nome,$data,$cod_instituicao,$cod_curso,$codigo,$turno,$semestre,$data_final);

                        echo"&resultado=$turma->resultado";

		        break;


                        case "delete_turma":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $turma->delete_turma($codigo);
                        echo"&resultado=$turma->resultado";

                        break;


	}



}else{

//

}
?>
