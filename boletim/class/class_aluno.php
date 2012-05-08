<?php

class Class_aluno{

	public function insere_aluno($_1_identificacao_unica, $_2_nome_completo, $_3_nis, $_4_data_nascimento, $_5_sexo, $_6_cor_raca, $_7_mae, $_7_pai,
								 $_8_nacionalidade, $_9_pais_origem, $_10_uf_nascimento, $_11_municipio_nascimento, $_12_deficiencia, $_12a_tipo_deficiencia,
								 $_13_identidade, $_13a_complemento_identidade, $_13b_orgao_emissor, $_13c_uf, $_13d_data_emissao, $_14_certidao_civil,
								 $_14a_tipo, $_14b_numero_termo, $_14c_folha, $_14d_livro, $_14e_data_emissao_certidao, $_14f_uf_cartorio, $_14g_municipio_cartorio,
								 $_14h_nome_cartorio, $_14i_numero_matricula, $_15_cpf, $_16_passaporte, $_17_localizacao, $_18_cep, $_19_endereco, $_20_numero,
								 $_21_complemento, $_22_bairro, $_23_uf, $_24_municipio, $_25_nome_turma, $_26_turma_unificada, $_27_educacao_infantil,
								 $_27_ensino_fundamental_serie, $_27_ensino_fundamental_ano, $_27_educacao_jovens_adultos, $_27_educacao_profissional_mista,
								 $_28_escolarizacao_fora_escola, $_29_transporte_publico, $_29a_poder_responsavel, $cod_instituicao, $cod_curso, $cod_status,
								 $email, $nome_responsavel, $email_responsavel, $matricula){
		/*BEGIN*/
			/*VALIDACAO DE DATA*/
			$data_nova = $_4_data_nascimento;
			if($data_nova == "") $data_nova = '0000-00-00';
			$ano = $data_nova[6].$data_nova[7].$data_nova[8].$data_nova[9];
			$mes = $data_nova[3].$data_nova[4];
			$dia = $data_nova[0].$data_nova[1];
			$_4_data_nascimento = $ano."-".$mes."-".$dia;

			$data_nova = $_13d_data_emissao;
			if($data_nova == "") $data_nova = '0000-00-00';
			$ano = $data_nova[6].$data_nova[7].$data_nova[8].$data_nova[9];
			$mes = $data_nova[3].$data_nova[4];
			$dia = $data_nova[0].$data_nova[1];
			$_13d_data_emissao = $ano."-".$mes."-".$dia;
			
			$data_nova = $_14e_data_emissao_certidao;
			if($data_nova == "") $data_nova = '0000-00-00';
			$ano = $data_nova[6].$data_nova[7].$data_nova[8].$data_nova[9];
			$mes = $data_nova[3].$data_nova[4];
			$dia = $data_nova[0].$data_nova[1];
			$_14e_data_emissao_certidao = $ano."-".$mes."-".$dia;
			/**/
			
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$consulta = mysql_query("INSERT INTO `aluno`(`cod_status`, `cod_instituicao`, `cod_curso`, `1_identificacao_unica`, `2_nome_completo`, `3_nis`, `4_data_nascimento`, `5_sexo`, `6_cor_raca`, `7_mae`, `7_pai`, `8_nacionalidade`, `9_pais_origem`, `10_uf_nascimento`, `11_municipio_nascimento`, `12_deficiencia`, `12a_tipo_deficiencia`, `13_identidade`, `13a_complemento_identidade`, `13b_orgao_emissor`, `13c_uf`, `13d_data_emissao`, `14_certidao_civil`, `14a_tipo`, `14b_numero_termo`, `14c_folha`, `14d_livro`, `14e_data_emissao_certidao`, `14f_uf_cartorio`, `14g_municipio_cartorio`, `14h_nome_cartorio`, `14i_numero_matricula`, `15_cpf`, `16_passaporte`, `17_localizacao`, `18_cep`, `19_endereco`, `20_numero`, `21_complemento`, `22_bairro`, `23_uf`, `24_municipio`, `25_nome_turma`, `26_turma_unificada`, `27_educacao_infantil`, `27_ensino_fundamental_seie`, `27_ensino_fundamental_ano`, `27_educacao_jovens_adultos`, `27_educacao_profissional_mista`, `28_escolarizacao_fora_escola`, `29_transporte_publico`, `29a_poder_responsavel`, `email`, `nome_responsavel`, `email_responsavel`, `matricula`)
												 VALUES ($cod_status, $cod_instituicao, $cod_curso, '$_1_identificacao_unica', '$_2_nome_completo', '$_3_nis', '$_4_data_nascimento', '$_5_sexo', $_6_cor_raca, '$_7_mae', '$_7_pai', $_8_nacionalidade, '$_9_pais_origem', '$_10_uf_nascimento', '$_11_municipio_nascimento', $_12_deficiencia, $_12a_tipo_deficiencia, '$_13_identidade', '$_13a_complemento_identidade', '$_13b_orgao_emissor', '$_13c_uf', '$_13d_data_emissao', $_14_certidao_civil, $_14a_tipo, '$_14b_numero_termo', '$_14c_folha', '$_14d_livro', '$_14e_data_emissao_certidao', '$_14f_uf_cartorio', '$_14g_municipio_cartorio', '$_14h_nome_cartorio', '$_14i_numero_matricula', '$_15_cpf', '$_16_passaporte', $_17_localizacao, '$_18_cep', '$_19_endereco', '$_20_numero', '$_21_complemento', '$_22_bairro', '$_23_uf', '$_24_municipio', '$_25_nome_turma', $_26_turma_unificada, $_27_educacao_infantil, '$_27_ensino_fundamental_serie', '$_27_ensino_fundamental_ano', $_27_educacao_jovens_adultos, $_27_educacao_profissional_mista, $_28_escolarizacao_fora_escola, $_29_transporte_publico, $_29a_poder_responsavel, '$email', '$nome_responsavel', '$email_responsavel', '$matricula')") or die("Erro na consulta:" .mysql_error());
			$pasta = $_SESSION['pasta'];        
			$query_consulta = mysql_query("SELECT cod_aluno FROM aluno WHERE cod_instituicao = '$cod_instituicao' ORDER BY cod_aluno DESC LIMIT 1",$conn) or die ("Error na consulta");
			
			$resultado = mysql_fetch_array($query_consulta);
			$senha =  md5($_13_identidade);
			$query_insert = mysql_query("INSERT INTO usuario VALUES (NULL, '$_13_identidade','$email','$senha',3,1,'$resultado[0]','$cod_instituicao','$email')") or die ("Erro insert2 ". mysql_error());
			$query_insert2 = mysql_query("INSERT INTO aluno_curso VALUES ('$resultado[0]','$cod_curso')") or die ("Erro insert3 ". mysql_errno());
		/*END*/
	}
	
	public function update_aluno($_1_identificacao_unica, $_2_nome_completo, $_3_nis, $_4_data_nascimento, $_5_sexo, $_6_cor_raca, $_7_mae, $_7_pai,
								 $_8_nacionalidade, $_9_pais_origem, $_10_uf_nascimento, $_11_municipio_nascimento, $_12_deficiencia, $_12a_tipo_deficiencia,
								 $_13_identidade, $_13a_complemento_identidade, $_13b_orgao_emissor, $_13c_uf, $_13d_data_emissao, $_14_certidao_civil,
								 $_14a_tipo, $_14b_numero_termo, $_14c_folha, $_14d_livro, $_14e_data_emissao_certidao, $_14f_uf_cartorio, $_14g_municipio_cartorio,
								 $_14h_nome_cartorio, $_14i_numero_matricula, $_15_cpf, $_16_passaporte, $_17_localizacao, $_18_cep, $_19_endereco, $_20_numero,
								 $_21_complemento, $_22_bairro, $_23_uf, $_24_municipio, $_25_nome_turma, $_26_turma_unificada, $_27_educacao_infantil,
								 $_27_ensino_fundamental_serie, $_27_ensino_fundamental_ano, $_27_educacao_jovens_adultos, $_27_educacao_profissional_mista,
								 $_28_escolarizacao_fora_escola, $_29_transporte_publico, $_29a_poder_responsavel, $cod_instituicao, $cod_curso, $cod_status,
								 $email, $nome_responsavel, $email_responsavel, $matricula, $cod_aluno){
		/*BEGIN*/
			/*VALIDACAO DE DATA*/
			$data_nova = $_4_data_nascimento;
			$ano = $data_nova[6].$data_nova[7].$data_nova[8].$data_nova[9];
			$mes = $data_nova[3].$data_nova[4];
			$dia = $data_nova[0].$data_nova[1];
			$_4_data_nascimento = $ano."-".$mes."-".$dia;

			$data_nova = $_13d_data_emissao;
			$ano = $data_nova[6].$data_nova[7].$data_nova[8].$data_nova[9];
			$mes = $data_nova[3].$data_nova[4];
			$dia = $data_nova[0].$data_nova[1];
			$_13d_data_emissao = $ano."-".$mes."-".$dia;
			
			$data_nova = $_14e_data_emissao_certidao;
			$ano = $data_nova[6].$data_nova[7].$data_nova[8].$data_nova[9];
			$mes = $data_nova[3].$data_nova[4];
			$dia = $data_nova[0].$data_nova[1];
			$_14e_data_emissao_certidao = $ano."-".$mes."-".$dia;
			/**/
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");								
			$consulta = mysql_query("UPDATE `aluno` SET `cod_status`=$cod_status,`cod_instituicao`=$cod_instituicao,`cod_curso`=$cod_curso,`1_identificacao_unica`='$_1_identificacao_unica',`2_nome_completo`='$_2_nome_completo',
									`3_nis`='$_3_nis',`4_data_nascimento`='$_4_data_nascimento',`5_sexo`='$_5_sexo' WHERE `cod_aluno` = $cod_aluno") or die("Erro na consulta:" .mysql_error());
			$consulta = mysql_query("UPDATE `aluno` SET `6_cor_raca`=$_6_cor_raca,`7_mae`='$_7_mae',`7_pai`='$_7_pai',`8_nacionalidade`=$_8_nacionalidade,
									`9_pais_origem`='$_9_pais_origem',`10_uf_nascimento`='$_10_uf_nascimento',`11_municipio_nascimento`='$_11_municipio_nascimento',`12_deficiencia`=$_12_deficiencia,
									`12a_tipo_deficiencia`=$_12a_tipo_deficiencia,`13_identidade`='$_13_identidade',`13a_complemento_identidade`='$_13a_complemento_identidade',`13b_orgao_emissor`='$_13b_orgao_emissor',
									`13c_uf`='$_13c_uf',`13d_data_emissao`='$_13d_data_emissao' WHERE `cod_aluno` = $cod_aluno") or die("Erro na consulta:" .mysql_error());
			$consulta = mysql_query("UPDATE `aluno` SET `14_certidao_civil`=$_14_certidao_civil,`14a_tipo`=$_14a_tipo,`14b_numero_termo`='$_14b_numero_termo',`14c_folha`='$_14c_folha',
									`14d_livro`='$_14d_livro',`14e_data_emissao_certidao`='$_14e_data_emissao_certidao',`14f_uf_cartorio`='$_14f_uf_cartorio',`14g_municipio_cartorio`='$_14g_municipio_cartorio',
									`14h_nome_cartorio`='$_14h_nome_cartorio',`14i_numero_matricula`='$_14i_numero_matricula',`15_cpf`='$_15_cpf',`16_passaporte`='$_16_passaporte',`17_localizacao`=$_17_localizacao,`18_cep`='$_18_cep' WHERE `cod_aluno` = $cod_aluno") or die("Erro na consulta:" .mysql_error());
			$consulta = mysql_query("UPDATE `aluno` SET `19_endereco`='$_19_endereco',`20_numero`='$_20_numero',`21_complemento`='$_21_complemento',`22_bairro`='$_22_bairro',`23_uf`='$_23_uf',`24_municipio`='$_24_municipio',`25_nome_turma`='$_25_nome_turma',
									`26_turma_unificada`=$_26_turma_unificada,`27_educacao_infantil`=$_27_educacao_infantil,`27_ensino_fundamental_seie`='$_27_ensino_fundamental_serie'") or die("Erro na consulta:" .mysql_error());
			$consulta = mysql_query("UPDATE `aluno` SET `27_ensino_fundamental_ano`='$_27_ensino_fundamental_ano',`27_educacao_jovens_adultos`=$_27_educacao_jovens_adultos,`27_educacao_profissional_mista`=$_27_educacao_profissional_mista WHERE `cod_aluno` = $cod_aluno") or die("Erro na consulta:" .mysql_error());
			$consulta = mysql_query("UPDATE `aluno` SET `28_escolarizacao_fora_escola`=$_28_escolarizacao_fora_escola,`29_transporte_publico`=$_29_transporte_publico,`29a_poder_responsavel`=$_29a_poder_responsavel,
									`email`='$email',`nome_responsavel`='$nome_responsavel',`email_responsavel`='$email_responsavel',`matricula`='$matricula' WHERE `cod_aluno` = $cod_aluno") or die("Erro na consulta:" .mysql_error());
		/*END*/								 
	}
	
 /*   public function insert_aluno($nome,$email,$cidade,$bairro,$rua,$complemento,$numero,$cod_uf,$telefone,$cod_status,$cod_instituicao,$matricula,$cep,$responsavel,$email_responsavel,$cod_curso,$identidade,$datanasc,$celular){
        $instituicao = $_SESSION['instituicao'];
        $foto = null;
        $emailLogin = explode(' ', $nome);
        $emailResponsavel = explode(' ', $responsavel);
        if($email == ""){          
			$email = $emailLogin[0].$this->geraSenha().'@boletimflex.com.br';
        }
        if($email_responsavel == ""){
			$email_responsavel = $emailResponsavel[0].$this->geraSenha().'@boletimflex.com.br';
        }       
        if($identidade == ""){
			$identidade = $this->geraSenha(8, false, true);
        }      
		$pasta = $_SESSION['pasta'];        
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
		$or = "OR email_responsavel = '$email_responsavel'";
		$query_select = mysql_query("SELECT cod_aluno FROM aluno WHERE aluno.email = '$email' $or") or die ("Erro select ". mysql_error());
		$query_select2 = mysql_query("SELECT cod_usuario FROM usuario WHERE email = '$email'") or die ("Erro select ". mysql_error());
		$query_select3 = mysql_query("SELECT cod_aluno FROM aluno WHERE identidade = '$identidade' AND cod_instituicao = '$cod_instituicao'") or die ("Erro select ". mysql_error());
		// verificando se a query retornou algum valor
		$quant = mysql_num_rows($query_select);
		$quant2 = mysql_num_rows($query_select2);
		$quant3 = mysql_num_rows($query_select3);
		if ($quant3 > 0) {
			$this->resultado = "identidade";
		}
		// se retornou então envia a mensagem
		elseif ($quant > 0 or $quant2 > 0){
			$this->resultado = "NAO";
		}
		else {
			$query_insert = mysql_query("INSERT INTO aluno (cod_aluno, nome, email, cidade, bairro, rua, complemento, numero, cod_uf, telefone, cod_status, cod_instituicao, matricula, cep, responsavel, email_responsavel, cod_curso, identidade, datanasc, celular, foto) VALUES (NULL, '$nome','$email','$cidade','$bairro','$rua','$complemento','$numero','$cod_uf','$telefone','$cod_status', '$cod_instituicao','$matricula', '$cep','$responsavel','$email_responsavel', '$cod_curso','$identidade','$datanasc','$celular','$foto')") or die ("Erro insert 0 ". mysql_errno());

			$query_consulta = mysql_query("SELECT cod_aluno FROM aluno WHERE cod_instituicao = '$cod_instituicao' ORDER BY cod_aluno DESC LIMIT 1",$conn) or die ("Error na consulta");
			
			$resultado = mysql_fetch_array($query_consulta);
			$senha =  md5($identidade);
			$query_insert = mysql_query("INSERT INTO usuario VALUES (NULL, '$nome','$email','$senha',3,1,'$resultado[0]','$cod_instituicao','$email')") or die ("Erro insert2 ". mysql_errno());
			$query_insert2 = mysql_query("INSERT INTO aluno_curso VALUES ('$resultado[0]','$cod_curso')") or die ("Erro insert3 ". mysql_errno());
			$query_insert2 = mysql_query("INSERT INTO usuario VALUES (NULL, '$responsavel','$email_responsavel','$senha',3,4,'$resultado[0]','$cod_instituicao','$email_responsavel')") or die ("Erro insert3 ". mysql_error());
			$this->cod_aluno = $resultado[0];
		}
	}// fim do método
*/
/*    public function update_aluno($nome,$email,$cidade,$bairro,$rua,$complemento,$numero,$cod_uf,$telefone,$cod_status,$cod_aluno,$cod_instituicao,$matricula,$cep,$responsavel,$email_responsavel,$cod_curso,$identidade,$datanasc,$celular){
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
         if($cod_status > 1){
			$query_update = mysql_query("UPDATE usuario SET usuario_atrib = 6 WHERE cod_aluno_professor = '$cod_aluno' AND referencia = 1") or die("ERRO!");
			$query_update = mysql_query("UPDATE usuario SET usuario_atrib = 6 WHERE cod_aluno_professor = '$cod_aluno' AND referencia = 4") or die("ERRO!");
		 
		}
		elseif($cod_status == 1){
			$query_update = mysql_query("UPDATE usuario SET usuario_atrib = 3 WHERE cod_aluno_professor = '$cod_aluno' AND referencia = 1") or die("ERRO!");
			$query_update = mysql_query("UPDATE usuario SET usuario_atrib = 3 WHERE cod_aluno_professor = '$cod_aluno' AND referencia = 4") or die("ERRO!");
        }
		$query_insert = mysql_query("UPDATE aluno SET nome = '$nome', email = '$email', cidade = '$cidade', bairro = '$bairro', rua = '$rua', complemento = '$complemento', numero = '$numero', cod_uf = '$cod_uf', telefone = '$telefone', cod_status = '$cod_status', cod_instituicao = '$cod_instituicao', matricula = '$matricula', cep = '$cep', cod_curso = '$cod_curso', identidade = '$identidade', datanasc = '$datanasc', responsavel = '$responsavel', email_responsavel = '$email_responsavel', celular = '$celular' WHERE cod_aluno = '$cod_aluno'") or die ("Erro insert ". mysql_errno());
		$query_grid = mysql_query("SELECT cod_aluno, aluno.nome, cidade_nome , telefone FROM aluno, cidade WHERE aluno.cidade = cidade_id AND cod_status = 1 AND cod_instituicao = '$cod_instituicao' ORDER BY aluno.nome",$conn) or die ("Error na consulta");
		
		// zerando contadores
		$i = 0;
    }// fim do método
*/

	public function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false, $minusculas = false) {
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';
		// Variáveis internas
		$retorno = '';
		$caracteres = '';
		// Agrupamos todos os caracteres que poderão ser utilizados
		if ($minusculas) $caracteres .= $lmin;
		if ($maiusculas) $caracteres .= $lmai;
		if ($numeros) $caracteres .= $num;
		if ($simbolos) $caracteres .= $simb;
		// Calculamos o total de caracteres possíveis
		$len = strlen($caracteres);
		for ($n = 1; $n <= $tamanho; $n++){
			// Criamos um número aleatório de 1 até $len para pegar um dos caracteres
			$rand = mt_rand(1, $len);
			// Concatenamos um dos caracteres na variável $retorno
			$retorno .= $caracteres[$rand-1];
		}
		return $this->senha = $retorno;
	}
	
	public function converte_data_banco($data){
		$data_nova = $data;
		$ano = $data_nova[6].$data_nova[7].$data_nova[8].$data_nova[9];
		$mes = $data_nova[3].$data_nova[4];
		$dia = $data_nova[0].$data_nova[1];
		$data = $ano."-".$mes."-".$dia;
		return $data;
	}
}
?>
