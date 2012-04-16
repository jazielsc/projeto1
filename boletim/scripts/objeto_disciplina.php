<?php


	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_disciplina.php");
        $disciplina = new Class_disciplina;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "insert_disciplina":

			
                        			
			if(isset($_POST['nome'])){
			$nome = seguranca($_POST['nome']);
                        }

                        

                        if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        if(isset($_POST['cargahoraria'])){
			$cargahoraria = seguranca($_POST['cargahoraria']);
			}

                        if(isset($_POST['txt_numerofaltas'])){
			$numero_faltas = seguranca($_POST['txt_numerofaltas']);
			}

                        
			$disciplina->insert_disciplina($nome, $cod_professor, $cod_curso, $cod_turma, $cargahoraria, $numero_faltas);
                        
                        echo"&resultado=$disciplina->resultado";

		        break;

                        case "insert_disciplina_lancamento":



			if(isset($_POST['nome'])){
			$nome = seguranca($_POST['nome']);
                        }



                        if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        

			$disciplina->insert_disciplina_lancamento($nome, $cod_professor, $cod_curso, $cod_turma);

                        echo"&resultado=$disciplina->resultado";

		        break;


                        case "select_grid_disciplina":

                        $disciplina->select_grid_disciplina();

                        break;

                        case "select_disciplina":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $disciplina->select_disciplina($codigo);
                        echo"&resultado=$disciplina->resultado";

                        break;

                        case "delete_disciplina":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $disciplina->delete_disciplina($codigo);
                        echo"&resultado=$disciplina->resultado";

                        break;

                        case "update_disciplina":

                        if(isset($_POST['nome'])){
			$nome = seguranca($_POST['nome']);
                        }


                        if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}


                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        if(isset($_POST['cargahoraria'])){
			$cargahoraria = seguranca($_POST['cargahoraria']);
			}

                        if(isset($_POST['txt_numerofaltas'])){
			$numero_faltas = seguranca($_POST['txt_numerofaltas']);
			}
			
			$disciplina->update_disciplina($nome,$cod_professor,$cod_curso,$cod_turma,$codigo,$cargahoraria,$numero_faltas);

                        echo"&resultado=$disciplina->resultado";

		        break;


	}



}else{

//

}
?>
