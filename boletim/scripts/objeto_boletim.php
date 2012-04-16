<?php


	if (isset($_POST['acao']))
{



	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_boletim.php");
        $boletim = new Class_boletim;
	$action = $_POST['acao'];

	switch ($action)
	{



                        case "select_notas":

                        if(isset($_POST['cod_boletim'])){
			$cod_boletim = (int)$_POST['cod_boletim'];
			}

                        $boletim->select_notas($cod_boletim);

                        echo"&resultado=$boletim->resultado";


                        break;

                        case "delete_notas":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                         if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

			if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}


			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                         if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        if(isset($_POST['select'])){
			$select = seguranca($_POST['select']);
                        } else{
                            $select = 1;
                        }


                        $boletim->delete_notas($codigo,$cod_professor,$cod_curso,$cod_turma,$cod_disciplina,$select);

                        echo"&resultado=$boletim->resultado";

                        break;

                        case "select_grid_notas":

                         if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

			if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}


			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                         if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        $boletim->select_grid_notas($cod_professor, $cod_curso, $cod_turma, $cod_disciplina);

                         echo"&resultado=$boletim->resultado";

                        break;

                        case "select_grid_notas_aluno":

                         if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

			if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}


			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                        if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        if(isset($_POST['cod_aluno'])){
			$cod_aluno = (int)$_POST['cod_aluno'];
			}


                        $boletim->select_grid_notas_aluno($cod_professor, $cod_curso, $cod_turma, $cod_disciplina, $cod_aluno);

                         echo"&resultado=$boletim->resultado";

                        break;



                        case "select_grid_boletim":


			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                         if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        if(isset($_POST['semestre'])){
			$semestre = (int)$_POST['semestre'];
			}else{
                        $semestre = "";
                        }

                        $boletim->select_grid_boletim($cod_curso, $cod_turma,$semestre);

                         echo"&resultado=$boletim->resultado";

                        break;

                        case "select_grid_boletim_aluno":


			if(isset($_POST['cod_aluno'])){
			$cod_aluno = (int)$_POST['cod_aluno'];
			}

                        if(isset($_POST['semestre'])){
			$semestre = (int)$_POST['semestre'];
			}else{
                        $semestre = "";
                        }

                        if(isset($_POST['ano'])){
			$ano = (int)$_POST['ano'];
			} else{
                            $ano = date("Y");
                        }

                        $boletim->select_grid_boletim_aluno($cod_aluno,$semestre,$ano);

                         echo"&resultado=$boletim->resultado";

                        break;


                        case "insert_notas":

			            			
			if(isset($_POST['cod_aluno'])){
			$cod_aluno = (int)$_POST['cod_aluno'];
                        }
			          
                        if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}
			
			if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}


			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                         if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}
			
			if(isset($_POST['nota_1'])){
			$nota_1 = seguranca($_POST['nota_1']);
                        } else {

                        $nota_1 = 0;

                        }
			
			if(isset($_POST['nota_2'])){
			$nota_2 = seguranca($_POST['nota_2']);
                        } else {

                        $nota_2 = 0;

                        }
			
			if(isset($_POST['nota_3'])){
			$nota_3 = seguranca($_POST['nota_3']);
                        }else {

                        $nota_3 = 0;
                        }
			
			if(isset($_POST['nota_4'])){
			$nota_4 = seguranca($_POST['nota_4']);
                        }else {

                         $nota_4 = 0;
                        }
			
			if(isset($_POST['nota_5']) or $_POST['nota_5'] == "" ){
			$nota_5 = seguranca($_POST['nota_5']);
                        } else {

                        $nota_5 = 0;
                        }


                        if(isset($_POST['nota_6'])){
			$nota_6 = seguranca($_POST['nota_6']);
                        }else{

                        $nota_6 = 0;
                        }


                        if(isset($_POST['numero_avaliacoes'])){

                            $numero_avaliacoes = (int)$_POST['numero_avaliacoes'];
                        }
			
						
			if(isset($_POST['faltas'])){
			$faltas = seguranca($_POST['faltas']);
                        }

                        if(isset($_POST['unidade'])){
			$unidade = seguranca($_POST['unidade']);
                        }

                        if(isset($_POST['select'])){
			$select = seguranca($_POST['select']);
                        } else{
                            $select = 1;
                        }

                        
			$boletim->insert_notas($nota_1,$nota_2,$nota_3,$nota_4,$nota_5,$nota_6,$numero_avaliacoes,$faltas,$cod_aluno,$cod_professor,$cod_curso,$cod_turma,$cod_disciplina,$unidade,$select);
                        
                        echo"&resultado=$boletim->resultado";

		        break;


                        case "update_notas":


                        if(isset($_POST['codigo'])){
                        
			$codigo = (int)$_POST['codigo'];
			}

			if(isset($_POST['cod_aluno'])){
			$cod_aluno = seguranca($_POST['cod_aluno']);
                        }

                        if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

			if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}


			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                         if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

			if(isset($_POST['nota_1'])){
			$nota_1 = seguranca($_POST['nota_1']);
                        } else {

                        $nota_1 = 0;

                        }

			if(isset($_POST['nota_2'])){
			$nota_2 = seguranca($_POST['nota_2']);
                        } else {

                        $nota_2 = 0;

                        }

			if(isset($_POST['nota_3'])){
			$nota_3 = seguranca($_POST['nota_3']);
                        }else {

                        $nota_3 = 0;
                        }

			if(isset($_POST['nota_4'])){
			$nota_4 = seguranca($_POST['nota_4']);
                        }else {

                         $nota_4 = 0;
                        }

			if(isset($_POST['nota_5']) or $_POST['nota_5'] == "" ){
			$nota_5 = seguranca($_POST['nota_5']);
                        } else {

                        $nota_5 = 0;
                        }


                        if(isset($_POST['nota_6'])){
			$nota_6 = seguranca($_POST['nota_6']);
                        }else{

                        $nota_6 = 0;
                        }


                        if(isset($_POST['numero_avaliacoes'])){

                            $numero_avaliacoes = (int)$_POST['numero_avaliacoes'];
                        }


                        if(isset($_POST['unidade'])){
			$unidade = seguranca($_POST['unidade']);
                        }


			if(isset($_POST['faltas'])){
			$faltas = seguranca($_POST['faltas']);
                        }

                        if(isset($_POST['select'])){
			$select = seguranca($_POST['select']);
                        } else{
                            $select = 1;
                        }

			$boletim->update_notas($nota_1,$nota_2,$nota_3,$nota_4,$nota_5,$nota_6,$numero_avaliacoes,$faltas,$cod_aluno,$cod_professor,$cod_curso,$cod_turma,$cod_disciplina,$codigo,$unidade,$select);

                        echo"&resultado=$boletim->resultado";
                        

		        break;


                        case "select_grid_alunos":
						
			if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

			if(isset($_POST['cod_disciplina'])){
			$cod_disciplina = (int)$_POST['cod_disciplina'];
			}

                        $boletim->select_grid_alunos($cod_disciplina,$cod_professor);

                        break;


                        case "select_grid_disciplina_professor":

			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

			if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        if(isset($_POST['cod_aluno'])){
			$cod_aluno = (int)$_POST['cod_aluno'];
			}

                        $boletim->select_grid_disciplina_professor($cod_curso,$cod_turma,$cod_aluno);

                        break;


                        case "ranking":


			if(isset($_POST['cod_curso'])){
			$cod_curso = (int)$_POST['cod_curso'];
			}

                         if(isset($_POST['cod_turma'])){
			$cod_turma = (int)$_POST['cod_turma'];
			}

                        $boletim->ranking($cod_curso, $cod_turma);

                         echo"&resultado=$boletim->resultado";

                        break;

                        case "select_disciplina":

                        if(isset($_POST['codigo'])){
			$codigo = (int)$_POST['codigo'];
			}

                        $disciplina->select_disciplina($codigo);
                        echo"&resultado=$disciplina->resultado";

                        break;

                        case "update_disciplina":

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
			
			$disciplina->update_disciplina($nome,$cod_professor,$cod_curso,$cod_turma,$codigo);

                        echo"&resultado=$disciplina->resultado";

		        break;


	}



}else{

//

}
?>
