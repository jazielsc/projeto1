<?php

class Class_professor{
	  
	public function insert_professor($cod_status, $cod_instituicao, $_1_, $_2_, $_3_, $_4_, $_5_, $_6_, $_7_, $_8_, $_9_, $_10_, $_11_, $_12_, $_13_, $_14_, $_15_, $_16_, $_17_, $_18_, $_19_, $_20_, $_21_1_, $_21_2_,
									 $_21_3_, $_21_4_, $_21_5_, $_21_6_, $_21_7_, $_21_8_, $_21_9_, $_21_10_, $_21_11_, $_21_12_, $_21_13_, $_21_14_, $_21_15_, $_21_16_, $_21_17_, $_21_18_, $_21_19_, $_21_20_,
									 $_21_21_, $_21_22_, $_22_, $_23_1_, $_23_2_, $_23_3_, $_23_4_, $_23_5_, $_23_6_, $_23_7_, $_23_8_, $_23_9_, $_23_10_, $_23_11_, $_24_, $_25_, $_26_1_, $_26_2_, $_26_3_, $_26_4_,
									 $_26_5_, $_26_6_, $_27_1_1_, $_27_1_2_, $_27_1_3_, $_27_1_4_, $_27_1_5_, $_27_1_6_, $_27_1_7_, $_27_2_1_, $_27_2_2_, $_27_2_3_, $_27_2_4_, $_27_2_5_, $_27_2_6_, $_27_2_7_,
									 $_27_3_1_, $_27_3_2_, $_27_3_3_, $_27_3_4_, $_27_3_5_, $_27_3_6_, $_27_3_7_, $_27_4_1_, $_27_4_2_, $_27_4_3_, $_27_4_4_, $_27_4_5_, $_27_4_6_, $_27_4_7_, $_27_5_1_, $_27_5_2_,
									 $_27_5_3_, $_27_5_4_, $_27_5_5_, $_27_5_6_, $_27_5_7_, $_27_6_1_, $_27_6_2_, $_27_6_3_, $_27_6_4_, $_27_6_5_, $_27_6_6_, $_27_6_7_){
		/*BEGIN*/
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			if($_5_ != ""){
				$data_nova = $_5_;
				$ano = $data_nova[6].$data_nova[7].$data_nova[8].$data_nova[9];
				$mes = $data_nova[3].$data_nova[4];
				$dia = $data_nova[0].$data_nova[1];
				$_5_ = $ano."-".$mes."-".$dia;
			}
			else $_5_ = "0000-00-00";
			
			$consulta = mysql_query("INSERT INTO `professor`(`cod_status`, `cod_instituicao`, `1_`, `2_`, `3_`, `4_`, `5_`, `6_`, `7_`, `8_`, `9_`, `10_`, `11_`, `12_`, `13_`, `14_`, `15_`, `16_`, `17_`, `18_`, `19_`, `20_`, `21_1_`, `21_2_`, `21_3_`, `21_4_`, `21_5_`, `21_6_`, `21_7_`, `21_8_`, `21_9_`, `21_10_`, `21_11_`, `21_12_`, `21_13_`, `21_14_`, `21_15_`, `21_16_`, `21_17_`, `21_18_`, `21_19_`, `21_20_`, `21_21_`, `21_22_`, `22_`, `23_1_`, `23_2_`, `23_3_`, `23_4_`, `23_5_`, `23_6_`, `23_7_`, `23_8_`, `23_9_`, `23_10_`, `23_11_`, `24_`, `25_`, `26_1_`, `26_2_`, `26_3_`, `26_4_`, `26_5_`, `26_6_`, `27_1_1_`, `27_1_2_`, `27_1_3_`, `27_1_4_`, `27_1_5_`, `27_1_6_`, `27_1_7_`, `27_2_1_`, `27_2_2_`, `27_2_3_`, `27_2_4_`, `27_2_5_`, `27_2_6_`, `27_2_7_`, `27_3_1_`, `27_3_2_`, `27_3_3_`, `27_3_4_`, `27_3_5_`, `27_3_6_`, `27_3_7_`, `27_4_1_`, `27_4_2_`, `27_4_3_`, `27_4_4_`, `27_4_5_`, `27_4_6_`, `27_4_7_`, `27_5_1_`, `27_5_2_`, `27_5_3_`, `27_5_4_`, `27_5_5_`, `27_5_6_`, `27_5_7_`, `27_6_1_`, `27_6_2_`, `27_6_3_`, `27_6_4_`, `27_6_5_`, `27_6_6_`, `27_6_7_`)
									VALUES ($cod_status, $cod_instituicao, '$_1_', '$_2_', '$_3_', '$_4_', '$_5_', '$_6_', '$_7_', '$_8_', '$_9_', '$_10_', '$_11_', '$_12_', '$_13_', '$_14_', '$_15_', '$_16_', '$_17_', '$_18_', '$_19_', '$_20_', '$_21_1_', '$_21_2_',
									 '$_21_3_', '$_21_4_', '$_21_5_', '$_21_6_', '$_21_7_', '$_21_8_', '$_21_9_', '$_21_10_', '$_21_11_', '$_21_12_', '$_21_13_', '$_21_14_', '$_21_15_', '$_21_16_', '$_21_17_', '$_21_18_', '$_21_19_', '$_21_20_',
									 '$_21_21_', '$_21_22_', '$_22_', '$_23_1_', '$_23_2_', '$_23_3_', '$_23_4_', '$_23_5_', '$_23_6_', '$_23_7_', '$_23_8_', '$_23_9_', '$_23_10_', '$_23_11_', '$_24_', '$_25_', '$_26_1_', '$_26_2_', '$_26_3_', '$_26_4_',
									 '$_26_5_', '$_26_6_', '$_27_1_1_', '$_27_1_2_', '$_27_1_3_', '$_27_1_4_', '$_27_1_5_', '$_27_1_6_', '$_27_1_7_', '$_27_2_1_', '$_27_2_2_', '$_27_2_3_', '$_27_2_4_', '$_27_2_5_', '$_27_2_6_', '$_27_2_7_',
									 '$_27_3_1_', '$_27_3_2_', '$_27_3_3_', '$_27_3_4_', '$_27_3_5_', '$_27_3_6_', '$_27_3_7_', '$_27_4_1_', '$_27_4_2_', '$_27_4_3_', '$_27_4_4_', '$_27_4_5_', '$_27_4_6_', '$_27_4_7_', '$_27_5_1_', '$_27_5_2_',
									 '$_27_5_3_', '$_27_5_4_', '$_27_5_5_', '$_27_5_6_', '$_27_5_7_', '$_27_6_1_', '$_27_6_2_', '$_27_6_3_', '$_27_6_4_', '$_27_6_5_', '$_27_6_6_', '$_27_6_7_')") or die ("Erro select ". mysql_errno());
			return 0;
		/*END*/
	}
	
	public function update_professor($cod_professor, $cod_status, $cod_instituicao, $_1_, $_2_, $_3_, $_4_, $_5_, $_6_, $_7_, $_8_, $_9_, $_10_, $_11_, $_12_, $_13_, $_14_, $_15_, $_16_, $_17_, $_18_, $_19_, $_20_, $_21_1_, $_21_2_,
									 $_21_3_, $_21_4_, $_21_5_, $_21_6_, $_21_7_, $_21_8_, $_21_9_, $_21_10_, $_21_11_, $_21_12_, $_21_13_, $_21_14_, $_21_15_, $_21_16_, $_21_17_, $_21_18_, $_21_19_, $_21_20_,
									 $_21_21_, $_21_22_, $_22_, $_23_1_, $_23_2_, $_23_3_, $_23_4_, $_23_5_, $_23_6_, $_23_7_, $_23_8_, $_23_9_, $_23_10_, $_23_11_, $_24_, $_25_, $_26_1_, $_26_2_, $_26_3_, $_26_4_,
									 $_26_5_, $_26_6_, $_27_1_1_, $_27_1_2_, $_27_1_3_, $_27_1_4_, $_27_1_5_, $_27_1_6_, $_27_1_7_, $_27_2_1_, $_27_2_2_, $_27_2_3_, $_27_2_4_, $_27_2_5_, $_27_2_6_, $_27_2_7_,
									 $_27_3_1_, $_27_3_2_, $_27_3_3_, $_27_3_4_, $_27_3_5_, $_27_3_6_, $_27_3_7_, $_27_4_1_, $_27_4_2_, $_27_4_3_, $_27_4_4_, $_27_4_5_, $_27_4_6_, $_27_4_7_, $_27_5_1_, $_27_5_2_,
									 $_27_5_3_, $_27_5_4_, $_27_5_5_, $_27_5_6_, $_27_5_7_, $_27_6_1_, $_27_6_2_, $_27_6_3_, $_27_6_4_, $_27_6_5_, $_27_6_6_, $_27_6_7_){
		/*BEGIN*/
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			if($_5_ != ""){
				$data_nova = $_5_;
				$ano = $data_nova[6].$data_nova[7].$data_nova[8].$data_nova[9];
				$mes = $data_nova[3].$data_nova[4];
				$dia = $data_nova[0].$data_nova[1];
				$_5_ = $ano."-".$mes."-".$dia;
			}
			else $_5_ = "0000-00-00";
			
			$consulta = mysql_query("UPDATE `professor` SET `cod_status`= $cod_status,`cod_instituicao`= $cod_instituicao,`1_`='$_1_',`2_`='$_2_',`3_`='$_3_',`4_`='$_4_',`5_`='$_5_',
			`6_`='$_6_',`7_`='$_7_',`8_`='$_8_',`9_`='$_9_',`10_`='$_10_',`11_`='$_11_',`12_`='$_12_',`13_`='$_13_',`14_`='$_14_',`15_`='$_15_',`16_`='$_16_',`17_`='$_17_',
			`18_`='$_18_',`19_`='$_19_',`20_`='$_20_',`21_1_`='$_21_1_',`21_2_`='$_21_2_',`21_3_`='$_21_3_',`21_4_`='$_21_4_',`21_5_`='$_21_5_',`21_6_`='$_21_6_',`21_7_`='$_21_7_',`21_8_`='$_21_8_',
			`21_9_`='$_21_9_',`21_10_`='$_21_10_',`21_11_`='$_21_11_',`21_12_`='$_21_12_',`21_13_`='$_21_13_',`21_14_`='$_21_14_',`21_15_`='$_21_15_',`21_16_`='$_21_16_',`21_17_`='$_21_17_',`21_18_`='$_21_18_',
			`21_19_`='$_21_19_',`21_20_`='$_21_20_',`21_21_`='$_21_21_',`21_22_`='$_21_22_',`22_`='$_22_',`23_1_`='$_23_1_',`23_2_`='$_23_2_',`23_3_`='$_23_3_',`23_4_`='$_23_4_',`23_5_`='$_23_5_',
			`23_6_`='$_23_6_',`23_7_`='$_23_7_',`23_8_`='$_23_8_',`23_9_`='$_23_9_',`23_10_`='$_23_10_',`23_11_`='$_23_11_',`24_`='$_24_',`25_`='$_25_',`26_1_`='$_26_1_',`26_2_`='$_26_2_',
			`26_3_`='$_26_3_',`26_4_`='$_26_4_',`26_5_`='$_26_5_',`26_6_`='$_26_6_',`27_1_1_`='$_27_1_1_',`27_1_2_`='$_27_1_2_',`27_1_3_`='$_27_1_3_',`27_1_4_`='$_27_1_4_',`27_1_5_`='$_27_1_5_',`27_1_6_`='$_27_1_6_',
			`27_1_7_`='$_27_1_7_',`27_2_1_`='$_27_2_1_',`27_2_2_`='$_27_2_2_',`27_2_3_`='$_27_2_3_',`27_2_4_`='$_27_2_4_',`27_2_5_`='$_27_2_5_',`27_2_6_`='$_27_2_6_',`27_2_7_`='$_27_2_7_',`27_3_1_`='$_27_3_1_',
			`27_3_2_`='$_27_3_2_',`27_3_3_`='$_27_3_3_',`27_3_4_`='$_27_3_4_',`27_3_5_`='$_27_3_5_',`27_3_6_`='$_27_3_6_',`27_3_7_`='$_27_3_7_',`27_4_1_`='$_27_4_1_',`27_4_2_`='$_27_4_2_',`27_4_3_`='$_27_4_3_',
			`27_4_4_`='$_27_4_4_',`27_4_5_`='$_27_4_5_',`27_4_6_`='$_27_4_6_',`27_4_7_`='$_27_4_7_',`27_5_1_`='$_27_5_1_',`27_5_2_`='$_27_5_2_',`27_5_3_`='$_27_5_3_',`27_5_4_`='$_27_5_4_',`27_5_5_`='$_27_5_5_',
			`27_5_6_`='$_27_5_6_',`27_5_7_`='$_27_5_7_',`27_6_1_`='$_27_6_1_',`27_6_2_`='$_27_6_2_',`27_6_3_`='$_27_6_3_',`27_6_4_`='$_27_6_4_',`27_6_5_`='$_27_6_5_',`27_6_6_`='$_27_6_6_',`27_6_7_`='$_27_6_7_'
			WHERE cod_professor = $cod_professor") or die ("Erro select ". mysql_errno());
		/*END*/
	}
	
	/*
	public function insert_professor($nome, $email, $cidade, $bairro, $rua, $complemento, $numero, $cod_uf, $telefone, $cod_status, $cod_instituicao, $cep, $identidade){
        $instituicao = $_SESSION['instituicao'];
        $pasta = $_SESSION['pasta'];
        $cod_instituicao = (int) $_SESSION['id_instituicao'];
        $emailLogin = explode(' ', $nome);      
        if($email == ""){
			$email = $emailLogin[0].$this->geraSenha().'@boletimflex.com.br';
        }
        if($identidade == ""){
			$identidade = $this->geraSenha(8, false, true);
        }
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_professor FROM professor WHERE email = '$email'") or die ("Erro select ". mysql_errno());
         $query_select2 = mysql_query("SELECT cod_usuario FROM usuario WHERE email = '$email'") or die ("Erro select ". mysql_errno());

		// verificando se a query retornou algum valor
		$quant = mysql_num_rows($query_select);
		$quant2 = mysql_num_rows($query_select2);

		// se retornou então envia a mensagem
		if ($quant > 0 or $quant2 > 0) {
			 return 110;
		}
		else {
			$query_insert = mysql_query("INSERT INTO professor (cod_professor, nome, email, cidade, bairro, rua, complemento, numero, cod_uf, telefone, cod_status, cod_instituicao, cep, identidade) VALUES (NULL, '$nome','$email','$cidade','$bairro','$rua','$complemento','$numero','$cod_uf','$telefone','$cod_status', '$cod_instituicao','$cep','$identidade')") or die ("Erro insert ". mysql_errno());   															
			$query_grid = mysql_query("SELECT cod_professor, professor.nome, cidade_nome , telefone FROM professor, cidade WHERE professor.cod_cidade = cidade_id AND cod_instituicao = '$cod_instituicao' AND cod_status = 1 ORDER BY professor.nome",$conn) or die ("Error na consulta");
			
			$query_consulta = mysql_query("SELECT cod_professor FROM professor WHERE cod_instituicao = '$cod_instituicao' ORDER BY  cod_professor DESC LIMIT 1",$conn) or die ("Error na consulta");
			$resultado = mysql_fetch_array($query_consulta);
			$senha =  md5($identidade);
			$query_insert = mysql_query("INSERT INTO usuario VALUE (NULL, '$nome','$email','$senha',4,2,$resultado[0],'$cod_instituicao','$email')") or die ("Erro insert ". mysql_errno());
			return 0;
		}
    }

    public function update_professor($nome,$email,$cod_cidade,$cod_bairro,$cod_rua,$complemento,$numero,$cod_uf,$telefone,$cod_status,$cod_professor,$cod_instituicao,$cep,$identidade){
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
        if($cod_status > 1){
			$query_update = mysql_query("UPDATE usuario SET usuario_atrib = 6 WHERE cod_aluno_professor = '$cod_professor' AND referencia = 2") or die("ERRO!");
		}
		elseif($cod_status == 1){
			$query_update = mysql_query("UPDATE usuario SET usuario_atrib = 4 WHERE cod_aluno_professor = '$cod_professor' AND referencia = 2") or die("ERRO!");
		}
		$query_insert = mysql_query("UPDATE professor SET nome = '$nome', email = '$email', cod_cidade = '$cod_cidade', cod_bairro = '$cod_bairro', cod_rua = '$cod_rua', complemento = '$complemento', numero = '$numero', cod_uf = '$cod_uf', telefone = '$telefone', cod_status = '$cod_status', cod_instituicao = '$cod_instituicao', cep = '$cep', identidade = '$identidade' WHERE cod_professor = '$cod_professor'") or die ("Erro insert ". mysql_errno());
		return 1;               
	}
	*/
	
	public function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false, $minusculas = false){
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';
		$retorno = '';
		$caracteres = '';
		if ($minusculas){
			$caracteres .= $lmin;
		}
		if ($maiusculas){
			$caracteres .= $lmai;
		}
		if ($numeros){
			$caracteres .= $num;
		}
		if ($simbolos) {
			$caracteres .= $simb;
		}
		$len = strlen($caracteres);
		for ($n = 1; $n <= $tamanho; $n++){
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
		}
		return $this->senha = $retorno;
	}
	
}
?>
