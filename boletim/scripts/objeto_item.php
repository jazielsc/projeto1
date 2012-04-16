<?php


	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_item.php");
        $item = new Class_item;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "insert_item":

			
                        			
			if(isset($_POST['cod_aluno'])){
			$cod_aluno = (int)$_POST['cod_aluno'];
			}

			if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        
			$item->insert_item($cod_aluno, $cod_turma);
                        
                        echo"&resultado=$item->resultado";

		        break;

                        case "select_grid_item":

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        $item->select_grid_item($cod_turma);

                        break;

                        case "select_item":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $item->select_item($codigo);
                        echo"&resultado=$item->resultado";

                        break;

                        case "update_item":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}
			
			$item->update_item($codigo,$cod_turma);

                        echo"&resultado=$item->resultado";

		        break;

                        case "delete_item":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        
			$item->delete_item($codigo,$cod_turma);

                        echo"&resultado=$item->resultado";

		        break;


	}



}else{

//

}
?>
