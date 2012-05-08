<?php


	class Class_instituicao{

		public function insert_instituicao($nome,$email,$cod_cidade,$cod_bairro,$cod_rua,$complemento,$numero,$cod_uf,$telefone,$cod_status,$cep,$responsavel,$mensalidade, $contrato, $data_ass, $dia_base, $pagamento, $parcelas, $adesao, $pasta, $file, $tipo){
			if(!empty($data_ass)){
				$data_ass = explode("/", $data_ass);
				$data_ass = $data_ass[2]."-".$data_ass[1]."-".$data_ass[0];
			}
			else {
				$data_ass = date("Y-m-d");
			}
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_select = mysql_query("SELECT cod_instituicao FROM instituicao WHERE nome = '$nome' or email = '$email'") or die ("Erro select ". mysql_errno());
			$query_select2 = mysql_query("SELECT cod_usuario FROM usuario WHERE email = '$email'") or die ("Erro select ". mysql_errno());
			$quant = mysql_num_rows($query_select);
			$quant2 = mysql_num_rows($query_select2);
			if ($quant > 0){
				$this->resultado = "NAO";
			}
			elseif($quant2 > 0){
				$this->resultado = "email_usuario";
			}
			else{
				$query_insert = mysql_query("INSERT INTO instituicao VALUE (NULL, '$nome','$email','$cod_cidade','$cod_bairro','$cod_rua','$complemento','$numero','$cod_uf','$telefone','$cod_status', '$cep', '$responsavel','$mensalidade', '$contrato', '$data_ass', '$dia_base', '$pagamento', '$parcelas', '$adesao','$pasta', '$file', '$tipo')") or die ("Erro insert ". mysql_errno());
				$query_consulta = mysql_query("SELECT cod_instituicao FROM instituicao ORDER BY cod_instituicao DESC LIMIT 1",$conn) or die ("Error na consulta");
				$resultado = mysql_fetch_array($query_consulta);
				mkdir ("/home/storage/7/23/a7/boletimflex/public_html/boletim/$pasta", 0755 );
				$fp = fopen("/home/storage/7/23/a7/boletimflex/public_html/boletim/$pasta/index.php", "a");
				$conteudo = '$_'."SESSION['id_instituicao'] = $resultado[0];";
				$escreve = fwrite($fp, "<?php
					session_start();
					$conteudo
					Header('Location: ../index.php');
					?>");
				$senha =  md5($pasta."123");
				$query_insert = mysql_query("INSERT INTO usuario VALUE (NULL, '$responsavel','$email','$senha',1,0,0,'$resultado[0]','$email')") or die ("Erro insert ". mysql_errno());
				$query_insert = mysql_query("INSERT INTO config VALUE (7,2,30,'$resultado[0]',1)") or die ("Erro insert ". mysql_errno());
				fclose($fp);
				$para = $email;
				$emailsender = "equipe@boletimflex.com";
				$str[0] = utf8_decode("Olá");
				$str[1] = utf8_decode("Instituição");
				$str[2] = utf8_decode("Área Restrita");
				$str[3] = utf8_decode("Direção");
				$assunto = "Cadastro Boletimflex!";
				$headers = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\n";
				$headers .= "From: boletimflex <equipe@boletimflex.com>\n";
				$headers .= "Return-Path: boletimflex <equipe@boletimflex.com>";
				$mensagem = "$str[0]!, $responsavel. <br /> <br />";
				$mensagem .= "Voce foi cadastrado pela $str[1] $nome no sistema boletimflex, abaixo segue seus dados de acesso! <br /> <br />";
				$mensagem .= "<a href=\"http://www.boletimflex.com/boletim/$pasta\">http://www.boletimflex.com/boletim/$pasta</a><br /> <br />";
				$mensagem .= "$str[2]: $str[3]. <br />";
				$mensagem .= "login: " .$email. "<br />";
				$mensagem .= "senha: " .$pasta."123";
				mail($para, $assunto, $mensagem, $headers,"-r".$emailsender) or die ("ERRO ao enviar mensagem!");
				$this->resultado = "ok";
				$this->cod_instituicao = $resultado[0];
			}
		}// fim do método

		public function update_instituicao($cod_instituicao, $_1, $_2a, $_2b, $_3, $_4, $_5, $_6, $_7, $_8, $_9, $_10, $_11, $_12, $_13, $_14, $_15, $_16, $_17, $_18, $_18a, $_19, $_20, $_21, $_21a, $_21b, $_21c, $_22_1, $_22_2, $_22_3, $_22_4, $_23, $_24, $_25, $_26, $_27, $_28, $_29, $_30_1, $_30_2, $_30_3, $_30_4, $_30_5, $_30_6, $_30_7, $_30_8, $_30a, $_31, $_31a_1, $_31a_2, $_31a_3, $_31a_4, $_31a_5, $_31a_6, $_32, $_33, $_34, $_35, $_36, $_37_1, $_37_2, $_37_3, $_37_4, $_37_5, $_37_6, $_37_7, $_37_8, $_37_9, $_37_10, $_37_11, $_37_12, $_37_13, $_37_14, $_37_15, $_37_16, $_37_17, $_37_18, $_38, $_39, $_40_1, $_40_2, $_40_3, $_40_4, $_40_5, $_40_6, $_40_7, $_41, $_41a, $_41b, $_41c, $_41d, $_41e, $_42, $_43, $_44, $_45, $_46, $_47_1, $_47_2, $_47_3, $_47_4, $_48, $_49, $_50, $_51, $_52, $_52_1){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			
			$data_nova = $_2a;
			$ano = $data_nova[6].$data_nova[7].$data_nova[8].$data_nova[9];
			$mes = $data_nova[3].$data_nova[4];
			$dia = $data_nova[0].$data_nova[1];
			$_2a = $ano."-".$mes."-".$dia;
			
			$data_nova = $_2b;
			$ano = $data_nova[6].$data_nova[7].$data_nova[8].$data_nova[9];
			$mes = $data_nova[3].$data_nova[4];
			$dia = $data_nova[0].$data_nova[1];
			$_2b = $ano."-".$mes."-".$dia;
			
			$query_insert = mysql_query("UPDATE instituicao SET `1_`='$_1',`2a_`='$_2a',
										`2b_`='$_2b',`3_`='$_3',`4_`='$_4',`5_`='$_5',`6_`='$_6',`7_`='$_7',`8_`='$_8',`9_`='$_9',`10_`='$_10',`11_`='$_11',`12_`='$_12',`13_`='$_13',`14_`='$_14',`15_`='$_15',
										`16_`='$_16',`17_`='$_17',`18_`='$_18',`18a_`='$_18a',`19_`='$_19',`20_`='$_20',`21_`='$_21',`21a_`='$_21a',`21b_`='$_21b',`21c_`='$_21c',`22_1_`='$_22_1',`22_2_`='$_22_2',`22_3_`='$_22_3',
										`22_4_`='$_22_4',`23_`='$_23',`24_`='$_24',`25_`='$_25',`26_`='$_26',`27_`='$_27',`28_`='$_28',`29_`='$_29',`30_1_`='$_30_1',`30_2_`='$_30_2',`30_3_`='$_30_3',`30_4_`='$_30_4',`30_5_`='$_30_5',
										`30_6_`='$_30_6',`30_7_`='$_30_7',`30_8_`='$_30_8',`30a_`='$_30a',`31_`='$_31',`31a_1_`='$_31a_1',`31a_2_`='$_31a_2',`31a_3_`='$_31a_3',`31a_4_`='$_31a_4',`31a_5_`='$_31a_5',`31a_6_`='$_31a_6',`32_`='$_32',
										`33_`='$_33',`34_`='$_34',`35_`='$_35',`36_`='$_36',`37_1_`='$_37_1',`37_2_`='$_37_2',`37_3_`='$_37_3',`37_4_`='$_37_4',`37_5_`='$_37_5',`37_6_`='$_37_6',`37_7_`='$_37_7',`37_8_`='$_37_8',
										`37_9_`='$_37_9',`37_10_`='$_37_10',`37_11_`='$_37_11',`37_12_`='$_37_12',`37_13_`='$_37_13',`37_14_`='$_37_14',`37_15_`='$_37_15',`37_16_`='$_37_16',`37_17_`='$_37_17',`37_18_`='$_37_18',`38_`='$_38',`39_`='$_39',
										`40_1_`='$_40_1',`40_2_`='$_40_2',`40_3_`='$_40_3',`40_4_`='$_40_4',`40_5_`='$_40_5',`40_6_`='$_40_6',`40_7_`='$_40_7',`41_`='$_41',`41a_`='$_41a',`41b_`='$_41b',`41c_`='$_41c',`41d_`='$_41d',
										`41e_`='$_41e',`42_`='$_42',`43_`='$_43',`44_`='$_44',`45_`='$_45',`46_`='$_46',`47_1_`='$_47_1',`47_2_`='$_47_2',`47_3_`='$_47_3',`47_4_`='$_47_4',`48_`='$_48',`49_`='$_49',`50_`='$_50',`51_`='$_51',
										`52_`='$_52',`52_1_`='$_52_1' WHERE cod_instituicao = $cod_instituicao") or die ("Erro insert ". mysql_errno());
		}
		
/*		public function update_instituicao($nome,$email,$cod_cidade,$cod_bairro,$cod_rua,$complemento,$numero,$cod_uf,$telefone,$cod_status,$cod_instituicao,$cep,$responsavel,$mensalidade, $contrato, $data_ass, $dia_base, $pagamento, $parcelas, $adesao, $pasta){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			if(!empty($data_ass)){ // testando se foi passado algum valor para variável
				$data_ass = explode("/", $data_ass);
				$data_ass = $data_ass[2]."-".$data_ass[1]."-".$data_ass[0];
			}
			else{
				$data_ass = '0000-00-00';
			}
			$query_insert = mysql_query("UPDATE instituicao SET nome = '$nome', email = '$email', cod_cidade = '$cod_cidade', cod_bairro = '$cod_bairro', cod_rua = '$cod_rua', complemento = '$complemento', numero = '$numero', cod_uf = '$cod_uf', telefone = '$telefone', cod_status = '$cod_status', cep = '$cep', responsavel = '$responsavel', mensalidade = '$mensalidade', contrato = '$contrato', data_ass = '$data_ass', dia_base = '$dia_base', pagamento = '$pagamento', parcelas = '$parcelas', adesao = '$adesao' WHERE cod_instituicao = '$cod_instituicao'") or die ("Erro insert ". mysql_errno());
			$this->resultado = "ok";
		}// fim do método
*/
		public function update_config($media,$cod_tipo,$ranking,$cod_paralela){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			session_start();
			$cod_instituicao = (int) $_SESSION['id_instituicao'];
			$query_insert = mysql_query("UPDATE config SET media = '$media', cod_tipo = '$cod_tipo', ranking = '$ranking', cod_paralela = '$cod_paralela' WHERE cod_instituicao = '$cod_instituicao'") or die ("Erro insert ". mysql_error());
			$this->resultado = "ok";
		}// fim do método
	}

?>
