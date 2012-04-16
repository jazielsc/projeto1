<?php

session_start();

	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_avaliacao.php");
        $avaliacao = new Class_avaliacao;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "insert_avaliacao":

			
                        			
			if(isset($_POST['nome'])){
			$nome = seguranca($_POST['nome']);
                        }
                       

                        
			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}

                        if(isset($_POST['valor'])){
			$valor = (int)$_POST['valor'];
			}

                        if(isset($_POST['minima'])){
			$minima = (int)$_POST['minima'];
			}

                        $session = $_SESSION['id_usuario'];
                        $cod_professor = $_SESSION['id_aluno_professor'];

                        $envia_email = "SIM";

			$avaliacao->insert_avaliacao($nome, $cod_professor, $cod_curso, $cod_turma, $cod_disciplina, $valor, $session, $minima, $envia_email);
                        
                        echo"&resultado=$avaliacao->resultado";

		        break;

                        

                        case "select_grid_avaliacao":

                        $session = $_SESSION['id_usuario'];
                        $id_aluno_professor = $_SESSION['id_aluno_professor'];

                        $avaliacao->select_grid_avaliacao($session,$id_aluno_professor);

                        break;

                        case "select_grid_avaliacao2":

                        $session = $_SESSION['id_usuario'];
                        $id_aluno_professor = $_SESSION['id_aluno_professor'];

                        $avaliacao->select_grid_avaliacao2($session,$id_aluno_professor);

                        break;

                        case "select_avaliacao":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        if(isset($_POST['cod_avaliacao'])){
			$cod_avaliacao = (int)$_POST['cod_avaliacao'];
			}

                        $avaliacao->select_avaliacao($codigo,$cod_avaliacao);
                        echo"&resultado=$avaliacao->resultado";

                        break;

                        case "update_avaliacao":

                            if(isset($_POST['nome'])){
			$nome = seguranca($_POST['nome']);
                        }



			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}

                        if(isset($_POST['valor'])){
			$valor = (int)$_POST['valor'];
			}

                        if(isset($_POST['minima'])){
			$minima = (int)$_POST['minima'];
			}

                        if(isset($_POST['cod_avaliacao'])){
			$cod_avaliacao = (int)$_POST['cod_avaliacao'];
			}

                        $cod_professor = $_SESSION['id_aluno_professor'];

                        $session = 0;


			$avaliacao->update_avaliacao($nome, $cod_professor, $cod_curso, $cod_turma, $cod_disciplina, $valor, $session, $minima, $cod_avaliacao);

                        echo"&resultado=$avaliacao->resultado";

		        break;

                        case "select_fazer_avaliacao":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $avaliacao->select_fazer_avaliacao($codigo);

                        echo"&resultado=$avaliacao->resultado";

                        break;

                        case "select_resposta_avaliacao":

                        if(isset($_POST['numero'])){
			$numero = (int)$_POST['numero'];
			}

                        if(isset($_POST['cod_avaliacao'])){
			$cod_avaliacao = (int)$_POST['cod_avaliacao'];
			}

                        $avaliacao->select_resposta_avaliacao($numero,$cod_avaliacao);

                         echo"&resultado=$avaliacao->resultado";

                         break;

                         case "consulta_avaliacao":

                        

                        if(isset($_POST['cod_avaliacao'])){
			$cod_avaliacao = (int)$_POST['cod_avaliacao'];
			}

                        $avaliacao->consulta_avaliacao($cod_avaliacao);

                         echo"&resultado=$avaliacao->resultado";

                        break;


	}



}else{

//

}
?>
