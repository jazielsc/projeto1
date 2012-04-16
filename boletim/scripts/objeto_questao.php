<?php

session_start();

	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_questao.php");
        $questao = new Class_questao;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "insert_questao":

                        if(isset($_POST['numero'])){
			$numero = (int)$_POST['numero'];
			}

                        if(isset($_POST['peso'])){
			$peso = (int)$_POST['peso'];
			}

                        if(isset($_POST['pergunta'])){
			$pergunta = seguranca($_POST['pergunta']);
                        }

                        if(isset($_POST['resposta'])){
			$resposta = seguranca($_POST['resposta']);
                        }

                        if(isset($_POST['tipo'])){
			$tipo = (int)$_POST['tipo'];
                        }


			$cod_avaliacao = 0;

                        $session = $_SESSION['id_usuario'];

			$questao->insert_questao($numero, $peso, $pergunta, $resposta, $cod_avaliacao, $session, $tipo);

                        echo"&resultado=$questao->resultado";

		        break;

                        case "insert_questao_consulta":

                        if(isset($_POST['numero'])){
			$numero = (int)$_POST['numero'];
			}

                        if(isset($_POST['peso'])){
			$peso = (int)$_POST['peso'];
			}

                        if(isset($_POST['pergunta'])){
			$pergunta = seguranca($_POST['pergunta']);
                        }

                        if(isset($_POST['resposta'])){
			$resposta = seguranca($_POST['resposta']);
                        }

                        if(isset($_POST['tipo'])){
			$tipo = (int)$_POST['tipo'];
                        }

                         if(isset($_POST['cod_avaliacao'])){
			$cod_avaliacao = (int)$_POST['cod_avaliacao'];
                        }


                        $session = 0;

			$questao->insert_questao_consulta($numero, $peso, $pergunta, $resposta, $cod_avaliacao, $session, $tipo);

                        echo"&resultado=$questao->resultado";

		        break;

                        case "insert_banco_questao":

                       
                        if(isset($_POST['peso'])){
			$peso = (int)$_POST['peso'];
			}

                        if(isset($_POST['pergunta'])){
			$pergunta = seguranca($_POST['pergunta']);
                        }

                        if(isset($_POST['resposta'])){
			$resposta = seguranca($_POST['resposta']);
                        }

                        if(isset($_POST['tipo'])){
			$tipo = (int)$_POST['tipo'];
                        }

                        if(isset($_POST['cod_avaliacao'])){
			$cod_avaliacao = (int)$_POST['cod_avaliacao'];
                        }

                        if(isset($_POST['referencia'])){
			$referencia = (int)$_POST['referencia'];
                        }

                        $session = $_SESSION['id_usuario'];

			$questao->insert_banco_questao($peso, $pergunta, $resposta, $cod_avaliacao, $session, $tipo, $referencia);

                        echo"&resultado=$questao->resultado";

		        break;

                        case "select_grid_questao":

                        $questao->select_grid_questao();

                        break;

                        case "select_questao":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $session = $_SESSION['id_usuario'];

                        $questao->select_questao($codigo,$session);
                        echo"&resultado=$questao->resultado";

                        break;

                         case "consulta_questao":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        if(isset($_POST['cod_avaliacao'])){
                        $cod_avaliacao = $_POST['cod_avaliacao'];
                        }

                        $questao->consulta_questao($codigo, $cod_avaliacao);
                        echo"&resultado=$questao->resultado";

                        break;

                        case "update_questao":

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

			$questao->update_questao($nome,$cod_professor,$cod_curso,$cod_turma,$codigo);

                        echo"&resultado=$questao->resultado";

		        break;


                        case "banco_questao_grid":

                        if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                        if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}

                        

                        $questao->banco_questao_grid($cod_curso, $cod_disciplina);
                        echo"&resultado=$questao->resultado";

                        break;

                        case "banco_questao_grid2":

                        $session = $_SESSION['id_usuario'];

                        $questao->banco_questao_grid2($session);
                        echo"&resultado=$questao->resultado";

                        break;

                        case "banco_questao_consulta":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                       

                        $questao->banco_questao_consulta($codigo);
                        echo"&resultado=$questao->resultado";

                        break;


	}



}else{

//

}
?>
