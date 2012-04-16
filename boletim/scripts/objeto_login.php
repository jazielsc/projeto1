<?php


	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_login.php");
        $login = new Class_login;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "logar":

			
                        
			
			
                        if(isset($_POST['usuario'])){
			$usuario = seguranca($_POST['usuario']);
                        }

                        if(isset($_POST['senha'])){
			$senha = md5($_POST['senha']);
                        }
						
			if(isset($_POST['referencia'])){
			$referencia = seguranca($_POST['referencia']);
                        }

                        if(isset($_POST['area_login'])){
			$area_login = seguranca($_POST['area_login']);
                        }
			

			

                        
			$login->logar($usuario,$senha,$referencia,$area_login);
                        
                        echo"&resultado=$login->resultado";

		        break;

                        case "select_grid_usuario":

                        $usuario->select_grid_usuario();

                        break;

                        case "select_usuario":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $usuario->select_usuario($codigo);
                        echo"&resultado=$usuario->resultado";

                        break;

                        case "update_usuario":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        if(isset($_POST['cod_usuario'])){
			$cod_usuario = (int)$_POST['cod_usuario'];
			}

			if(isset($_POST['nome_usuario'])){
			$nome_usuario = seguranca($_POST['nome_usuario']);
                        }

                        if(isset($_POST['login'])){
			$login = seguranca($_POST['login']);
                        }

                        if(isset($_POST['senha'])){
			$senha = seguranca($_POST['senha']);
                        }


			if(isset($_POST['referencia'])){
			$atribuicao = (int)$_POST['referencia'];
			}


			$usuario->update_usuario($login,$senha,$atribuicao,$atribuicao,$cod_usuario,$nome_usuario,$codigo);

                        echo"&resultado=$usuario->resultado";

		        break;

                        case "esqueceu_senha":

                        if(isset($_POST['email'])){
			$email = seguranca($_POST['email']);
                        }

                        $usuario->esqueceu_senha($email);

                        echo"&resultado=$usuario->resultado";

                        break;


	}



}else{

//

}
?>
