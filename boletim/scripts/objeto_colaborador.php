<?php


	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_colaborador.php");
        $colaborador = new Class_colaborador;
	$action = $_POST['acao'];

	switch ($action)
	{

			case "insert_colaborador":

						
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

                        if(isset($_POST['cep'])){
			$cep = seguranca($_POST['cep']);
			}
			
			$professor->insert_professor($nome, $email, $cod_cidade, $cod_bairro, $cod_rua, $complemento, $numero, $cod_uf, $telefone, $celular, $cod_status,$cod_instituicao,$cep);
                        
                        echo"&resultado=$professor->resultado";

		        break;

                        case "select_grid_colaborador":

                        $colaborador->select_grid_colaborador();

                        break;

                        case "select_colaborador":

                        if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

                        $professor->select_professor($cod_professor);
                        echo"&resultado=$professor->resultado";

                        break;

                        case "update_professor":


                        if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
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


			$professor->update_professor($nome, $email, $cod_cidade, $cod_bairro, $cod_rua, $complemento, $numero, $cod_uf, $telefone, $cod_status,$cod_professor,$cod_instituicao,$cep);

                        echo"&resultado=$professor->resultado";

		        break;

                        case "select_grid_disciplina":

                        if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

                        $professor->select_grid_disciplina($cod_professor);

                        break;

                        case "insert_plano_aula":



			if(isset($_POST['dia'])){
			$dia = seguranca($_POST['dia']);
                        }

                        if(isset($_POST['horainicio'])){
			$inicio = seguranca($_POST['horainicio']);
                        }

                        if(isset($_POST['horatermino'])){
			$termino = seguranca($_POST['horatermino']);
                        }

                        if(isset($_POST['horario'])){
			$calendario = seguranca($_POST['horario']);
                        }

                        if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

			if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        if(isset($_POST['dia_numero'])){
			$dia_numero = (int)$_POST['dia_numero'];
			}

                        if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                        if(isset($_POST['plano_aula'])){
			$plano_aula = seguranca($_POST['plano_aula']);
                        }

                        if(isset($_POST['atividades'])){
			$atividades = seguranca($_POST['atividades']);
                        }


			$professor->insert_plano_aula($dia, $inicio, $termino, $cod_turma, $cod_disciplina, $cod_professor, $calendario, $dia_numero, $cod_curso, $plano_aula, $atividades);

                        echo"&resultado=$professor->resultado";

		        break;

                        case "update_plano_aula":

                            if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}


			if(isset($_POST['dia'])){
			$dia = seguranca($_POST['dia']);
                        }

                        if(isset($_POST['horainicio'])){
			$inicio = seguranca($_POST['horainicio']);
                        }

                        if(isset($_POST['horatermino'])){
			$termino = seguranca($_POST['horatermino']);
                        }

                        if(isset($_POST['horario'])){
			$calendario = seguranca($_POST['horario']);
                        }

                        if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

			if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        if(isset($_POST['dia_numero'])){
			$dia_numero = (int)$_POST['dia_numero'];
			}

                        if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                        if(isset($_POST['plano_aula'])){
			$plano_aula = seguranca($_POST['plano_aula']);
                        }

                        if(isset($_POST['atividades'])){
			$atividades = seguranca($_POST['atividades']);
                        }


			$professor->update_plano_aula($dia, $inicio, $termino, $cod_turma, $cod_disciplina, $cod_professor, $calendario, $dia_numero, $cod_curso, $codigo, $plano_aula, $atividades);

                        echo"&resultado=$professor->resultado";

		        break;


                        case "select_plano_aula":

                         if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $professor->select_plano_aula($codigo);

                        echo"&resultado=$professor->resultado";

                        break;

                        case "select_grid_plano_aula":

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        $professor->select_grid_plano_aula($cod_turma);

                        echo"&resultado=$professor->resultado";

                        break;

                        case "select_grid_plano_aula_professor":


                        if(isset($_POST['semestre'])){
			$semestre = (int)$_POST['semestre'];
			}

                        if(isset($_POST['datas'])){
			$datas = $_POST['datas'];
			}

                        if(isset($_POST['disciplina'])){
			$disciplina = (int)$_POST['disciplina'];
			}


                        $professor->select_grid_plano_aula_professor($semestre, $datas, $disciplina);

                        echo"&resultado=$professor->resultado";

                        break;

                        case "consulta_plano_aula":


                        if(isset($_POST['semestre'])){
			$semestre = (int)$_POST['semestre'];
			}

                        if(isset($_POST['datas'])){
			$datas = $_POST['datas'];
			}

                        if(isset($_POST['cod_professor'])){
			$cod_professor = $_POST['cod_professor'];
			}

                        if(isset($_POST['disciplina'])){
			$disciplina = (int)$_POST['disciplina'];
			}


                        $professor->consulta_plano_aula($semestre, $datas, $disciplina, $cod_professor);

                        echo"&resultado=$professor->resultado";

                        break;

                        case "delete_plano_aula":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        $professor->delete_plano_aula($codigo, $cod_turma);
                        echo"&resultado=$professor->resultado";

                        break;

                      
	}



}else{

//

}
?>
