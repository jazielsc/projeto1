<?php


	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_funcionario.php");
        $funcionario = new Class_funcionario;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "insert_funcionario":

			

			
			if(isset($_POST['nome'])){
			$nome = seguranca($_POST['nome']);
                        }
			if(isset($_POST['email'])){
			$email = seguranca($_POST['email']);
                        }

			if(isset($_POST['cod_cidade'])){
			$cod_cidade = (int)$_POST['cod_cidade'];
			}

                        if(isset($_POST['cod_bairro'])){
			$cod_bairro = (int)$_POST['cod_bairro'];
			}

                        if(isset($_POST['cod_rua'])){
			$cod_rua = (int)$_POST['cod_rua'];
			}

			if(isset($_POST['complemento'])){
			$complemento = seguranca($_POST['complemento']);
			} else {
                        $complemento = NULL;
                        }

                        if(isset($_POST['numero'])){
			$numero = seguranca($_POST['numero']);
			} else {
                        $numero = NULL;
                        }

                        if(isset($_POST['cod_uf'])){
			$cod_uf = (int)$_POST['cod_uf'];
			}

			if(isset($_POST['telefone'])){
			$telefone = seguranca($_POST['telefone']);
			}

                        if(isset($_POST['cod_status'])){
			$cod_status = (int)$_POST['cod_status'];
			}

                        if(isset($_POST['cod_instituicao'])){
			$cod_instituicao = (int)$_POST['cod_instituicao'];
			}

                        if(isset($_POST['cep'])){
			$cep = seguranca($_POST['cep']);
			}
			
			if(isset($_POST['cod_cargo'])){
			$cod_cargo = seguranca($_POST['cod_cargo']);
			}
			
			if(isset($_POST['cargo'])){
			$cargo = seguranca($_POST['cargo']);
			}
                        
                        if(isset($_POST['identidade'])){
			$identidade = seguranca($_POST['identidade']);
			}

			
			$funcionario->insert_funcionario($nome, $email, $cod_cidade, $cod_bairro, $cod_rua, $complemento, $numero, $cod_uf, $telefone, $cod_status,$cod_instituicao,$cep,$cargo,$cod_cargo,$identidade);
                        
                        echo"&resultado=$funcionario->resultado";

		        break;

                        case "select_grid_funcionario":

                        $funcionario->select_grid_funcionario();

                        break;

                        case "select_funcionario":

                        if(isset($_POST['cod_funcionario'])){
			$cod_funcionario = (int)$_POST['cod_funcionario'];
			}

                        $funcionario->select_funcionario($cod_funcionario);
                        echo"&resultado=$funcionario->resultado";

                        break;

                        case "update_funcionario":


                        if(isset($_POST['cod_funcionario'])){
			$cod_funcionario = (int)$_POST['cod_funcionario'];
			}

			if(isset($_POST['nome'])){
			$nome = seguranca($_POST['nome']);
                        }
			if(isset($_POST['email'])){
			$email = seguranca($_POST['email']);
                        }

			if(isset($_POST['cod_cidade'])){
			$cod_cidade = (int)$_POST['cod_cidade'];
			}

                        if(isset($_POST['cod_bairro'])){
			$cod_bairro = (int)$_POST['cod_bairro'];
			}

                        if(isset($_POST['cod_rua'])){
			$cod_rua = (int)$_POST['cod_rua'];
			}

			if(isset($_POST['complemento'])){
			$complemento = seguranca($_POST['complemento']);
			} else {
                        $complemento = NULL;
                        }

                        if(isset($_POST['numero'])){
			$numero = seguranca($_POST['numero']);
			} else {
                        $numero = NULL;
                        }

                        if(isset($_POST['cod_uf'])){
			$cod_uf = (int)$_POST['cod_uf'];
			}

			if(isset($_POST['telefone'])){
			$telefone = seguranca($_POST['telefone']);
			}

                        if(isset($_POST['cod_status'])){
			$cod_status = (int)$_POST['cod_status'];
			}

                        if(isset($_POST['cod_instituicao'])){
			$cod_instituicao = (int)$_POST['cod_instituicao'];
			}

                        if(isset($_POST['cep'])){
			$cep = seguranca($_POST['cep']);
			}
			
			if(isset($_POST['cod_cargo'])){
			$cod_cargo = seguranca($_POST['cod_cargo']);
			}
			
			if(isset($_POST['cargo'])){
			$cargo = seguranca($_POST['cargo']);
			}

                         if(isset($_POST['identidade'])){
			$identidade = seguranca($_POST['identidade']);
			}

			$funcionario->update_funcionario($nome, $email, $cod_cidade, $cod_bairro, $cod_rua, $complemento, $numero, $cod_uf, $telefone, $cod_status,$cod_funcionario,$cod_instituicao,$cep,$cargo,$cod_cargo,$identidade);

                        echo"&resultado=$funcionario->resultado";

		        break;


	}



}else{

//

}
?>
