<?php
	session_start();
	if (isset($_POST['acao'])){
		require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
		require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_aluno.php");
        $aluno = new Class_aluno;
		$action = $_POST['acao'];
		switch ($action){
			case "insert_aluno": {
				$_1_identificacao_unica = $_POST['1_identificacao_unica'];
				$_2_nome_completo = $_POST['2_nome_completo'];
				$_3_nis = $_POST['3_nis'];
				$_4_data_nascimento = $_POST['4_data_nascimento'];
				$_5_sexo = $_POST['5_sexo'];
				$_6_cor_raca = $_POST['6_cor_raca'];
				$_7_mae = $_POST['7_mae'];
				$_7_pai = $_POST['7_pai'];
				$_8_nacionalidade = $_POST['8_nacionalidade'];
				$_9_pais_origem = $_POST['9_pais_origem'];
				$_10_uf_nascimento = $_POST['10_uf_nascimento'];
				$_11_municipio_nascimento = $_POST['11_municipio_nascimento'];
				$_12_deficiencia = $_POST['12_deficiencia'];
				$_12a_tipo_deficiencia = $_POST['12a_tipo_deficiencia'];
				$_13_identidade = $_POST['13_identidade'];
				$_13a_complemento_identidade = $_POST['13a_complemento_identidade'];
				$_13b_orgao_emissor = $_POST['13b_orgao_emissor'];
				$_13c_uf = $_POST['13c_uf'];
				$_13d_data_emissao = $_POST['13d_data_emissao'];
				$_14_certidao_civil = $_POST['14_certidao_civil'];
				$_14a_tipo = $_POST['14a_tipo'];
				$_14b_numero_termo = $_POST['14b_numero_termo'];
				$_14c_folha = $_POST['14c_folha'];
				$_14d_livro = $_POST['14d_livro'];
				$_14e_data_emissao_certidao = $_POST['14e_data_emissao_certidao'];
				$_14f_uf_cartorio = $_POST['14f_uf_cartorio'];
				$_14g_municipio_cartorio = $_POST['14g_municipio_cartorio'];
				$_14h_nome_cartorio = $_POST['14h_nome_cartorio'];
				$_14i_numero_matricula = $_POST['14i_numero_matricula'];
				$_15_cpf = $_POST['15_cpf'];
				$_16_passaporte = $_POST['16_passaporte'];
				$_17_localizacao = $_POST['17_localizacao'];
				$_18_cep = $_POST['18_cep'];
				$_19_endereco = $_POST['19_endereco'];
				$_20_numero = $_POST['20_numero'];
				$_21_complemento = $_POST['21_complemento'];
				$_22_bairro = $_POST['22_bairro'];
				$_23_uf = $_POST['23_uf'];
				$_24_municipio = $_POST['24_municipio'];
				$_25_nome_turma = $_POST['25_nome_turma'];
				$_26_turma_unificada = $_POST['26_turma_unificada'];
				$_27_educacao_infantil = $_POST['27_educacao_infantil'];
				$_27_ensino_fundamental_serie = $_POST['27_ensino_fundamental_serie'];
				$_27_ensino_fundamental_ano = $_POST['27_ensino_fundamental_ano'];
				$_27_educacao_jovens_adultos = $_POST['27_educacao_jovens_adultos'];
				$_27_educacao_profissional_mista = $_POST['27_educacao_profissional_mista'];
				$_28_escolarizacao_fora_escola = $_POST['28_escolarizacao_fora_escola'];
				$_29_transporte_publico = $_POST['29_transporte_publico'];
				$_29a_poder_responsavel = $_POST['29a_poder_responsavel'];
				$cod_instituicao = $_SESSION['id_instituicao'];
				$cod_curso = $_POST['cod_curso'];
				$cod_status = $_POST['cod_status'];
				$email = $_POST['email'];
				$nome_responsavel = $_POST['nome_responsavel'];
				$email_responsavel = $_POST['email_responsavel'];
				$matricula = $_POST['matricula'];
				$aluno->insere_aluno($_1_identificacao_unica, $_2_nome_completo, $_3_nis, $_4_data_nascimento, $_5_sexo, $_6_cor_raca, $_7_mae, $_7_pai, $_8_nacionalidade, $_9_pais_origem, $_10_uf_nascimento, $_11_municipio_nascimento, $_12_deficiencia, $_12a_tipo_deficiencia, $_13_identidade, $_13a_complemento_identidade, $_13b_orgao_emissor, $_13c_uf, $_13d_data_emissao, $_14_certidao_civil,$_14a_tipo, $_14b_numero_termo, $_14c_folha, $_14d_livro, $_14e_data_emissao_certidao, $_14f_uf_cartorio, $_14g_municipio_cartorio, $_14h_nome_cartorio, $_14i_numero_matricula, $_15_cpf, $_16_passaporte, $_17_localizacao, $_18_cep,$_19_endereco, $_20_numero, $_21_complemento, $_22_bairro, $_23_uf, $_24_municipio, $_25_nome_turma, $_26_turma_unificada, $_27_educacao_infantil, $_27_ensino_fundamental_serie, $_27_ensino_fundamental_ano, $_27_educacao_jovens_adultos, $_27_educacao_profissional_mista, $_28_escolarizacao_fora_escola, $_29_transporte_publico, $_29a_poder_responsavel, $cod_instituicao, $cod_curso, $cod_status, $email, $nome_responsavel, $email_responsavel, $matricula);
				header("Location: /paginas/cadastro_aluno.php?sucesso=0");
			} break;

			case "update_aluno": {
				$cod_aluno = $_POST['cod_aluno'];
				$_1_identificacao_unica = $_POST['1_identificacao_unica'];
				$_2_nome_completo = $_POST['2_nome_completo'];
				$_3_nis = $_POST['3_nis'];
				$_4_data_nascimento = $_POST['4_data_nascimento'];
				$_5_sexo = $_POST['5_sexo'];
				$_6_cor_raca = $_POST['6_cor_raca'];
				$_7_mae = $_POST['7_mae'];
				$_7_pai = $_POST['7_pai'];
				$_8_nacionalidade = $_POST['8_nacionalidade'];
				$_9_pais_origem = $_POST['9_pais_origem'];
				$_10_uf_nascimento = $_POST['10_uf_nascimento'];
				$_11_municipio_nascimento = $_POST['11_municipio_nascimento'];
				$_12_deficiencia = $_POST['12_deficiencia'];
				$_12a_tipo_deficiencia = $_POST['12a_tipo_deficiencia'];
				$_13_identidade = $_POST['13_identidade'];
				$_13a_complemento_identidade = $_POST['13a_complemento_identidade'];
				$_13b_orgao_emissor = $_POST['13b_orgao_emissor'];
				$_13c_uf = $_POST['13c_uf'];
				$_13d_data_emissao = $_POST['13d_data_emissao'];
				$_14_certidao_civil = $_POST['14_certidao_civil'];
				$_14a_tipo = $_POST['14a_tipo'];
				$_14b_numero_termo = $_POST['14b_numero_termo'];
				$_14c_folha = $_POST['14c_folha'];
				$_14d_livro = $_POST['14d_livro'];
				$_14e_data_emissao_certidao = $_POST['14e_data_emissao_certidao'];
				$_14f_uf_cartorio = $_POST['14f_uf_cartorio'];
				$_14g_municipio_cartorio = $_POST['14g_municipio_cartorio'];
				$_14h_nome_cartorio = $_POST['14h_nome_cartorio'];
				$_14i_numero_matricula = $_POST['14i_numero_matricula'];
				$_15_cpf = $_POST['15_cpf'];
				$_16_passaporte = $_POST['16_passaporte'];
				$_17_localizacao = $_POST['17_localizacao'];
				$_18_cep = $_POST['18_cep'];
				$_19_endereco = $_POST['19_endereco'];
				$_20_numero = $_POST['20_numero'];
				$_21_complemento = $_POST['21_complemento'];
				$_22_bairro = $_POST['22_bairro'];
				$_23_uf = $_POST['23_uf'];
				$_24_municipio = $_POST['24_municipio'];
				$_25_nome_turma = $_POST['25_nome_turma'];
				$_26_turma_unificada = $_POST['26_turma_unificada'];
				$_27_educacao_infantil = $_POST['27_educacao_infantil'];
				$_27_ensino_fundamental_serie = $_POST['27_ensino_fundamental_serie'];
				$_27_ensino_fundamental_ano = $_POST['27_ensino_fundamental_ano'];
				$_27_educacao_jovens_adultos = $_POST['27_educacao_jovens_adultos'];
				$_27_educacao_profissional_mista = $_POST['27_educacao_profissional_mista'];
				$_28_escolarizacao_fora_escola = $_POST['28_escolarizacao_fora_escola'];
				$_29_transporte_publico = $_POST['29_transporte_publico'];
				$_29a_poder_responsavel = $_POST['29a_poder_responsavel'];
				$cod_instituicao = $_SESSION['id_instituicao'];
				$cod_curso = $_POST['cod_curso'];
				$cod_status = $_POST['cod_status'];
				$email = $_POST['email'];
				$nome_responsavel = $_POST['nome_responsavel'];
				$email_responsavel = $_POST['email_responsavel'];
				$matricula = $_POST['matricula'];
				$aluno->update_aluno($_1_identificacao_unica, $_2_nome_completo, $_3_nis, $_4_data_nascimento, $_5_sexo, $_6_cor_raca, $_7_mae, $_7_pai,
								 $_8_nacionalidade, $_9_pais_origem, $_10_uf_nascimento, $_11_municipio_nascimento, $_12_deficiencia, $_12a_tipo_deficiencia,
								 $_13_identidade, $_13a_complemento_identidade, $_13b_orgao_emissor, $_13c_uf, $_13d_data_emissao, $_14_certidao_civil,
								 $_14a_tipo, $_14b_numero_termo, $_14c_folha, $_14d_livro, $_14e_data_emissao_certidao, $_14f_uf_cartorio, $_14g_municipio_cartorio,
								 $_14h_nome_cartorio, $_14i_numero_matricula, $_15_cpf, $_16_passaporte, $_17_localizacao, $_18_cep, $_19_endereco, $_20_numero,
								 $_21_complemento, $_22_bairro, $_23_uf, $_24_municipio, $_25_nome_turma, $_26_turma_unificada, $_27_educacao_infantil,
								 $_27_ensino_fundamental_serie, $_27_ensino_fundamental_ano, $_27_educacao_jovens_adultos, $_27_educacao_profissional_mista,
								 $_28_escolarizacao_fora_escola, $_29_transporte_publico, $_29a_poder_responsavel, $cod_instituicao, $cod_curso, $cod_status,
								 $email, $nome_responsavel, $email_responsavel, $matricula, $cod_aluno);
				header("Location: /paginas/cadastro_aluno.php?sucesso=1");
			} break;

		}
	}
?>
