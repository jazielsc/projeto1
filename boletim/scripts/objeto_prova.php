<?php

session_start();

	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_prova.php");
        $prova = new Class_prova;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "insert_prova":




                        if(isset($_POST['numero'])){
			$numero = (int)$_POST['numero'];
			}

                        
                        if(isset($_POST['resposta'])){
			$resposta = seguranca($_POST['resposta']);
                        }

                        if(isset($_POST['cod_avaliacao'])){
			$cod_avaliacao = (int)$_POST['cod_avaliacao'];
			}

			
                        $session = $_SESSION['id_usuario'];
                        $cod_aluno = $_SESSION['id_aluno_professor'];

			$prova->insert_prova($numero, $resposta, $cod_avaliacao, $session, $cod_aluno);

                        echo"&resultado=$prova->resultado";

		        break;

                        case "select_grid_prova":

                        $prova->select_grid_prova();

                        break;

                        case "select_prova":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        if(isset($_POST['cod_avaliacao'])){
			$cod_avaliacao = (int)$_POST['cod_avaliacao'];
			}

                        $session = $_SESSION['id_usuario'];

                        $prova->select_prova($codigo,$session,$cod_avaliacao);
                        echo"&resultado=$prova->resultado";

                        break;

                        case "select_prova_questao":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        if(isset($_POST['cod_avaliacao'])){
			$cod_avaliacao = (int)$_POST['cod_avaliacao'];
			}

                        
                        $prova->select_prova_questao($codigo,$cod_avaliacao);
                        echo"&resultado=$prova->resultado";

                        break;

                        case "update_prova":

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

			$prova->update_prova($nome,$cod_professor,$cod_curso,$cod_turma,$codigo);

                        echo"&resultado=$prova->resultado";

		        break;

                        case "resultado_prova":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $session = $_SESSION['id_usuario'];
                        
                        $cod_aluno = $_SESSION['id_aluno_professor'];

                        $prova->resultado_prova($codigo,$session,$cod_aluno);

                        echo"&resultado=$prova->resultado";

                        break;


                         case "select_grid_resultado":


                        if(isset($_POST['cod_avaliacao'])){
			$cod_avaliacao = (int)$_POST['cod_avaliacao'];
			}

                        $session = $_SESSION['id_usuario'];

                        $cod_professor = $_SESSION['id_aluno_professor'];

                        $prova->select_grid_resultado($session, $cod_professor, $cod_avaliacao);

                        echo"&resultado=$prova->resultado";

                        break;


                         case "select_grid_resultado2":


                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        $session = $_SESSION['id_usuario'];

                        $cod_aluno = $_SESSION['id_aluno_professor'];

                        $prova->select_grid_resultado2($session, $cod_aluno, $cod_turma);

                        echo"&resultado=$prova->resultado";

                        break;


	}



}else{

//

}
?>
