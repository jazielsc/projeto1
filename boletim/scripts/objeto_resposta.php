<?php

session_start();

	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_resposta.php");
        $resposta2 = new Class_resposta;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "insert_resposta":



                        if(isset($_POST['numero'])){
			$numero = (int)$_POST['numero'];
			}

                        
                        if(isset($_POST['alternativa'])){
			$alternativa = seguranca($_POST['alternativa']);
                        }

                        if(isset($_POST['resposta'])){
			$resposta = seguranca($_POST['resposta']);
                        }

                        if(isset($_POST['comentario'])){
			$comentario = seguranca($_POST['comentario']);
                        }


			$cod_questao = 0;

                        $session = $_SESSION['id_usuario'];

			$resposta2->insert_resposta($numero, $alternativa, $resposta, $comentario, $session, $cod_questao);

                        echo"&resultado=$resposta2->resultado";

		        break;


                        case "insert_resposta_consulta":



                        if(isset($_POST['numero'])){
			$numero = (int)$_POST['numero'];
			}


                        if(isset($_POST['alternativa'])){
			$alternativa = seguranca($_POST['alternativa']);
                        }

                        if(isset($_POST['resposta'])){
			$resposta = seguranca($_POST['resposta']);
                        }

                        if(isset($_POST['comentario'])){
			$comentario = seguranca($_POST['comentario']);
                        }

                        if(isset($_POST['cod_avaliacao'])){
			$cod_questao = (int)$_POST['cod_avaliacao'];
			}
			

                        $session = 0;

			$resposta2->insert_resposta_consulta($numero, $alternativa, $resposta, $comentario, $session, $cod_questao);

                        echo"&resultado=$resposta2->resultado";

		        break;

                        case "select_grid_resposta":

                        if(isset($_POST['numero'])){
			$numero = (int)$_POST['numero'];
			}
                        $session = $_SESSION['id_usuario'];

                        $resposta2->select_grid_resposta($numero,$session);

                         echo"&resultado=$resposta2->resultado";

                        break;

                        case "consulta_grid_resposta":

                        if(isset($_POST['numero'])){
			$numero = (int)$_POST['numero'];
			}

                        if(isset($_POST['cod_avaliacao'])){
			$cod_avaliacao = (int)$_POST['cod_avaliacao'];
			}

                        $resposta2->consulta_grid_resposta($numero, $cod_avaliacao);

                         echo"&resultado=$resposta2->resultado";

                        break;

                        case "select_resposta":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $session = $_SESSION['id_usuario'];

                        $resposta2->select_resposta($codigo,$session);
                        echo"&resultado=$resposta2->resultado";

                        break;

                        case "update_resposta":

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

			$resposta->update_resposta($nome,$cod_professor,$cod_curso,$cod_turma,$codigo);

                        echo"&resultado=$resposta->resultado";

		        break;


	}



}else{

//

}
?>
