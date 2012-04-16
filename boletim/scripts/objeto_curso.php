<?php


	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_curso.php");
        $curso = new Class_curso;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "insert_curso":

			

			
			if(isset($_POST['nome'])){
			$nome = seguranca($_POST['nome']);
                        }

                        if(isset($_POST['tipo'])){
			$tipo = seguranca($_POST['tipo']);
                        }
			

			if(isset($_POST['cod_instituicao'])){
			$cod_instituicao = (int)$_POST['cod_instituicao'];
			}

                        
			$curso->insert_curso($nome, $cod_instituicao, $tipo);
                        
                        echo"&resultado=$curso->resultado";

		        break;

                        case "select_grid_curso":

                        $curso->select_grid_curso();

                        break;

                        case "select_curso":

                        if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                        $curso->select_curso($cod_curso);
                        echo"&resultado=$curso->resultado";

                        break;

                        case "update_curso":


                        if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

			if(isset($_POST['nome'])){
			$nome = seguranca($_POST['nome']);
                        }

                        if(isset($_POST['tipo'])){
			$tipo = seguranca($_POST['tipo']);
                        }
			
                        if(isset($_POST['cod_instituicao'])){
			$cod_instituicao = (int)$_POST['cod_instituicao'];
			}


			$curso->update_curso($nome,$cod_instituicao,$cod_curso,$tipo);

                        echo"&resultado=$curso->resultado";

		        break;


                        case "delete_curso":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $curso->delete_curso($codigo);
                        echo"&resultado=$curso->resultado";

                        break;


	}



}else{

//

}
?>
