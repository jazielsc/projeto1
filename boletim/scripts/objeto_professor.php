<?php
	session_start();
	if (isset($_POST['acao'])){

	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_professor.php");
    $professor = new Class_professor;
	$action = $_POST['acao'];

	switch ($action){
		case "insert_professor": {
			if(!isset($_POST['6'])) $_POST['6'] = "0";
			if(!isset($_POST['7'])) $_POST['7'] = "0";
			if(!isset($_POST['8'])) $_POST['8'] = "0";
			if(!isset($_POST['9'])) $_POST['9'] = "0";
			if(!isset($_POST['21_1'])) $_POST['21_1'] = "0";
			if(!isset($_POST['21_2'])) $_POST['21_2'] = "0";
			if(!isset($_POST['21_7'])) $_POST['21_7'] = "0";
			if(!isset($_POST['21_8'])) $_POST['21_8'] = "0";
			if(!isset($_POST['21_9'])) $_POST['21_9'] = "0";
			if(!isset($_POST['21_14'])) $_POST['21_14'] = "0";
			if(!isset($_POST['21_15'])) $_POST['21_15'] = "0";
			if(!isset($_POST['21_16'])) $_POST['21_16'] = "0";
			if(!isset($_POST['21_21'])) $_POST['21_21'] = "0";
			if(!isset($_POST['21_22'])) $_POST['21_22'] = "0";
			if(!isset($_POST['22'])) $_POST['22'] = "0";
			if(!isset($_POST['23_1'])) $_POST['23_1'] = "0";
			if(!isset($_POST['23_2'])) $_POST['23_2'] = "0";
			if(!isset($_POST['23_3'])) $_POST['23_3'] = "0";
			if(!isset($_POST['23_4'])) $_POST['23_4'] = "0";
			if(!isset($_POST['23_5'])) $_POST['23_5'] = "0";
			if(!isset($_POST['23_6'])) $_POST['23_6'] = "0";
			if(!isset($_POST['23_7'])) $_POST['23_7'] = "0";
			if(!isset($_POST['23_8'])) $_POST['23_8'] = "0";
			if(!isset($_POST['23_9'])) $_POST['23_9'] = "0";
			if(!isset($_POST['23_10'])) $_POST['23_10'] = "0";
			if(!isset($_POST['23_11'])) $_POST['23_11'] = "0";
			if(!isset($_POST['24'])) $_POST['24'] = "0";
			if(!isset($_POST['25'])) $_POST['25'] = "0";
			
			$cod_status = $_POST['cod_status'];
			$cod_instituicao = $_SESSION['id_instituicao'];
			$_1_ = $_POST['1'];
			$_2_ = $_POST['2'];
			$_3_ = $_POST['3'];
			$_4_ = $_POST['4'];
			$_5_ = $_POST['5'];
			$_6_ = $_POST['6'];
			$_7_ = $_POST['7'];
			$_8_ = $_POST['8'];
			$_9_ = $_POST['9'];
			$_10_ = $_POST['10'];
			$_11_ = $_POST['11'];
			$_12_ = $_POST['12'];
			$_13_ = $_POST['13'];
			$_14_ = $_POST['14'];
			$_15_ = $_POST['15'];
			$_16_ = $_POST['16'];
			$_17_ = $_POST['17'];
			$_18_ = $_POST['18'];
			$_19_ = $_POST['19'];
			$_20_ = $_POST['20'];
			$_21_1_ = $_POST['21_1'];
			$_21_2_ = $_POST['21_2'];
			$_21_3_ = $_POST['21_3'];
			$_21_4_ = $_POST['21_4'];
			$_21_5_ = $_POST['21_5'];
			$_21_6_ = $_POST['21_6'];
			$_21_7_ = $_POST['21_7'];
			$_21_8_ = $_POST['21_8'];
			$_21_9_ = $_POST['21_9'];
			$_21_10_ = $_POST['21_10'];
			$_21_11_ = $_POST['21_11'];
			$_21_12_ = $_POST['21_12'];
			$_21_13_ = $_POST['21_13'];
			$_21_14_ = $_POST['21_14'];
			$_21_15_ = $_POST['21_15'];
			$_21_16_ = $_POST['21_16'];
			$_21_17_ = $_POST['21_17'];
			$_21_18_ = $_POST['21_18'];
			$_21_19_ = $_POST['21_19'];
			$_21_20_ = $_POST['21_20'];
			$_21_21_ = $_POST['21_21'];
			$_21_22_ = $_POST['21_22'];
			$_22_ = $_POST['22'];
			$_23_1_ = $_POST['23_1'];
			$_23_2_ = $_POST['23_2'];
			$_23_3_ = $_POST['23_3'];
			$_23_4_ = $_POST['23_4'];
			$_23_5_ = $_POST['23_5'];
			$_23_6_ = $_POST['23_6'];
			$_23_7_ = $_POST['23_7'];
			$_23_8_ = $_POST['23_8'];
			$_23_9_ = $_POST['23_9'];
			$_23_10_ = $_POST['23_10'];
			$_23_11_ = $_POST['23_11'];
			$_24_ = $_POST['24'];
			$_25_ = $_POST['25'];
			$_26_1_ = $_POST['26_1'];
			$_26_2_ = $_POST['26_2'];
			$_26_3_ = $_POST['26_3'];
			$_26_4_ = $_POST['26_4'];
			$_26_5_ = $_POST['26_5'];
			$_26_6_ = $_POST['26_6'];
			$_27_1_1_ = $_POST['27_1_1'];
			$_27_1_2_ = $_POST['27_1_2'];
			$_27_1_3_ = $_POST['27_1_3'];
			$_27_1_4_ = $_POST['27_1_4'];
			$_27_1_5_ = $_POST['27_1_5'];
			$_27_1_6_ = $_POST['27_1_6'];
			$_27_1_7_ = $_POST['27_1_7'];
			$_27_2_1_ = $_POST['27_2_1'];
			$_27_2_2_ = $_POST['27_2_2'];
			$_27_2_3_ = $_POST['27_2_3'];
			$_27_2_4_ = $_POST['27_2_4'];
			$_27_2_5_ = $_POST['27_2_5'];
			$_27_2_6_ = $_POST['27_2_6'];
			$_27_2_7_ = $_POST['27_2_7'];
			$_27_3_1_ = $_POST['27_3_1'];
			$_27_3_2_ = $_POST['27_3_2'];
			$_27_3_3_ = $_POST['27_3_3'];
			$_27_3_4_ = $_POST['27_3_4'];
			$_27_3_5_ = $_POST['27_3_5'];
			$_27_3_6_ = $_POST['27_3_6'];
			$_27_3_7_ = $_POST['27_3_7'];
			$_27_4_1_ = $_POST['27_4_1'];
			$_27_4_2_ = $_POST['27_4_2'];
			$_27_4_3_ = $_POST['27_4_3'];
			$_27_4_4_ = $_POST['27_4_4'];
			$_27_4_5_ = $_POST['27_4_5'];
			$_27_4_6_ = $_POST['27_4_6'];
			$_27_4_7_ = $_POST['27_4_7'];
			$_27_5_1_ = $_POST['27_5_1'];
			$_27_5_2_ = $_POST['27_5_2'];
			$_27_5_3_ = $_POST['27_5_3'];
			$_27_5_4_ = $_POST['27_5_4'];
			$_27_5_5_ = $_POST['27_5_5'];
			$_27_5_6_ = $_POST['27_5_6'];
			$_27_5_7_ = $_POST['27_5_7'];
			$_27_6_1_ = $_POST['27_6_1'];
			$_27_6_2_ = $_POST['27_6_2'];
			$_27_6_3_ = $_POST['27_6_3'];
			$_27_6_4_ = $_POST['27_6_4'];
			$_27_6_5_ = $_POST['27_6_5'];
			$_27_6_6_ = $_POST['27_6_6'];
			$_27_6_7_ = $_POST['27_6_7'];
			$res = $professor->insert_professor($cod_status, $cod_instituicao, $_1_, $_2_, $_3_, $_4_, $_5_, $_6_, $_7_, $_8_, $_9_, $_10_, $_11_, $_12_, $_13_, $_14_, $_15_, $_16_, $_17_, $_18_, $_19_, $_20_, $_21_1_, $_21_2_,
									 $_21_3_, $_21_4_, $_21_5_, $_21_6_, $_21_7_, $_21_8_, $_21_9_, $_21_10_, $_21_11_, $_21_12_, $_21_13_, $_21_14_, $_21_15_, $_21_16_, $_21_17_, $_21_18_, $_21_19_, $_21_20_,
									 $_21_21_, $_21_22_, $_22_, $_23_1_, $_23_2_, $_23_3_, $_23_4_, $_23_5_, $_23_6_, $_23_7_, $_23_8_, $_23_9_, $_23_10_, $_23_11_, $_24_, $_25_, $_26_1_, $_26_2_, $_26_3_, $_26_4_,
									 $_26_5_, $_26_6_, $_27_1_1_, $_27_1_2_, $_27_1_3_, $_27_1_4_, $_27_1_5_, $_27_1_6_, $_27_1_7_, $_27_2_1_, $_27_2_2_, $_27_2_3_, $_27_2_4_, $_27_2_5_, $_27_2_6_, $_27_2_7_,
									 $_27_3_1_, $_27_3_2_, $_27_3_3_, $_27_3_4_, $_27_3_5_, $_27_3_6_, $_27_3_7_, $_27_4_1_, $_27_4_2_, $_27_4_3_, $_27_4_4_, $_27_4_5_, $_27_4_6_, $_27_4_7_, $_27_5_1_, $_27_5_2_,
									 $_27_5_3_, $_27_5_4_, $_27_5_5_, $_27_5_6_, $_27_5_7_, $_27_6_1_, $_27_6_2_, $_27_6_3_, $_27_6_4_, $_27_6_5_, $_27_6_6_, $_27_6_7_);
			if($res == 110){
				header("Location: /paginas/cadastro_professor.php?sucesso=110");
			}
			elseif($res == 0){
				header("Location: /paginas/cadastro_professor.php?sucesso=0");
			}
		} break;
			
		case "update_professor": {
			if(!isset($_POST['6'])) $_POST['6'] = "0";
			if(!isset($_POST['7'])) $_POST['7'] = "0";
			if(!isset($_POST['8'])) $_POST['8'] = "0";
			if(!isset($_POST['9'])) $_POST['9'] = "0";
			if(!isset($_POST['21_1'])) $_POST['21_1'] = "0";
			if(!isset($_POST['21_2'])) $_POST['21_2'] = "0";
			if(!isset($_POST['21_7'])) $_POST['21_7'] = "0";
			if(!isset($_POST['21_8'])) $_POST['21_8'] = "0";
			if(!isset($_POST['21_9'])) $_POST['21_9'] = "0";
			if(!isset($_POST['21_14'])) $_POST['21_14'] = "0";
			if(!isset($_POST['21_15'])) $_POST['21_15'] = "0";
			if(!isset($_POST['21_16'])) $_POST['21_16'] = "0";
			if(!isset($_POST['21_21'])) $_POST['21_21'] = "0";
			if(!isset($_POST['21_22'])) $_POST['21_22'] = "0";
			if(!isset($_POST['22'])) $_POST['22'] = "0";
			if(!isset($_POST['23_1'])) $_POST['23_1'] = "0";
			if(!isset($_POST['23_2'])) $_POST['23_2'] = "0";
			if(!isset($_POST['23_3'])) $_POST['23_3'] = "0";
			if(!isset($_POST['23_4'])) $_POST['23_4'] = "0";
			if(!isset($_POST['23_5'])) $_POST['23_5'] = "0";
			if(!isset($_POST['23_6'])) $_POST['23_6'] = "0";
			if(!isset($_POST['23_7'])) $_POST['23_7'] = "0";
			if(!isset($_POST['23_8'])) $_POST['23_8'] = "0";
			if(!isset($_POST['23_9'])) $_POST['23_9'] = "0";
			if(!isset($_POST['23_10'])) $_POST['23_10'] = "0";
			if(!isset($_POST['23_11'])) $_POST['23_11'] = "0";
			if(!isset($_POST['24'])) $_POST['24'] = "0";
			if(!isset($_POST['25'])) $_POST['25'] = "0";
			
			$cod_status = $_POST['cod_status'];
			$cod_instituicao = $_SESSION['id_instituicao'];
			$_1_ = $_POST['1'];
			$_2_ = $_POST['2'];
			$_3_ = $_POST['3'];
			$_4_ = $_POST['4'];
			$_5_ = $_POST['5'];
			$_6_ = $_POST['6'];
			$_7_ = $_POST['7'];
			$_8_ = $_POST['8'];
			$_9_ = $_POST['9'];
			$_10_ = $_POST['10'];
			$_11_ = $_POST['11'];
			$_12_ = $_POST['12'];
			$_13_ = $_POST['13'];
			$_14_ = $_POST['14'];
			$_15_ = $_POST['15'];
			$_16_ = $_POST['16'];
			$_17_ = $_POST['17'];
			$_18_ = $_POST['18'];
			$_19_ = $_POST['19'];
			$_20_ = $_POST['20'];
			$_21_1_ = $_POST['21_1'];
			$_21_2_ = $_POST['21_2'];
			$_21_3_ = $_POST['21_3'];
			$_21_4_ = $_POST['21_4'];
			$_21_5_ = $_POST['21_5'];
			$_21_6_ = $_POST['21_6'];
			$_21_7_ = $_POST['21_7'];
			$_21_8_ = $_POST['21_8'];
			$_21_9_ = $_POST['21_9'];
			$_21_10_ = $_POST['21_10'];
			$_21_11_ = $_POST['21_11'];
			$_21_12_ = $_POST['21_12'];
			$_21_13_ = $_POST['21_13'];
			$_21_14_ = $_POST['21_14'];
			$_21_15_ = $_POST['21_15'];
			$_21_16_ = $_POST['21_16'];
			$_21_17_ = $_POST['21_17'];
			$_21_18_ = $_POST['21_18'];
			$_21_19_ = $_POST['21_19'];
			$_21_20_ = $_POST['21_20'];
			$_21_21_ = $_POST['21_21'];
			$_21_22_ = $_POST['21_22'];
			$_22_ = $_POST['22'];
			$_23_1_ = $_POST['23_1'];
			$_23_2_ = $_POST['23_2'];
			$_23_3_ = $_POST['23_3'];
			$_23_4_ = $_POST['23_4'];
			$_23_5_ = $_POST['23_5'];
			$_23_6_ = $_POST['23_6'];
			$_23_7_ = $_POST['23_7'];
			$_23_8_ = $_POST['23_8'];
			$_23_9_ = $_POST['23_9'];
			$_23_10_ = $_POST['23_10'];
			$_23_11_ = $_POST['23_11'];
			$_24_ = $_POST['24'];
			$_25_ = $_POST['25'];
			$_26_1_ = $_POST['26_1'];
			$_26_2_ = $_POST['26_2'];
			$_26_3_ = $_POST['26_3'];
			$_26_4_ = $_POST['26_4'];
			$_26_5_ = $_POST['26_5'];
			$_26_6_ = $_POST['26_6'];
			$_27_1_1_ = $_POST['27_1_1'];
			$_27_1_2_ = $_POST['27_1_2'];
			$_27_1_3_ = $_POST['27_1_3'];
			$_27_1_4_ = $_POST['27_1_4'];
			$_27_1_5_ = $_POST['27_1_5'];
			$_27_1_6_ = $_POST['27_1_6'];
			$_27_1_7_ = $_POST['27_1_7'];
			$_27_2_1_ = $_POST['27_2_1'];
			$_27_2_2_ = $_POST['27_2_2'];
			$_27_2_3_ = $_POST['27_2_3'];
			$_27_2_4_ = $_POST['27_2_4'];
			$_27_2_5_ = $_POST['27_2_5'];
			$_27_2_6_ = $_POST['27_2_6'];
			$_27_2_7_ = $_POST['27_2_7'];
			$_27_3_1_ = $_POST['27_3_1'];
			$_27_3_2_ = $_POST['27_3_2'];
			$_27_3_3_ = $_POST['27_3_3'];
			$_27_3_4_ = $_POST['27_3_4'];
			$_27_3_5_ = $_POST['27_3_5'];
			$_27_3_6_ = $_POST['27_3_6'];
			$_27_3_7_ = $_POST['27_3_7'];
			$_27_4_1_ = $_POST['27_4_1'];
			$_27_4_2_ = $_POST['27_4_2'];
			$_27_4_3_ = $_POST['27_4_3'];
			$_27_4_4_ = $_POST['27_4_4'];
			$_27_4_5_ = $_POST['27_4_5'];
			$_27_4_6_ = $_POST['27_4_6'];
			$_27_4_7_ = $_POST['27_4_7'];
			$_27_5_1_ = $_POST['27_5_1'];
			$_27_5_2_ = $_POST['27_5_2'];
			$_27_5_3_ = $_POST['27_5_3'];
			$_27_5_4_ = $_POST['27_5_4'];
			$_27_5_5_ = $_POST['27_5_5'];
			$_27_5_6_ = $_POST['27_5_6'];
			$_27_5_7_ = $_POST['27_5_7'];
			$_27_6_1_ = $_POST['27_6_1'];
			$_27_6_2_ = $_POST['27_6_2'];
			$_27_6_3_ = $_POST['27_6_3'];
			$_27_6_4_ = $_POST['27_6_4'];
			$_27_6_5_ = $_POST['27_6_5'];
			$_27_6_6_ = $_POST['27_6_6'];
			$_27_6_7_ = $_POST['27_6_7'];
			$cod_professor = (int) $_POST['cod_professor'];
			$professor->update_professor($cod_professor, $cod_status, $cod_instituicao, $_1_, $_2_, $_3_, $_4_, $_5_, $_6_, $_7_, $_8_, $_9_, $_10_, $_11_, $_12_, $_13_, $_14_, $_15_, $_16_, $_17_, $_18_, $_19_, $_20_, $_21_1_, $_21_2_,
									 $_21_3_, $_21_4_, $_21_5_, $_21_6_, $_21_7_, $_21_8_, $_21_9_, $_21_10_, $_21_11_, $_21_12_, $_21_13_, $_21_14_, $_21_15_, $_21_16_, $_21_17_, $_21_18_, $_21_19_, $_21_20_,
									 $_21_21_, $_21_22_, $_22_, $_23_1_, $_23_2_, $_23_3_, $_23_4_, $_23_5_, $_23_6_, $_23_7_, $_23_8_, $_23_9_, $_23_10_, $_23_11_, $_24_, $_25_, $_26_1_, $_26_2_, $_26_3_, $_26_4_,
									 $_26_5_, $_26_6_, $_27_1_1_, $_27_1_2_, $_27_1_3_, $_27_1_4_, $_27_1_5_, $_27_1_6_, $_27_1_7_, $_27_2_1_, $_27_2_2_, $_27_2_3_, $_27_2_4_, $_27_2_5_, $_27_2_6_, $_27_2_7_,
									 $_27_3_1_, $_27_3_2_, $_27_3_3_, $_27_3_4_, $_27_3_5_, $_27_3_6_, $_27_3_7_, $_27_4_1_, $_27_4_2_, $_27_4_3_, $_27_4_4_, $_27_4_5_, $_27_4_6_, $_27_4_7_, $_27_5_1_, $_27_5_2_,
									 $_27_5_3_, $_27_5_4_, $_27_5_5_, $_27_5_6_, $_27_5_7_, $_27_6_1_, $_27_6_2_, $_27_6_3_, $_27_6_4_, $_27_6_5_, $_27_6_6_, $_27_6_7_);
			header("Location: /paginas/cadastro_professor.php?sucesso=1");
		} break;
	
		case "select_grid_disciplina":
                       if(isset($_POST['cod_professor'])){
			$cod_professor = (int)$_POST['cod_professor'];
			}

                        if(isset($_POST['ano'])){
			$ano = (int)$_POST['ano'];
			} else{
                            $ano = date("Y");
                        }

                        $professor->select_grid_disciplina($cod_professor,$ano);

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
