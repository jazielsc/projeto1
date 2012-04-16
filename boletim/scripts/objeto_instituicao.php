<?php


	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_instituicao.php");
        $instituicao = new Class_instituicao;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "insert_instituicao":

			

			
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

                        if(isset($_POST['cep'])){
			$cep = seguranca($_POST['cep']);
			}

                        if(isset($_POST['responsavel'])){
			$responsavel = seguranca($_POST['responsavel']);
			}

                        if(isset($_POST['mensalidade'])){
			$mensalidade = seguranca($_POST['mensalidade']);
			}

                        if(isset($_POST['contrato'])){
			$contrato = seguranca($_POST['contrato']);
			}

                        if(isset($_POST['data_ass'])){
			$data_ass = seguranca($_POST['data_ass']);
			}

                        if(isset($_POST['dia_base'])){
			$dia_base = seguranca($_POST['dia_base']);
			}

                        if(isset($_POST['pagamento'])){
			$pagamento = seguranca($_POST['pagamento']);
			}

                        if(isset($_POST['parcelas'])){
			$parcelas = seguranca($_POST['parcelas']);
			}

                        if(isset($_POST['pasta'])){
			$pasta = seguranca($_POST['pasta']);
			}

                        if(isset($_POST['adesao'])){
			$adesao = seguranca($_POST['adesao']);
			}

                        
			$instituicao->insert_instituicao($nome, $email, $cod_cidade, $cod_bairro, $cod_rua, $complemento, $numero, $cod_uf, $telefone, $cod_status, $cep, $responsavel, $mensalidade, $contrato, $data_ass, $dia_base, $pagamento, $parcelas, $adesao, $pasta, $file, $tipo);
                        
                        echo"&resultado=$instituicao->resultado";
                        echo"&cod_instituicao=$instituicao->cod_instituicao";
                        


		        break;

                        case "select_grid_instituicao":

                        $instituicao->select_grid_instituicao();

                        break;

                    case "select_grid_instituicao_free":

                        $instituicao->select_grid_instituicao_free();

                        break;

                        case "select_instituicao":

                        if(isset($_POST['cod_instituicao'])){
			$cod_instituicao = (int)$_POST['cod_instituicao'];
			}

                        $instituicao->select_instituicao($cod_instituicao);
                        echo"&resultado=$instituicao->resultado";

                        break;

                        case "update_instituicao":


                        if(isset($_POST['cod_instituicao'])){
			$cod_instituicao = (int)$_POST['cod_instituicao'];
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

                        if(isset($_POST['cep'])){
			$cep = seguranca($_POST['cep']);
			}

                        if(isset($_POST['responsavel'])){
			$responsavel = seguranca($_POST['responsavel']);
			}

                        if(isset($_POST['mensalidade'])){
			$mensalidade = seguranca($_POST['mensalidade']);
			}

                        if(isset($_POST['contrato'])){
			$contrato = seguranca($_POST['contrato']);
			}

                        if(isset($_POST['data_ass'])){
			$data_ass = seguranca($_POST['data_ass']);
			}

                        if(isset($_POST['dia_base'])){
			$dia_base = seguranca($_POST['dia_base']);
			}

                        if(isset($_POST['pagamento'])){
			$pagamento = seguranca($_POST['pagamento']);
			}

                        if(isset($_POST['parcelas'])){
			$parcelas = seguranca($_POST['parcelas']);
			}

                        if(isset($_POST['pasta'])){
			$pasta = seguranca($_POST['pasta']);
			}

                        if(isset($_POST['adesao'])){
			$adesao = seguranca($_POST['adesao']);
			}

                        
			$instituicao->update_instituicao($nome, $email, $cod_cidade, $cod_bairro, $cod_rua, $complemento, $numero, $cod_uf, $telefone, $cod_status, $cod_instituicao, $cep, $responsavel, $mensalidade, $contrato, $data_ass, $dia_base, $pagamento, $parcelas, $adesao, $pasta);

                        echo"&resultado=$instituicao->resultado";

		        break;

                        case "update_config":
                        

                        if(isset($_POST['media'])){
			$media = seguranca($_POST['media']);
			}

                        if(isset($_POST['cod_tipo'])){
			$cod_tipo = seguranca($_POST['cod_tipo']);
			}

                        if(isset($_POST['ranking'])){
			$ranking = seguranca($_POST['ranking']);
			}

                        if(isset($_POST['cod_paralela'])){
			$cod_paralela = seguranca($_POST['cod_paralela']);
			}

                       
                        $instituicao->update_config($media, $cod_tipo, $ranking,$cod_paralela);

                         echo"&resultado=ok";


                        break;
	
                        
        }



}else{

//

}
?>
