<?php


	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_aluno.php");
        $aluno = new Class_aluno;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "insert_aluno":

			

			
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

                        if(isset($_POST['celular'])){
			$celular = seguranca($_POST['celular']);
			}

                        if(isset($_POST['cod_status'])){
			$cod_status = (int)$_POST['cod_status'];
			}

                        if(isset($_POST['cod_instituicao'])){
			$cod_instituicao = (int)$_POST['cod_instituicao'];
			}

                        if(isset($_POST['matricula'])){
			$matricula = (int)$_POST['matricula'];
			}

                        if(isset($_POST['cep'])){
			$cep = seguranca($_POST['cep']);
			}

                        if(isset($_POST['opcao'])){
			$opcao = seguranca($_POST['opcao']);
			}

                        if(isset($_POST['responsavel'])){
			$responsavel = seguranca($_POST['responsavel']);
			}

                        if(isset($_POST['email_responsavel'])){
			$email_responsavel = seguranca($_POST['email_responsavel']);
			}

                        if(isset($_POST['cod_curso'])){
			$cod_curso = (int) $_POST['cod_curso'];
			}

                        if(isset($_POST['identidade'])){
			$identidade = seguranca($_POST['identidade']);
			}

                        if(isset($_POST['datanasc'])){
			$datanasc = seguranca($_POST['datanasc']);
			}

			
			$aluno->insert_aluno($nome, $email, $cod_cidade, $cod_bairro, $cod_rua, $complemento, $numero, $cod_uf, $telefone, $cod_status,$cod_instituicao,$matricula,$cep,$responsavel, $email_responsavel, $cod_curso,$identidade,$datanasc,$celular,$opcao);
                        
                        echo"&resultado=$aluno->resultado";

                         echo"&cod_aluno=$aluno->cod_aluno";

		        break;

                        case "select_grid_aluno":

                        $aluno->select_grid_aluno();

                        break;

                        case "select_aluno":

                        if(isset($_POST['cod_aluno'])){
			$cod_aluno = (int)$_POST['cod_aluno'];
			}

                        $aluno->select_aluno($cod_aluno);
                        echo"&resultado=$aluno->resultado";

                        break;

                        case "update_aluno":


                        if(isset($_POST['cod_aluno'])){
			$cod_aluno = (int)$_POST['cod_aluno'];
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

                        if(isset($_POST['celular'])){
			$celular = seguranca($_POST['celular']);
			}

                        if(isset($_POST['cod_status'])){
			$cod_status = (int)$_POST['cod_status'];
			}

                        if(isset($_POST['cod_instituicao'])){
			$cod_instituicao = (int)$_POST['cod_instituicao'];
			}

                        if(isset($_POST['matricula'])){
			$matricula = (int)$_POST['matricula'];
			}

                        if(isset($_POST['cep'])){
			$cep = seguranca($_POST['cep']);
			}

                        if(isset($_POST['responsavel'])){
			$responsavel = seguranca($_POST['responsavel']);
			}

                        if(isset($_POST['email_responsavel'])){
			$email_responsavel = seguranca($_POST['email_responsavel']);
			}

                        if(isset($_POST['cod_curso'])){
			$cod_curso = (int) $_POST['cod_curso'];
			}

                        if(isset($_POST['identidade'])){
			$identidade = seguranca($_POST['identidade']);
			}

                        if(isset($_POST['datanasc'])){
			$datanasc = seguranca($_POST['datanasc']);
			}

			$aluno->update_aluno($nome, $email, $cod_cidade, $cod_bairro, $cod_rua, $complemento, $numero, $cod_uf, $telefone, $cod_status,$cod_aluno,$cod_instituicao,$matricula,$cep,$responsavel,$email_responsavel,$cod_curso,$identidade,$datanasc,$celular);

                        echo"&resultado=$aluno->resultado";

                        
		        break;


                        case "select_grid_plano_aula_aluno":

                            
                        if(isset($_POST['semestre'])){
			$semestre = (int)$_POST['semestre'];
			}
                        
                        if(isset($_POST['datas'])){
			$datas = $_POST['datas'];
			}

                        if(isset($_POST['disciplina'])){
			$disciplina = (int)$_POST['disciplina'];
			}


                        $aluno->select_grid_plano_aula_aluno($semestre, $datas, $disciplina);

                        break;


	}



}else{

//

}
?>
