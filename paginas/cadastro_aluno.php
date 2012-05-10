<?php 
	function converte_data_tela($data){
		$data_nova = $data;
		$ano = $data_nova[0].$data_nova[1].$data_nova[2].$data_nova[3];
		$mes = $data_nova[5].$data_nova[6];
		$dia = $data_nova[8].$data_nova[9];
		$data = $dia."/".$mes."/".$ano;
		return $data;
	}
	
	session_start();

	if (!(isset($_SESSION['id_instituicao']) != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'])){
		header("Location: /index.php");
	}
	require_once("../boletim/scripts/conecta.php");
	
	/* CDIGO PARA ORDENAR A TABELA PELO CABEALHO CLICADO */
	if(!isset($_GET['ordem'])){
		$ordem = '2_nome_completo';
	}
	else{
		switch($_GET['ordem']){
			case 0: $ordem = 'cod_aluno'; break;
			case 1: $ordem = '2_nome_completo'; break;
			case 2: $ordem = 'email'; break;
			case 3: $ordem = 'matricula'; break;
		}
	}
	
	/* CDIGO PARA ALTERNAR O NOME E A AO DO BOTO ENTRE ALTERAR E CADASTRAR */
	if(!isset($_GET['acao'])){
		$acao = 1; // CADASTRAR
	}
	else {
		if($_GET['acao'] == 1){
			$acao = 1; // CADASTRAR
		}
		else {
			$acao = 2; // ALTERAR
		}	
	}
	
	/* CDIGO PARA O CARREGAMENTO DOS CAMPOS CASO SEJA UMA ALTERAO */
	if(isset($_GET['id'])){
		$recupera = mysql_query("SELECT * FROM aluno WHERE cod_instituicao = ".$_SESSION['id_instituicao']." AND cod_aluno = ".$_GET['id']) or die ("Error na consulta");
		$result = mysql_fetch_array($recupera);
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr">
	<head>
		<link type="text/css" rel="stylesheet" href="../css/estilo.css" />
		<script language="javascript" type="text/javascript">
			function formatar(src, mask){
				var i = src.value.length;
				var saida = mask.substring(0,1);
				var texto = mask.substring(i)
				if (texto.substring(0,1) != saida){
					src.value += texto.substring(0,1);
				}
			}
		</script>
	</head>
	<body>
		<div class="corpo">
			<?php  require_once('../partes/menu_login.php');?>	
			<div class="conteudo">
				<div class="titulo">
					Cadastro de Aluno
				</div>
				<div class="formulario">
					<form name="cad_aluno" action="/boletim/scripts/objeto_aluno.php" method="POST">
							<input type="hidden" name="cod_aluno" value="<?php if($acao != 1) echo $result['cod_aluno'];?>" class="campo" style="width: 400px;"/>
							<input type="hidden" name="acao" value="<?php if($acao == 1) echo "insert_aluno"; else echo "update_aluno";?>" />
						<blockquote>
							<img src="../img/linha_identificacao.png" WIDTH="100%"/><br><br>
							<a style="font-weight: bolder">1 - Identificao nica (cdigo gerado pelo INEP):</a><br>
							<input name="1_identificacao_unica" value="<?php if($acao != 1) echo $result['1_identificacao_unica'];?>" class="campo" style="width: 200px;"/><br>
							
							<a style="font-weight: bolder">2 - Nome Completo:</a><br>
							<input name="2_nome_completo" value="<?php if($acao != 1) echo $result['2_nome_completo'];?>" class="campo" style="width: 600px;"/><br>
							
							<a style="font-weight: bolder">3 - Nmero de Identificao Social (NIS):</a><br>
							<input name="3_nis" value="<?php if($acao != 1) echo $result['3_nis'];?>" class="campo" style="width: 190px;"/><br>
							
							<a style="font-weight: bolder">4 - Data de Nascimento:</a><br>
							<input name="4_data_nascimento" OnKeyPress="formatar(this, '##/##/####')" value="<?php if($acao != 1) echo converte_data_tela($result['4_data_nascimento']);?>" class="campo" style="width: 170px;"/> <a style="font-size: 9;">(dd/mm/aaaa)</a><br>
							
							<a style="font-weight: bolder">5 - Sexo:</a><br><br>
							<input type="radio" name="5_sexo" checked <?php if($acao != 1 && "M" == $result['5_sexo']) echo "checked";?> value="M" />Masculino</input><br>
							<input type="radio" name="5_sexo" <?php if($acao != 1 && "F" == $result['5_sexo']) echo "checked";?> value="F" />Feminino</input>
							<br><br>
							
							<a style="font-weight: bolder">6 - Cor/Raa:</a><br><br>
							<input type="radio" name="6_cor_raca" checked <?php if($acao != 1 && 1 == $result['6_cor_raca']) echo "checked";?> value=1 />Branca</input><br>
							<input type="radio" name="6_cor_raca" <?php if($acao != 1 && 2 == $result['6_cor_raca']) echo "checked";?> value=2 />Preta</input><br>
							<input type="radio" name="6_cor_raca" <?php if($acao != 1 && 3 == $result['6_cor_raca']) echo "checked";?> value=3 />Parda</input><br>
							<input type="radio" name="6_cor_raca" <?php if($acao != 1 && 4 == $result['6_cor_raca']) echo "checked";?> value=4 />Amarela</input><br>
							<input type="radio" name="6_cor_raca" <?php if($acao != 1 && 5 == $result['6_cor_raca']) echo "checked";?> value=5 />Indgena</input><br>
							<input type="radio" name="6_cor_raca" <?php if($acao != 1 && 6 == $result['6_cor_raca']) echo "checked";?> value=6 />No Declarada</input>
							<br><br>
							
							<a style="font-weight: bolder">7 - Filiao (Informar nome completo):</a><br>
							<a style="font-weight: bolder">Nome da Me:</a><br>
							<input name="7_mae" value="<?php if($acao != 1) echo $result['7_mae'];?>" class="campo" style="width: 600px;"/><br>
							<a style="font-weight: bolder">Nome do Pai:</a><br>
							<input name="7_pai" value="<?php if($acao != 1) echo $result['7_pai'];?>" class="campo" style="width: 600px;"/><br>
							
							<a style="font-weight: bolder">8 - Nacionalidade do aluno:</a><br><br>
							<input type="radio" name="8_nacionalidade" checked <?php if($acao != 1 && 1 == $result['8_nacionalidade']) echo "checked";?> value=1 />Brasileira</input><br>
							<input type="radio" name="8_nacionalidade" <?php if($acao != 1 && 2 == $result['8_nacionalidade']) echo "checked";?> value=2 />Brasileira - nascido no exterior ou naturalizado</input><br>
							<input type="radio" name="8_nacionalidade" <?php if($acao != 1 && 3 == $result['8_nacionalidade']) echo "checked";?> value=3 />Estrangeira</input>
							<br><br>
							
							<a style="font-weight: bolder">9 - Pas de Origem:</a><br>
							<input name="9_pais_origem" value="<?php if($acao != 1) echo $result['9_pais_origem'];?>" class="campo" style="width: 45px;"/><br>
							
							<a style="font-weight: bolder">10 - UF de nascimento:</a><br>
							<input name="10_uf_nascimento" value="<?php if($acao != 1) echo $result['10_uf_nascimento'];?>" class="campo" style="width: 30px;"/><br>
							
							<a style="font-weight: bolder">11 - Municpio de nascimento:</a><br>
							<input name="11_municipio_nascimento" value="<?php if($acao != 1) echo $result['11_municipio_nascimento'];?>" class="campo" style="width: 200px;"/><br>
							
							<a style="font-weight: bolder">12 - Aluno com deficincia, transtorno global do desenvolvimento ou altas habilidades/superdotao:</a><br>							<br>
							<input type="radio" name="12_deficiencia" checked value=1 />Sim</input><br>
							<input type="radio" name="12_deficiencia" value=2 />No</input>
							<br><br>
							
							<a style="font-weight: bolder">12a - Tipo de deficincia, transtorno global do desenvolvimento ou altas habilidades/superdotao:</a><br>
							<br>
							<b>Deficincia</b><br>
							<input type="radio" name="12a_tipo_deficiencia" checked <?php if($acao != 1 && 1 == $result['12a_tipo_deficiencia']) echo "checked";?> value=1 />Cegueira</input><br>
							<input type="radio" name="12a_tipo_deficiencia" <?php if($acao != 1 && 2 == $result['12a_tipo_deficiencia']) echo "checked";?> value=2 />Baixa Viso</input><br>
							<input type="radio" name="12a_tipo_deficiencia" <?php if($acao != 1 && 3 == $result['12a_tipo_deficiencia']) echo "checked";?> value=3 />Surdez</input><br>
							<input type="radio" name="12a_tipo_deficiencia" <?php if($acao != 1 && 4 == $result['12a_tipo_deficiencia']) echo "checked";?> value=4 />Deficincia Auditiva</input><br>
							<input type="radio" name="12a_tipo_deficiencia" <?php if($acao != 1 && 5 == $result['12a_tipo_deficiencia']) echo "checked";?> value=5 />Surdocegueira</input><br>
							<input type="radio" name="12a_tipo_deficiencia" <?php if($acao != 1 && 6 == $result['12a_tipo_deficiencia']) echo "checked";?> value=6 />Deficincia Fsica</input><br>
							<input type="radio" name="12a_tipo_deficiencia" <?php if($acao != 1 && 7 == $result['12a_tipo_deficiencia']) echo "checked";?> value=7 />Deficincia Intelectual</input><br>
							<input type="radio" name="12a_tipo_deficiencia" <?php if($acao != 1 && 8 == $result['12a_tipo_deficiencia']) echo "checked";?> value=8 />Deficincia Mltipla</input><br>
							<br><b>Transtorno Global do Desenvolvimento</b><br>
							<input type="radio" name="12a_tipo_deficiencia" <?php if($acao != 1 && 9 == $result['12a_tipo_deficiencia']) echo "checked";?> value=9 />Autismo Infantil</input><br>
							<input type="radio" name="12a_tipo_deficiencia" <?php if($acao != 1 && 10 == $result['12a_tipo_deficiencia']) echo "checked";?> value=10 />Sindrome de Aspenger</input><br>
							<input type="radio" name="12a_tipo_deficiencia" <?php if($acao != 1 && 11 == $result['12a_tipo_deficiencia']) echo "checked";?> value=11 />Sndrome de Rett</input><br>
							<input type="radio" name="12a_tipo_deficiencia" <?php if($acao != 1 && 12 == $result['12a_tipo_deficiencia']) echo "checked";?> value=12 />Transtorno desintegrativo da infncia</input><br>
							<br><b>Altas habilidades/Superdotao</b><br>
							<input type="radio" name="12a_tipo_deficiencia" <?php if($acao != 1 && 13 == $result['12a_tipo_deficiencia']) echo "checked";?> value=13 />Altas habilidades/Superdotao</input><br>
							<br><br>
							
							<img src="../img/linha_documento.png" WIDTH="100%"/><br><br>
							
							<a style="font-weight: bolder">13 - Nmero da identidade:</a><br>
							<input name="13_identidade" value="<?php if($acao != 1) echo $result['13_identidade'];?>" class="campo" style="width: 200px;"/><br>
							
							<a style="font-weight: bolder">13a - Complemento da identidade:</a><br>
							<input name="13a_complemento_identidade" value="<?php if($acao != 1) echo $result['13a_complemento_identidade'];?>" class="campo" style="width: 45px;"/><br>
							
							<a style="font-weight: bolder">13b - rgo emissor da identidade:</a><br>
							<input name="13b_orgao_emissor" value="<?php if($acao != 1) echo $result['13b_orgao_emissor'];?>" class="campo" style="width: 120px;"/><br>
							
							<a style="font-weight: bolder">13c - UF da identidade:</a><br>
							<input name="13c_uf" value="<?php if($acao != 1) echo $result['13c_uf'];?>" class="campo" style="width: 30px;"/><br>
							
							<a style="font-weight: bolder">13d - Data de expedio da identidade:</a><br>
							<input name="13d_data_emissao" OnKeyPress="formatar(this, '##/##/####')" value="<?php if($acao != 1) echo converte_data_tela($result['13d_data_emissao']);?>" class="campo" style="width: 100px;"/> <a style="font-size: 9;">(dd/mm/aaaa)</a><br>
							
							<a style="font-weight: bolder">14 - Certido Civil (Se a certido foi emitida at 31/12/2009 - modelo antigo - preencher os campos 14a a 14h. Caso a certido tenha sido emitida a partir de 01/01/2010 - modelo novo - preencher somente o campo 14i):</a><br><br>
							<input type="radio" name="14_certidao_civil" checked <?php if($acao != 1 && 1 == $result['14_certidao_civil']) echo "checked";?> value=1 />Modelo Antigo</input><br>
							<input type="radio" name="14_certidao_civil" <?php if($acao != 1 && 2 == $result['14_certidao_civil']) echo "checked";?> value=2 />Modelo Novo</input>
							<br><br>
							
							<a style="font-weight: bolder">14a - Tipo de certido civil:</a><br>
							<br>
							<input type="radio" name="14a_tipo" checked <?php if($acao != 1 && 1 == $result['14a_tipo']) echo "checked";?> value=1 />Certido de nascimento</input><br>
							<input type="radio" name="14a_tipo" <?php if($acao != 1 && 2 == $result['14a_tipo']) echo "checked";?> value=2 />Certido de casamento</input>
							<br><br>
							
							<a style="font-weight: bolder">14b - Nmero do termo:</a><br>
							<input name="14b_numero_termo" value="<?php if($acao != 1) echo $result['14b_numero_termo'];?>" class="campo" style="width: 120px;"/><br>
							
							<a style="font-weight: bolder">14c - Folha:</a><br>
							<input name="14c_folha" value="<?php if($acao != 1) echo $result['14c_folha'];?>" class="campo" style="width: 80px;"/><br>
							
							<a style="font-weight: bolder">14d - Livro:</a><br>
							<input name="14d_livro" value="<?php if($acao != 1) echo $result['14d_livro'];?>" class="campo" style="width: 100px;"/><br>
							
							<a style="font-weight: bolder">14e - Data de Emisso da certido:</a><br>
							<input name="14e_data_emissao_certidao" OnKeyPress="formatar(this, '##/##/####')" value="<?php if($acao != 1) echo converte_data_tela($result['14e_data_emissao_certidao']);?>" class="campo" style="width: 120px;"/> <a style="font-size: 9;">(dd/mm/aaaa)</a><br>
							
							<a style="font-weight: bolder">14f - UF do cartrio:</a><br>
							<input name="14f_uf_cartorio" value="<?php if($acao != 1) echo $result['14f_uf_cartorio'];?>" class="campo" style="width: 30px;"/><br>
							
							<a style="font-weight: bolder">14g - Municpio do cartrio:</a><br>
							<input name="14g_municipio_cartorio" value="<?php if($acao != 1) echo $result['14g_municipio_cartorio'];?>" class="campo" style="width: 200px;"/><br>
							
							<a style="font-weight: bolder">14h - Nome do cartrio:</a><br>
							<input name="14h_nome_cartorio" value="<?php if($acao != 1) echo $result['14h_nome_cartorio'];?>" class="campo" style="width: 600px;"/><br>
							
							<a style="font-weight: bolder">14i - Nmero da Matricula (Registro Civil - Certido Nova):</a><br>
							<input name="14i_numero_matricula" OnKeyPress="formatar(this, '######-##-##-####-#-#####-###-#######-##')" value="<?php if($acao != 1) echo $result['14i_numero_matricula'];?>" class="campo" style="width: 500px;"/><br>
							
							<a style="font-weight: bolder">15 - Nmero do CPF:</a><br>
							<input name="15_cpf" OnKeyPress="formatar(this, '###.###.###-##')" value="<?php if($acao != 1) echo $result['15_cpf'];?>" class="campo" style="width: 200px;"/> <a style="font-size: 9;">(Somente nmeros.)</a><br>
							
							<a style="font-weight: bolder">16 - Documento estrangeiro/Passaporte:</a><br>
							<input name="16_passaporte" value="<?php if($acao != 1) echo $result['16_passaporte'];?>" class="campo" style="width: 250px;"/><br><br>
							
							<img src="../img/linha_endereco.png" WIDTH="100%"/><br><br>
							
							<a style="font-weight: bolder">17 - Localizao/Zona de Residncia:</a><br>
							<br>
							<input type="radio" name="17_localizacao" checked <?php if($acao != 1 && 1 == $result['17_localizacao']) echo "checked";?> value=1 />Urbana</input><br>
							<input type="radio" name="17_localizacao" <?php if($acao != 1 && 2 == $result['17_localizacao']) echo "checked";?> value=2 />Rural</input>
							<br><br>
							
							<a style="font-weight: bolder">18 - CEP:</a><br>
							<input name="18_cep" value="<?php if($acao != 1) echo $result['18_cep'];?>" class="campo" style="width: 100px;"/><br>
							
							<a style="font-weight: bolder">19 - Endereo:</a><br>
							<input name="19_endereco" value="<?php if($acao != 1) echo $result['19_endereco'];?>" class="campo" style="width: 600px;"/><br>
							
							<a style="font-weight: bolder">20 - Nmero:</a><br>
							<input name="20_numero" value="<?php if($acao != 1) echo $result['20_numero'];?>" class="campo" style="width: 80px;"/><br>
							
							<a style="font-weight: bolder">21 - Complemento:</a><br>
							<input name="21_complemento" value="<?php if($acao != 1) echo $result['21_complemento'];?>" class="campo" style="width: 250px;"/><br>
							
							<a style="font-weight: bolder">22 - Bairro:</a><br>
							<input name="22_bairro" value="<?php if($acao != 1) echo $result['22_bairro'];?>" class="campo" style="width: 400px;"/><br>
							
							<a style="font-weight: bolder">23 - UF:</a><br>
							<input name="23_uf" value="<?php if($acao != 1) echo $result['23_uf'];?>" class="campo" style="width: 30px;"/><br>
							
							<a style="font-weight: bolder">24 - Municpio:</a><br>
							<input name="24_municipio" value="<?php if($acao != 1) echo $result['24_municipio'];?>" class="campo" style="width: 300px;"/><br><br>
							
							<img src="../img/linha_dadosvar.png" WIDTH="100%"/><br><br>
							
							<a style="font-weight: bolder">25 - Nome da Turma:</a><br>
							<input name="25_nome_turma" value="<?php if($acao != 1) echo $result['25_nome_turma'];?>" class="campo" style="width: 600px;"/><br>
							
							<a style="font-weight: bolder">26 - Turma Unificada:</a><br>
							<br>
							<input type="radio" name="26_turma_unificada" checked <?php if($acao != 1 && 1 == $result['26_turma_unificada']) echo "checked";?> value=1 />Creche</input><br>
							<input type="radio" name="26_turma_unificada" <?php if($acao != 1 && 2 == $result['26_turma_unificada']) echo "checked";?> value=2 />Pr-escola</input>
							<br><br>
							
							<a style="font-weight: bolder">27 - Turma multietapa, multi, correo de fluxo, EJA fundamental anos iniciais e anos finais ou educao Profissional Mista:</a><br>
							<a style="font-weight: bolder">Educao Infantil</a><br>
							<br>
							<input type="radio" name="27_educacao_infantil" checked <?php if($acao != 1 && 1 == $result['27_educacao_infantil']) echo "checked";?> value=1 />Creche</input><br>
							<input type="radio" name="27_educacao_infantil" <?php if($acao != 1 && 2 == $result['27_educacao_infantil']) echo "checked";?> value=2 />Pr-escola</input>
							<br><br>
							<a style="font-weight: bolder">Ensino Fundamental</a><br>
							<br>
							Srie <input name="27_ensino_fundamental_serie" value="<?php if($acao != 1) echo $result['27_ensino_fundamental_seie'];?>" class="campo" style="width: 30px;"/><br>
							Ano <input name="27_ensino_fundamental_ano" value="<?php if($acao != 1) echo $result['27_ensino_fundamental_ano'];?>" class="campo" style="width: 30px;"/><br>
							<br>
							<a style="font-weight: bolder">Educao de Jovens e Adutos</a><br>
							<br>
							<input type="radio" name="27_educacao_jovens_adultos" checked <?php if($acao != 1 && 1 == $result['27_educacao_jovens_adultos']) echo "checked";?> value=1 />Anos iniciais</input><br>
							<input type="radio" name="27_educacao_jovens_adultos" <?php if($acao != 1 && 2 == $result['27_educacao_jovens_adultos']) echo "checked";?> value=2 />Anos finais</input>
							<br><br>
							<a style="font-weight: bolder">Educao Profissional Mista</a><br>
							<br>
							<input type="radio" name="27_educacao_profissional_mista" checked <?php if($acao != 1 && 1 == $result['27_educacao_profissional_mista']) echo "checked";?> value=1 />Concomitante</input><br>
							<input type="radio" name="27_educacao_profissional_mista" <?php if($acao != 1 && 2 == $result['27_educacao_profissional_mista']) echo "checked";?> value=2 />Subsequente</input>
							<br><br>
							<a style="font-weight: bolder">28 - Recebe escolarizao em outro espao (diferente da escola):</a><br>
							<br>
							<input type="radio" name="28_escolarizacao_fora_escola" checked <?php if($acao != 1 && 1 == $result['28_escolarizacao_fora_escola']) echo "checked";?> value=1 />Creche</input><br>
							<input type="radio" name="28_escolarizacao_fora_escola" <?php if($acao != 1 && 2 == $result['28_escolarizacao_fora_escola']) echo "checked";?> value=2 />Pr-escola</input>
							<br><br>
							
							<a style="font-weight: bolder">29 - Transporte Escolar Pblico:</a><br>
							<br>
							<input type="radio" name="29_transporte_publico" checked <?php if($acao != 1 && 1 == $result['29_transporte_publico']) echo "checked";?> value=1 />Creche</input><br>
							<input type="radio" name="29_transporte_publico" <?php if($acao != 1 && 2 == $result['29_transporte_publico']) echo "checked";?> value=2 />Pr-escola</input>
							<br><br>
							
							<a style="font-weight: bolder">29a - Poder pblico responsvel pelo transporte escolar:</a><br>
							<br>
							<input type="radio" name="29a_poder_responsavel" checked <?php if($acao != 1 && 1 == $result['29a_poder_responsavel']) echo "checked";?> value=1 />Creche</input><br>
							<input type="radio" name="29a_poder_responsavel" <?php if($acao != 1 && 2 == $result['29a_poder_responsavel']) echo "checked";?> value=2 />Pr-escola</input>
							<br><br>
							
							<img src="../img/linha_adicionais.png" WIDTH="100%"/><br><br>
							
							<a style="font-weight: bolder">30 - Curso:</a><br>
							<select name="cod_curso" class="campo" style="width: 250px;">
								<?php 
									$query_curso = mysql_query("SELECT cod_curso, curso.nome FROM curso WHERE curso.cod_instituicao = ".$_SESSION['id_instituicao']." ORDER BY curso.nome") or die ("Error na consulta");
									while ($res_curso = mysql_fetch_array($query_curso)){
								?>
								<option <?php if($acao != 1 && $res_curso[0] == $result['cod_curso']) echo "selected='selected'";?> value="<?php echo $res_curso[0];?>"><?php echo $res_curso[1];?></option>
								<?php 
									}
								?>
							</select><br>
							
							<a style="font-weight: bolder">31 - Email:</a><br>
							<input name="email" value="<?php if($acao != 1) echo $result['email'];?>" class="campo" style="width: 200px;"/><br>
							
							<a style="font-weight: bolder">32 - Nome do Responsavel:</a><br>
							<input name="nome_responsavel" value="<?php if($acao != 1) echo $result['nome_responsavel'];?>" class="campo" style="width: 600px;"/><br>
							
							<a style="font-weight: bolder">33 - Email do Responsavel:</a><br>
							<input name="email_responsavel" value="<?php if($acao != 1) echo $result['email_responsavel'];?>" class="campo" style="width: 200px;"/><br>
							
							<a style="font-weight: bolder">34 - Matricula:</a><br>
							<input name="matricula" value="<?php if($acao != 1) echo $result['matricula'];?>" class="campo" style="width: 200px;"/><br>
							
							<a style="font-weight: bolder">35 - Status:</a><br>
							<select name="cod_status" class="campo" style="width: 200px;">
								<?php 
									$query_status = mysql_query("SELECT cod_status, nome FROM status2 ORDER BY cod_status") or die ("Error na consulta");
									while ($res_status = mysql_fetch_array($query_status)){
								?>
								<option <?php if($acao != 1 && $res_status[0] == $result['cod_status']) echo "selected='selected'";?> value="<?php echo $res_status[0];?>"><?php echo $res_status[1];?></option>
								<?php 
									}
								?>
							</select><br>
						</blockquote>
				</div>
				<div class="rodape_form">
					<center>
						<a style="font-weight: bolder; font-size: 12; color: red;">
							<?php 
								if(isset($_GET['sucesso'])){
									if($_GET['sucesso'] == 0) echo "Cadastrado com sucesso!";
									elseif ($_GET['sucesso'] == 1) echo "Alterado com sucesso!";
								}
							?>
						</a><br>
						<input name="submit" type="submit" value="<?php if($acao == 1) echo "Cadastrar"; else echo "Atualizar";?>" class="botao"/>
						<input type="button" onClick="javascript: location.href='/paginas/cadastro_aluno.php?acao=1';" value="Cancelar" class="botao"/>
					</center>
				</div>
			</form>							
			</div>			
		</div>
	</body>
</html>