<?php
	session_start();
	if (isset($_POST['acao'])){
		require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
		require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_turma.php");
		$turma = new Class_turma;
		$action = $_POST['acao'];

		switch ($action){
			case "insert_turma": {		
				
				if(!isset($_POST['3'])) $_POST['3'] = "0";
				if(!isset($_POST['4'])) $_POST['4'] = "0";
				if(!isset($_POST['6_1'])) $_POST['6_1'] = "0";
				if(!isset($_POST['6_2'])) $_POST['6_2'] = "0";
				if(!isset($_POST['6_3'])) $_POST['6_3'] = "0";
				if(!isset($_POST['6_4'])) $_POST['6_4'] = "0";
				if(!isset($_POST['6_5'])) $_POST['6_5'] = "0";
				if(!isset($_POST['6_6'])) $_POST['6_6'] = "0";
				if(!isset($_POST['6_7'])) $_POST['6_7'] = "0";
				if(!isset($_POST['6_8'])) $_POST['6_8'] = "0";
				if(!isset($_POST['6_9'])) $_POST['6_9'] = "0";
				if(!isset($_POST['6_10'])) $_POST['6_10'] = "0";
				if(!isset($_POST['6_11'])) $_POST['6_11'] = "0";
				if(!isset($_POST['7'])) $_POST['7'] = "0";
				if(!isset($_POST['8'])) $_POST['8'] = "0";
				if(!isset($_POST['9_1'])) $_POST['9_1'] = "0";
				if(!isset($_POST['9_2'])) $_POST['9_2'] = "0";
				if(!isset($_POST['9_3'])) $_POST['9_3'] = "0";
				if(!isset($_POST['9_4'])) $_POST['9_4'] = "0";
				if(!isset($_POST['9_5'])) $_POST['9_5'] = "0";
				if(!isset($_POST['9_6'])) $_POST['9_6'] = "0";
				if(!isset($_POST['9_7'])) $_POST['9_7'] = "0";
				if(!isset($_POST['9_8'])) $_POST['9_8'] = "0";
				if(!isset($_POST['9_9'])) $_POST['9_9'] = "0";
				if(!isset($_POST['9_10'])) $_POST['9_10'] = "0";
				if(!isset($_POST['9_11'])) $_POST['9_11'] = "0";
				if(!isset($_POST['9_12'])) $_POST['9_12'] = "0";
				if(!isset($_POST['9_13'])) $_POST['9_13'] = "0";
				if(!isset($_POST['9_14'])) $_POST['9_14'] = "0";
				if(!isset($_POST['9_15'])) $_POST['9_15'] = "0";
				if(!isset($_POST['9_16'])) $_POST['9_16'] = "0";
				if(!isset($_POST['9_17'])) $_POST['9_17'] = "0";
				if(!isset($_POST['9_20'])) $_POST['9_20'] = "0";
				if(!isset($_POST['9_21'])) $_POST['9_21'] = "0";
				if(!isset($_POST['9_23'])) $_POST['9_23'] = "0";
				if(!isset($_POST['9_25'])) $_POST['9_25'] = "0";
				if(!isset($_POST['9_26'])) $_POST['9_26'] = "0";
				if(!isset($_POST['9_27'])) $_POST['9_27'] = "0";
				if(!isset($_POST['9_99'])) $_POST['9_99'] = "0";
				
				$_cod_instituicao = $_SESSION['id_instituicao'];
				$_cod_curso = $_POST['cod_curso'];
				$_turno = $_POST['turno'];
				$_semestre = $_POST['semestre'];
				$_ano = $_POST['ano'];
				$_1_ = $_POST['1'];
				$_2_1_ = $_POST['2_1'];
				$_2_2_ = $_POST['2_2'];
				$_3_ = $_POST['3'];
				$_4_ = $_POST['4'];
				$_5_1_ = $_POST['5_1'];
				$_5_2_ = $_POST['5_2'];
				$_5_3_ = $_POST['5_3'];
				$_5_4_ = $_POST['5_4'];
				$_5_5_ = $_POST['5_5'];
				$_5_6_ = $_POST['5_6'];
				$_6_1_ = $_POST['6_1'];
				$_6_2_ = $_POST['6_2'];
				$_6_3_ = $_POST['6_3'];
				$_6_4_ = $_POST['6_4'];
				$_6_5_ = $_POST['6_5'];
				$_6_6_ = $_POST['6_6'];
				$_6_7_ = $_POST['6_7'];
				$_6_8_ = $_POST['6_8'];
				$_6_9_ = $_POST['6_9'];
				$_6_10_ = $_POST['6_10'];
				$_6_11_ = $_POST['6_11'];
				$_7_ = $_POST['7'];
				$_8_ = $_POST['8'];
				$_9_1_ = $_POST['9_1'];
				$_9_2_ = $_POST['9_2'];
				$_9_3_ = $_POST['9_3'];
				$_9_4_ = $_POST['9_4'];
				$_9_5_ = $_POST['9_5'];
				$_9_6_ = $_POST['9_6'];
				$_9_7_ = $_POST['9_7'];
				$_9_8_ = $_POST['9_8'];
				$_9_9_ = $_POST['9_9'];
				$_9_10_ = $_POST['9_10'];
				$_9_11_ = $_POST['9_11'];
				$_9_12_ = $_POST['9_12'];
				$_9_13_ = $_POST['9_13'];
				$_9_14_ = $_POST['9_14'];
				$_9_15_ = $_POST['9_15'];
				$_9_16_ = $_POST['9_16'];
				$_9_17_ = $_POST['9_17'];
				$_9_20_ = $_POST['9_20'];
				$_9_21_ = $_POST['9_21'];
				$_9_23_ = $_POST['9_23'];
				$_9_25_ = $_POST['9_25'];
				$_9_26_ = $_POST['9_26'];
				$_9_27_ = $_POST['9_27'];
				$_9_99_ = $_POST['9_99'];
				$_8_1_ = $_POST['8_1_'];
				$_8_2_ = $_POST['8_2_'];
				$_8_3_ = $_POST['8_3_'];
				$res = $turma->insert_turma($_cod_instituicao, $_cod_curso, $_turno, $_semestre, $_ano, $_1_, $_2_1_, $_2_2_, $_3_, $_4_, $_5_1_, $_5_2_, $_5_3_, $_5_4_, $_5_5_, $_5_6_, $_6_1_, $_6_2_, $_6_3_,
								  $_6_4_, $_6_5_, $_6_6_, $_6_7_, $_6_8_, $_6_9_, $_6_10_, $_6_11_, $_7_, $_8_, $_9_1_, $_9_2_, $_9_3_, $_9_4_, $_9_5_, $_9_6_, $_9_7_, $_9_8_, $_9_9_, $_9_10_, $_9_11_, $_9_12_,
								  $_9_13_, $_9_14_, $_9_15_, $_9_16_, $_9_17_, $_9_20_, $_9_21_, $_9_23_, $_9_25_, $_9_26_, $_9_27_, $_9_99_, $_8_1_, $_8_2_, $_8_3_);
				header("Location: /paginas/cadastro_turma.php?sucesso=0");
			} break;

			case "update_turma": {
				if(!isset($_POST['3'])) $_POST['3'] = "0";
				if(!isset($_POST['4'])) $_POST['4'] = "0";
				if(!isset($_POST['6_1'])) $_POST['6_1'] = "0";
				if(!isset($_POST['6_2'])) $_POST['6_2'] = "0";
				if(!isset($_POST['6_3'])) $_POST['6_3'] = "0";
				if(!isset($_POST['6_4'])) $_POST['6_4'] = "0";
				if(!isset($_POST['6_5'])) $_POST['6_5'] = "0";
				if(!isset($_POST['6_6'])) $_POST['6_6'] = "0";
				if(!isset($_POST['6_7'])) $_POST['6_7'] = "0";
				if(!isset($_POST['6_8'])) $_POST['6_8'] = "0";
				if(!isset($_POST['6_9'])) $_POST['6_9'] = "0";
				if(!isset($_POST['6_10'])) $_POST['6_10'] = "0";
				if(!isset($_POST['6_11'])) $_POST['6_11'] = "0";
				if(!isset($_POST['7'])) $_POST['7'] = "0";
				if(!isset($_POST['8'])) $_POST['8'] = "0";
				if(!isset($_POST['9_1'])) $_POST['9_1'] = "0";
				if(!isset($_POST['9_2'])) $_POST['9_2'] = "0";
				if(!isset($_POST['9_3'])) $_POST['9_3'] = "0";
				if(!isset($_POST['9_4'])) $_POST['9_4'] = "0";
				if(!isset($_POST['9_5'])) $_POST['9_5'] = "0";
				if(!isset($_POST['9_6'])) $_POST['9_6'] = "0";
				if(!isset($_POST['9_7'])) $_POST['9_7'] = "0";
				if(!isset($_POST['9_8'])) $_POST['9_8'] = "0";
				if(!isset($_POST['9_9'])) $_POST['9_9'] = "0";
				if(!isset($_POST['9_10'])) $_POST['9_10'] = "0";
				if(!isset($_POST['9_11'])) $_POST['9_11'] = "0";
				if(!isset($_POST['9_12'])) $_POST['9_12'] = "0";
				if(!isset($_POST['9_13'])) $_POST['9_13'] = "0";
				if(!isset($_POST['9_14'])) $_POST['9_14'] = "0";
				if(!isset($_POST['9_15'])) $_POST['9_15'] = "0";
				if(!isset($_POST['9_16'])) $_POST['9_16'] = "0";
				if(!isset($_POST['9_17'])) $_POST['9_17'] = "0";
				if(!isset($_POST['9_20'])) $_POST['9_20'] = "0";
				if(!isset($_POST['9_21'])) $_POST['9_21'] = "0";
				if(!isset($_POST['9_23'])) $_POST['9_23'] = "0";
				if(!isset($_POST['9_25'])) $_POST['9_25'] = "0";
				if(!isset($_POST['9_26'])) $_POST['9_26'] = "0";
				if(!isset($_POST['9_27'])) $_POST['9_27'] = "0";
				if(!isset($_POST['9_99'])) $_POST['9_99'] = "0";
				
				$_cod_turma = (int)$_POST['cod_turma'];
				$_cod_instituicao = $_SESSION['id_instituicao'];
				$_cod_curso = $_POST['cod_curso'];
				$_turno = $_POST['turno'];
				$_semestre = $_POST['semestre'];
				$_ano = $_POST['ano'];
				$_1_ = $_POST['1'];
				$_2_1_ = $_POST['2_1'];
				$_2_2_ = $_POST['2_2'];
				$_3_ = $_POST['3'];
				$_4_ = $_POST['4'];
				$_5_1_ = $_POST['5_1'];
				$_5_2_ = $_POST['5_2'];
				$_5_3_ = $_POST['5_3'];
				$_5_4_ = $_POST['5_4'];
				$_5_5_ = $_POST['5_5'];
				$_5_6_ = $_POST['5_6'];
				$_6_1_ = $_POST['6_1'];
				$_6_2_ = $_POST['6_2'];
				$_6_3_ = $_POST['6_3'];
				$_6_4_ = $_POST['6_4'];
				$_6_5_ = $_POST['6_5'];
				$_6_6_ = $_POST['6_6'];
				$_6_7_ = $_POST['6_7'];
				$_6_8_ = $_POST['6_8'];
				$_6_9_ = $_POST['6_9'];
				$_6_10_ = $_POST['6_10'];
				$_6_11_ = $_POST['6_11'];
				$_7_ = $_POST['7'];
				$_8_ = $_POST['8'];
				$_9_1_ = $_POST['9_1'];
				$_9_2_ = $_POST['9_2'];
				$_9_3_ = $_POST['9_3'];
				$_9_4_ = $_POST['9_4'];
				$_9_5_ = $_POST['9_5'];
				$_9_6_ = $_POST['9_6'];
				$_9_7_ = $_POST['9_7'];
				$_9_8_ = $_POST['9_8'];
				$_9_9_ = $_POST['9_9'];
				$_9_10_ = $_POST['9_10'];
				$_9_11_ = $_POST['9_11'];
				$_9_12_ = $_POST['9_12'];
				$_9_13_ = $_POST['9_13'];
				$_9_14_ = $_POST['9_14'];
				$_9_15_ = $_POST['9_15'];
				$_9_16_ = $_POST['9_16'];
				$_9_17_ = $_POST['9_17'];
				$_9_20_ = $_POST['9_20'];
				$_9_21_ = $_POST['9_21'];
				$_9_23_ = $_POST['9_23'];
				$_9_25_ = $_POST['9_25'];
				$_9_26_ = $_POST['9_26'];
				$_9_27_ = $_POST['9_27'];
				$_9_99_ = $_POST['9_99'];
				$_8_1_ = $_POST['8_1_'];
				$_8_2_ = $_POST['8_2_'];
				$_8_3_ = $_POST['8_3_'];
				$turma->update_turma($_cod_turma, $_cod_instituicao, $_cod_curso, $_turno, $_semestre, $_ano, $_1_, $_2_1_, $_2_2_, $_3_, $_4_, $_5_1_, $_5_2_, $_5_3_, $_5_4_, $_5_5_, $_5_6_, $_6_1_, $_6_2_, $_6_3_,
								  $_6_4_, $_6_5_, $_6_6_, $_6_7_, $_6_8_, $_6_9_, $_6_10_, $_6_11_, $_7_, $_8_, $_9_1_, $_9_2_, $_9_3_, $_9_4_, $_9_5_, $_9_6_, $_9_7_, $_9_8_, $_9_9_, $_9_10_, $_9_11_, $_9_12_,
								  $_9_13_, $_9_14_, $_9_15_, $_9_16_, $_9_17_, $_9_20_, $_9_21_, $_9_23_, $_9_25_, $_9_26_, $_9_27_, $_9_99_, $_8_1_, $_8_2_, $_8_3_);
				header("Location: /paginas/cadastro_turma.php?sucesso=1");
			} break;

			case "delete_turma": {
				$codigo = (int)$_POST['codigo'];
				$res = $turma->delete_turma($codigo);
				if($res == 2){
					header("Location: /paginas/cadastro_turma.php?sucesso=2");
				}
				else {
					header("Location: /paginas/cadastro_turma.php?sucesso=202");
				}
			} break;
		}
	}
?>
