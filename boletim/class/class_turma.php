<?php

class Class_turma{

     public $cod_turma;
     public $nome;
     public $data;
     public $cod_instituicao;
     public $cod_curso;
     public $turno;
     public $semestre;
     public $data_final;

                   
     public function insert_turma($_cod_instituicao, $_cod_curso, $_turno, $_semestre, $_ano, $_1_, $_2_1_, $_2_2_, $_3_, $_4_, $_5_1_, $_5_2_, $_5_3_, $_5_4_, $_5_5_, $_5_6_, $_6_1_, $_6_2_, $_6_3_,
								  $_6_4_, $_6_5_, $_6_6_, $_6_7_, $_6_8_, $_6_9_, $_6_10_, $_6_11_, $_7_, $_8_, $_9_1_, $_9_2_, $_9_3_, $_9_4_, $_9_5_, $_9_6_, $_9_7_, $_9_8_, $_9_9_, $_9_10_, $_9_11_, $_9_12_,
								  $_9_13_, $_9_14_, $_9_15_, $_9_16_, $_9_17_, $_9_20_, $_9_21_, $_9_23_, $_9_25_, $_9_26_, $_9_27_, $_9_99_, $_8_1_, $_8_2_, $_8_3_){
        /*BEGIN*/
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$consulta = mysql_query("INSERT INTO `turma`(`cod_instituicao`, `cod_curso`, `turno`, `semestre`, `ano`, `1_`, `2_1_`, `2_2_`, `3_`, `4_`, `5_1_`, `5_2_`, `5_3_`, `5_4_`, `5_5_`, `5_6_`, `6_1_`,`6_2_`, `6_3_`, `6_4_`, `6_5_`, `6_6_`, `6_7_`, `6_8_`, `6_9_`, `6_10_`, `6_11_`, `7_`, `8_`, `9_1_`, `9_2_`, `9_3_`, `9_4_`, `9_5_`, `9_6_`, `9_7_`, `9_8_`, `9_9_`, `9_10_`, `9_11_`, `9_12_`, `9_13_`, `9_14_`, `9_15_`, `9_16_`, `9_17_`, `9_20_`, `9_21_`, `9_23_`, `9_25_`, `9_26_`, `9_27_`, `9_99_`, `8_1_`, `8_2_`, `8_3_`)
									 VALUES ($_cod_instituicao, $_cod_curso, '$_turno', '$_semestre', '$_ano', '$_1_', '$_2_1_', '$_2_2_', '$_3_', '$_4_', '$_5_1_', '$_5_2_', '$_5_3_', '$_5_4_', '$_5_5_', '$_5_6_', '$_6_1_', '$_6_2_', '$_6_3_', '$_6_4_', '$_6_5_', '$_6_6_', '$_6_7_', '$_6_8_', '$_6_9_', '$_6_10_', '$_6_11_', '$_7_', '$_8_', '$_9_1_', '$_9_2_', '$_9_3_', '$_9_4_', '$_9_5_', '$_9_6_', '$_9_7_', '$_9_8_', '$_9_9_', '$_9_10_', '$_9_11_', '$_9_12_', '$_9_13_', '$_9_14_', '$_9_15_', '$_9_16_', '$_9_17_', '$_9_20_', '$_9_21_', '$_9_23_', '$_9_25_', '$_9_26_', '$_9_27_', '$_9_99_', '$_8_1_', '$_8_2_', '$_8_3_')") or die ("Erro insert ". mysql_erro());   
			return 0;
		/*END*/
     }

    public function update_turma($_cod_turma, $_cod_instituicao, $_cod_curso, $_turno, $_semestre, $_ano, $_1_, $_2_1_, $_2_2_, $_3_, $_4_, $_5_1_, $_5_2_, $_5_3_, $_5_4_, $_5_5_, $_5_6_, $_6_1_, $_6_2_, $_6_3_,
								  $_6_4_, $_6_5_, $_6_6_, $_6_7_, $_6_8_, $_6_9_, $_6_10_, $_6_11_, $_7_, $_8_, $_9_1_, $_9_2_, $_9_3_, $_9_4_, $_9_5_, $_9_6_, $_9_7_, $_9_8_, $_9_9_, $_9_10_, $_9_11_, $_9_12_,
								  $_9_13_, $_9_14_, $_9_15_, $_9_16_, $_9_17_, $_9_20_, $_9_21_, $_9_23_, $_9_25_, $_9_26_, $_9_27_, $_9_99_, $_8_1_, $_8_2_, $_8_3_){
		
		/*BEGIN*/
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");        
			$consulta = mysql_query("UPDATE `turma` SET `cod_instituicao`=$_cod_instituicao,`cod_curso`=$_cod_curso,`turno`='$_turno',`semestre`='$_semestre',`ano`='$_ano',
									`1_`='$_1_',`2_1_`='$_2_1_',`2_2_`='$_2_2_',`3_`='$_3_',`4_`='$_4_',`5_1_`='$_5_1_',`5_2_`='$_5_2_',`5_3_`='$_5_3_',`5_4_`='$_5_4_',`5_5_`='$_5_5_',`5_6_`='$_5_6_',`6_1_`='$_6_1_',`6_2_`='$_6_2_',`6_3_`='$_6_3_',`6_4_`='$_6_4_',
									`6_5_`='$_6_5_',`6_6_`='$_6_6_',`6_7_`='$_6_7_',`6_8_`='$_6_8_',`6_9_`='$_6_9_',`6_10_`='$_6_10_',`6_11_`='$_6_11_',`7_`='$_7_',`8_`='$_8_',`9_1_`='$_9_1_',`9_2_`='$_9_2_',`9_3_`='$_9_3_',`9_4_`='$_9_4_',`9_5_`='$_9_5_',`9_6_`='$_9_6_',
									`9_7_`='$_9_7_',`9_8_`='$_9_8_',`9_9_`='$_9_9_',`9_10_`='$_9_10_',`9_11_`='$_9_11_',`9_12_`='$_9_12_',`9_13_`='$_9_13_',`9_14_`='$_9_14_',`9_15_`='$_9_15_',`9_16_`='$_9_16_',`9_17_`='$_9_17_',`9_20_`='$_9_20_',`9_21_`='$_9_21_',
									`9_23_`='$_9_23_',`9_25_`='$_9_25_',`9_26_`='$_9_26_',`9_27_`='$_9_27_',`9_99_`='$_9_99_', `8_1_` = '$_8_1_', `8_2_` = '$_8_2_', `8_3_` = '$_8_3_'") or die ("Erro update". mysql_errno());
		/*END*/
    }

    public function delete_turma($codigo) {
        $cod_instituicao = (int) $_SESSION['id_instituicao'];        
        include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
        $query = mysql_query("SELECT cod_turma FROM disciplina WHERE cod_turma = '$codigo'") or die (mysql_error());
        $quant = mysql_num_rows($query);
		// se retornou então envia a mensagem
		if ($quant > 0) {
			return 202;
		}
		else {
			$query_delete = mysql_query("DELETE FROM turma WHERE cod_turma = '$codigo'");
			return 2;
		}
     }

}
?>
