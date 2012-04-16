<?php


	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_item2.php");
        $item2 = new Class_item2;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "insert_item2":

			
                        			
			if(isset($_POST['cod_aluno'])){
			$cod_aluno = (int)$_POST['cod_aluno'];
			}

			if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}

                        
			$item2->insert_item2($cod_aluno, $cod_disciplina);

                        echo"&resultado=$item2->resultado";

		        break;

                        case "insert_item2_disciplina":



			if(isset($_POST['cod_aluno'])){
			$cod_aluno = (int)$_POST['cod_aluno'];
			}

			if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}


			$item2->insert_item2_disciplina($cod_aluno, $cod_disciplina, $cod_turma);

                        
                        echo"&resultado=$item2->resultado";

		        break;

                        case "select_grid_item2":

                        if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}

                        $item2->select_grid_item2($cod_disciplina);

                        break;

                        case "select_grid_item2_disciplina":

                        if(isset($_POST['cod_aluno'])){
			$cod_aluno = (int)$_POST['cod_aluno'];
			}

                        if(isset($_POST['ano'])){
			$ano = (int)$_POST['ano'];
			} else{
                            $ano = date("Y");
                        }

                        $item2->select_grid_item2_disciplina($cod_aluno,$ano);

                        break;

                        case "select_item2":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $item2->select_item2($codigo);
                        echo"&resultado=$item2->resultado";

                        break;

                        case "update_item2":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}
			
			$item2->update_item2($codigo,$cod_disciplina);

                        echo"&resultado=$item2->resultado";

		        break;

                        case "delete_item2":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}

                        if(isset($_POST['cod_aluno'])){
			$cod_aluno = (int)$_POST['cod_aluno'];
			}

                        
			$item2->delete_item2($codigo,$cod_disciplina,$cod_aluno);

                        echo"&resultado=$item2->resultado";

		        break;


	}



}else{

//

}
?>
