<?php 
	session_start();
	if (!(isset($_SESSION['id_instituicao']) != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'])){
		header("Location: ../index.php");
	}
	require_once("../boletim/scripts/conecta.php");
	
	/* CDIGO PARA ORDENAR A TABELA PELO CABEALHO CLICADO */
	if(!isset($_GET['ordem'])){
		$ordem = '1_';
	}
	else{
		switch($_GET['ordem']){
			case 0: $ordem = 'cod_turma'; break;
			case 1: $ordem = '1_'; break;
			case 2: $ordem = 'curso.nome'; break;
			case 3: $ordem = 'turno'; break;
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
		$recupera = mysql_query("SELECT * FROM turma WHERE cod_instituicao = ".$_SESSION['id_instituicao']." AND cod_turma = ".$_GET['id']) or die ("Error na consulta");
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
					<!--<img src="../img/Bandeira_cadastro_turmas.png" />-->
					Cadastro de Turma
				</div>
				<div class="formulario">
					<form name="cad_turma" action="/boletim/scripts/objeto_turma.php" method="POST">
						<input type="hidden" name="cod_turma" value="<?php if($acao != 1) echo $result[0];?>" class="campo" style="width: 400px;"/>
						<input type="hidden" name="acao" value="<?php if($acao == 1) echo "insert_turma"; else echo "update_turma";?>" />
						<blockquote>
							<img src="../img/linha_identificacao.png" WIDTH="100%"/><br><br>
							
							<a style="font-weight: bolder">1 - Nome da turma:</a><br>
							<input name="1" value="<?php if($acao != 1) echo $result['1_'];?>" class="campo" style="width: 600px;"/><br><br>
							
							<a style="font-weight: bolder">2 - Horrio de Funcionamento:</a><br>							
							<br>
							Horrio Inicial - <input name="2_1" OnKeyPress="formatar(this, '##:##')" value="<?php if($acao != 1) echo $result['2_1_'];?>" class="campo" style="width: 100px;"/><br>
							Horrio Final  - <input name="2_2" OnKeyPress="formatar(this, '##:##')" value="<?php if($acao != 1) echo $result['2_2_'];?>" class="campo" style="width: 100px;"/><br><br>
							
							<a style="font-weight: bolder">3 - Tipo de atendimento:</a><br>
							<br>
							<input type="radio" name="3" <?php if($acao != 1 && "1" == $result['3_']) echo "checked";?> value="1" />Classe hospitalar</input><br>
							<input type="radio" name="3" <?php if($acao != 1 && "2" == $result['3_']) echo "checked";?> value="2" />Unidade de internao</input><br>
							<input type="radio" name="3" <?php if($acao != 1 && "3" == $result['3_']) echo "checked";?> value="3" />Unidade prisional</input><br>
							<input type="radio" name="3" <?php if($acao != 1 && "4" == $result['3_']) echo "checked";?> value="4" />Atividade complementar</input><br>
							<input type="radio" name="3" <?php if($acao != 1 && "5" == $result['3_']) echo "checked";?> value="5" />Atendimento Educacional Especializado (AEE)</input><br>
							<input type="radio" name="3" <?php if($acao != 1 && "6" == $result['3_']) echo "checked";?> value="6" />No se aplica</input>
							<br><br>
							
							<a style="font-weight: bolder">4 - Frequncia semanal da turma que realiza a Atividade Complementar ou o Atendimento Educacional Especializado (AEE):</a><br>
							<br>
							<input type="radio" name="4" <?php if($acao != 1 && "1" == $result['4_']) echo "checked";?> value="1" />1</input><br>
							<input type="radio" name="4" <?php if($acao != 1 && "2" == $result['4_']) echo "checked";?> value="2" />2</input><br>
							<input type="radio" name="4" <?php if($acao != 1 && "3" == $result['4_']) echo "checked";?> value="3" />3</input><br>
							<input type="radio" name="4" <?php if($acao != 1 && "4" == $result['4_']) echo "checked";?> value="4" />4</input><br>
							<input type="radio" name="4" <?php if($acao != 1 && "5" == $result['4_']) echo "checked";?> value="5" />5</input>
							<br><br>
							
							<a style="font-weight: bolder">5 - Tipo de atividade Complementar:</a><br>
							Cdigos
							<br>
							<input name="5_1" value="<?php if($acao != 1) echo $result['5_1_'];?>" class="campo" style="width: 75px;"/><br>
							<input name="5_2" value="<?php if($acao != 1) echo $result['5_2_'];?>" class="campo" style="width: 75px;"/><br>
							<input name="5_3" value="<?php if($acao != 1) echo $result['5_3_'];?>" class="campo" style="width: 75px;"/><br>
							<input name="5_4" value="<?php if($acao != 1) echo $result['5_4_'];?>" class="campo" style="width: 75px;"/><br>
							<input name="5_5" value="<?php if($acao != 1) echo $result['5_5_'];?>" class="campo" style="width: 75px;"/><br>
							<input name="5_6" value="<?php if($acao != 1) echo $result['5_6_'];?>" class="campo" style="width: 75px;"/><br><br>
							
							<a style="font-weight: bolder">6 - Atividades de Atendimento Educacional Especializado (AEE):</a><br>
							<br>
							<input type="checkbox" name="6_1" <?php if($acao != 1 && "true" == $result['6_1_']) echo "checked";?> value="true" />Ensino do Sistema Braille</input><br>
							<input type="checkbox" name="6_2" <?php if($acao != 1 && "true" == $result['6_2_']) echo "checked";?> value="true" />Ensino do uso de recursos pticos e no pticos</input><br>
							<input type="checkbox" name="6_3" <?php if($acao != 1 && "true" == $result['6_3_']) echo "checked";?> value="true" />Estratgias para o desenvolvimento de processos mentais</input><br>
							<input type="checkbox" name="6_4" <?php if($acao != 1 && "true" == $result['6_4_']) echo "checked";?> value="true" />Tcnicas de orientao e mobilidade</input><br>
							<input type="checkbox" name="6_5" <?php if($acao != 1 && "true" == $result['6_5_']) echo "checked";?> value="true" />Ensino da Lngua Brasileira de Sinais - LIBRAS</input><br>
							<input type="checkbox" name="6_6" <?php if($acao != 1 && "true" == $result['6_6_']) echo "checked";?> value="true" />Ensino do uso da Comunicao Alternativa e Aumentativa - CAA</input><br>
							<input type="checkbox" name="6_7" <?php if($acao != 1 && "true" == $result['6_7_']) echo "checked";?> value="true" />Estratgias para enriquecimento curricular</input><br>
							<input type="checkbox" name="6_8" <?php if($acao != 1 && "true" == $result['6_8_']) echo "checked";?> value="true" />Ensino do uso do Soroban</input><br>
							<input type="checkbox" name="6_9" <?php if($acao != 1 && "true" == $result['6_9_']) echo "checked";?> value="true" />Ensino da usabilidade e das funcionalidades da informtica acessivel</input><br>
							<input type="checkbox" name="6_10" <?php if($acao != 1 && "true" == $result['6_10_']) echo "checked";?> value="true" />Ensino da Lngua Portuguesa na modalidade escrita</input><br>
							<input type="checkbox" name="6_11" <?php if($acao != 1 && "true" == $result['6_11_']) echo "checked";?> value="true" />Estratgias para autonomia no ambiente escolar</input>
							<br><br>
							
							<a style="font-weight: bolder">7 - Modalidade:</a><br>
							<br>
							<input type="radio" name="7" <?php if($acao != 1 && "1" == $result['7_']) echo "checked";?> value="1" />Ensino Regular</input><br>
							<input type="radio" name="7" <?php if($acao != 1 && "2" == $result['7_']) echo "checked";?> value="2" />Educao Especial - Modalidade Substitutiva</input><br>
							<input type="radio" name="7" <?php if($acao != 1 && "3" == $result['7_']) echo "checked";?> value="3" />Educao de Jovens e Adultos</input>
							<br><br>
							
							<a style="font-weight: bolder">8 - Etapa:</a><br><br>
							
							Educao Infantil<br>
							<input type="radio" name="8" <?php if($acao != 1 && "1" == $result['8_']) echo "checked";?> value="1" />Creche</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "2" == $result['8_']) echo "checked";?> value="2" />Pr-escola</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "3" == $result['8_']) echo "checked";?> value="3" />Unificada</input><br>
							<br><hr>
							
							Educao Infantil e Ensino Fundamental (8 e 9 anos)<br>
							<input type="radio" name="8" <?php if($acao != 1 && "4" == $result['8_']) echo "checked";?> value="4" />Multietapa</input>
							<br><hr>
							
							Ensino Fundamental (8 anos)<br>
							<input type="radio" name="8" <?php if($acao != 1 && "5" == $result['8_']) echo "checked";?> value="5" />1 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "6" == $result['8_']) echo "checked";?> value="6" />2 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "7" == $result['8_']) echo "checked";?> value="7" />3 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "8" == $result['8_']) echo "checked";?> value="8" />4 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "9" == $result['8_']) echo "checked";?> value="9" />5 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "10" == $result['8_']) echo "checked";?> value="10" />6 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "11" == $result['8_']) echo "checked";?> value="11" />7 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "12" == $result['8_']) echo "checked";?> value="12" />8 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "13" == $result['8_']) echo "checked";?> value="13" />Multi</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "14" == $result['8_']) echo "checked";?> value="14" />Correo de Fluxo</input>
							<br><hr>
							
							Ensino Fundamental (9 anos)<br>
							<input type="radio" name="8" <?php if($acao != 1 && "15" == $result['8_']) echo "checked";?> value="15" />1 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "16" == $result['8_']) echo "checked";?> value="16" />2 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "17" == $result['8_']) echo "checked";?> value="17" />3 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "18" == $result['8_']) echo "checked";?> value="18" />4 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "19" == $result['8_']) echo "checked";?> value="19" />5 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "20" == $result['8_']) echo "checked";?> value="20" />6 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "21" == $result['8_']) echo "checked";?> value="21" />7 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "22" == $result['8_']) echo "checked";?> value="22" />8 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "23" == $result['8_']) echo "checked";?> value="23" />9 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "24" == $result['8_']) echo "checked";?> value="24" />Multi</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "25" == $result['8_']) echo "checked";?> value="25" />Correo de Fluxo</input>
							<br><hr>
							
							Ensino Fundamental (8 e 9 anos)<br>
							<input type="radio" name="8" <?php if($acao != 1 && "26" == $result['8_']) echo "checked";?> value="26" />Multi 8 e 9 anos</input>
							<br><hr>
							
							Ensino Mdio<br>
							<input type="radio" name="8" <?php if($acao != 1 && "27" == $result['8_']) echo "checked";?> value="27" />1 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "28" == $result['8_']) echo "checked";?> value="28" />2 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "29" == $result['8_']) echo "checked";?> value="29" />3 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "30" == $result['8_']) echo "checked";?> value="30" />4 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "31" == $result['8_']) echo "checked";?> value="31" />No seriada</input>
							<br><hr>
							
							Ensino Mdio Integrado<br>
							<input type="radio" name="8" <?php if($acao != 1 && "32" == $result['8_']) echo "checked";?> value="32" />1 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "33" == $result['8_']) echo "checked";?> value="33" />2 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "34" == $result['8_']) echo "checked";?> value="34" />3 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "35" == $result['8_']) echo "checked";?> value="35" />4 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "36" == $result['8_']) echo "checked";?> value="36" />No seriada</input>
							<br>Cdigo do Curso - <input name="8_1_" value="<?php if($acao != 1) echo $result['8_1_'];?>" class="campo" style="width: 100px;"/><br><br>
							<br><hr>
							
							Ensino Mdio - Normal/Magistrio<br>
							<input type="radio" name="8" <?php if($acao != 1 && "37" == $result['8_']) echo "checked";?> value="37" />1 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "38" == $result['8_']) echo "checked";?> value="38" />2 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "39" == $result['8_']) echo "checked";?> value="39" />3 srie</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "40" == $result['8_']) echo "checked";?> value="40" />4 srie</input><br>
							<br><hr>
							
							Educao Profissional<br>
							<input type="radio" name="8" <?php if($acao != 1 && "41" == $result['8_']) echo "checked";?> value="41" />Concomitante</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "42" == $result['8_']) echo "checked";?> value="42" />Subsequente</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "43" == $result['8_']) echo "checked";?> value="43" />Mista - Concomitante e Subsequente</input>
							<br>Cdigo do Curso - <input name="8_2_" value="<?php if($acao != 1) echo $result['8_2_'];?>" class="campo" style="width: 100px;"/><br><br>
							<br><hr>
							
							Educao de Jovens e Adultos<br>
							<input type="radio" name="8" <?php if($acao != 1 && "44" == $result['8_']) echo "checked";?> value="44" />Presencial</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "45" == $result['8_']) echo "checked";?> value="45" />Semipresencial</input><br>
							<br><hr>
							
							Educao de Jovens e Adultos - Etapa<br>
							<input type="radio" name="8" <?php if($acao != 1 && "46" == $result['8_']) echo "checked";?> value="46" />Ensino Fundamental anos iniciais</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "47" == $result['8_']) echo "checked";?> value="47" />Ensino Fundamental anos finais</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "48" == $result['8_']) echo "checked";?> value="48" />Ensino Fundamental anos iniciais e anos finais</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "49" == $result['8_']) echo "checked";?> value="49" />EJA integrada  Educao Profissional de Nvel Fundamental (FIC)</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "50" == $result['8_']) echo "checked";?> value="50" />Ensino Mdio</input><br>
							<input type="radio" name="8" <?php if($acao != 1 && "51" == $result['8_']) echo "checked";?> value="51" />EJA integrada  Educao Profissional de Nvel Mdio</input>
							<br>Cdigo do Curso - <input name="8_3_" value="<?php if($acao != 1) echo $result['8_3_'];?>" class="campo" style="width: 100px;"/><br><br>
							<br><hr>
							
							<a style="font-weight: bolder">9 - Disciplina:</a><br>
							<br>
							<input type="checkbox" name="9_1" <?php if($acao != 1 && "true" == $result['9_1_']) echo "checked";?> value="true" />Qumica</input><br>
							<input type="checkbox" name="9_2" <?php if($acao != 1 && "true" == $result['9_2_']) echo "checked";?> value="true" />Fsica</input><br>
							<input type="checkbox" name="9_3" <?php if($acao != 1 && "true" == $result['9_3_']) echo "checked";?> value="true" />Matemtica</input><br>
							<input type="checkbox" name="9_4" <?php if($acao != 1 && "true" == $result['9_4_']) echo "checked";?> value="true" />Biologia</input><br>
							<input type="checkbox" name="9_5" <?php if($acao != 1 && "true" == $result['9_5_']) echo "checked";?> value="true" />Cincias</input><br>
							<input type="checkbox" name="9_6" <?php if($acao != 1 && "true" == $result['9_9_']) echo "checked";?> value="true" />Lngua/Literatura Portuguesa</input><br>
							<input type="checkbox" name="9_7" <?php if($acao != 1 && "true" == $result['9_7_']) echo "checked";?> value="true" />Lngua/Literatura estrangeira - Ingls</input><br>
							<input type="checkbox" name="9_8" <?php if($acao != 1 && "true" == $result['9_8_']) echo "checked";?> value="true" />Lngua/Literatura estrangeira - Espanhol</input><br>
							<input type="checkbox" name="9_9" <?php if($acao != 1 && "true" == $result['9_9_']) echo "checked";?> value="true" />Lngua/Literatura estrangeira - Outra</input><br>
							<input type="checkbox" name="9_10" <?php if($acao != 1 && "true" == $result['9_10_']) echo "checked";?> value="true" />Artes (Educao Artistica, Teatro, Msica, Artes Plsticas e outras)</input><br>
							<input type="checkbox" name="9_11" <?php if($acao != 1 && "true" == $result['9_11_']) echo "checked";?> value="true" />Educao Fsica</input><br>
							<input type="checkbox" name="9_12" <?php if($acao != 1 && "true" == $result['9_12_']) echo "checked";?> value="true" />Histria</input><br>
							<input type="checkbox" name="9_13" <?php if($acao != 1 && "true" == $result['9_13_']) echo "checked";?> value="true" />Geografia</input><br>
							<input type="checkbox" name="9_14" <?php if($acao != 1 && "true" == $result['9_14_']) echo "checked";?> value="true" />Filosofia</input><br>
							<input type="checkbox" name="9_15" <?php if($acao != 1 && "true" == $result['9_15_']) echo "checked";?> value="true" />Estudos Sociais/Sociologia</input><br>
							<input type="checkbox" name="9_16" <?php if($acao != 1 && "true" == $result['9_16_']) echo "checked";?> value="true" />Informtica/Computao</input><br>
							<input type="checkbox" name="9_17" <?php if($acao != 1 && "true" == $result['9_17_']) echo "checked";?> value="true" />Disciplinas profissionalizantes</input><br>
							<input type="checkbox" name="9_20" <?php if($acao != 1 && "true" == $result['9_20_']) echo "checked";?> value="true" />Disciplinas voltadas ao atendimento s necessidades educacionais especificas dos alunos que so pblico-alvo da educao especial e Pas prticas educacionais inclusivas</input><br>
							<input type="checkbox" name="9_21" <?php if($acao != 1 && "true" == $result['9_21_']) echo "checked";?> value="true" />Disciplinas voltadas  diversidade sociocultural (Disciplinas pedaggicas)</input><br>
							<input type="checkbox" name="9_23" <?php if($acao != 1 && "true" == $result['9_23_']) echo "checked";?> value="true" />Libras</input><br>
							<input type="checkbox" name="9_25" <?php if($acao != 1 && "true" == $result['9_25_']) echo "checked";?> value="true" />Disciplinas pedaggicas</input><br>
							<input type="checkbox" name="9_26" <?php if($acao != 1 && "true" == $result['9_26_']) echo "checked";?> value="true" />Ensino Religioso</input><br>
							<input type="checkbox" name="9_27" <?php if($acao != 1 && "true" == $result['9_27_']) echo "checked";?> value="true" />Lngua Indgena</input><br>
							<input type="checkbox" name="9_99" <?php if($acao != 1 && "true" == $result['9_99_']) echo "checked";?> value="true" />Outras disciplinas</input><br>
							<br><br>
							
							<img src="../img/linha_adicionais.png" WIDTH="100%"/><br><br>
							
							<a style="font-weight: bolder">10 - Curso:</a><br>
							<select name="cod_curso" class="campo" style="width: 250px;">
								<?php 
									$query_curso = mysql_query("SELECT cod_curso, curso.nome FROM curso WHERE curso.cod_instituicao = ".$_SESSION['id_instituicao']." ORDER BY curso.nome") or die ("Error na consulta");
									while ($res_curso = mysql_fetch_array($query_curso)){
								?>
								<option <?php if($acao != 1 && $res_curso[0] == $result[3]) echo "selected='selected'";?> value="<?php echo $res_curso[0];?>"><?php echo $res_curso[1];?></option>
								<?php 
									}
								?>
							</select><br><br>
							
							<a style="font-weight: bolder">11 - Semestre:</a><br>
							<select name="semestre" class="campo" style="width: 250px;">
								<option <?php if($acao != 1 && $result['semestre'] == "1") echo "selected='SELECTED'";?> value="1">1</option>
								<option <?php if($acao != 1 && $result['semestre'] == "2") echo "selected='SELECTED'";?> value="2">2</option>
								<option <?php if($acao != 1 && $result['semestre'] == "3") echo "selected='SELECTED'";?> value="3">3</option>
								<option <?php if($acao != 1 && $result['semestre'] == "4") echo "selected='SELECTED'";?> value="4">4</option>
								<option <?php if($acao != 1 && $result['semestre'] == "5") echo "selected='SELECTED'";?> value="5">5</option>
								<option <?php if($acao != 1 && $result['semestre'] == "6") echo "selected='SELECTED'";?> value="6">6</option>
								<option <?php if($acao != 1 && $result['semestre'] == "7") echo "selected='SELECTED'";?> value="7">7</option>
								<option <?php if($acao != 1 && $result['semestre'] == "8") echo "selected='SELECTED'";?> value="8">8</option>
								<option <?php if($acao != 1 && $result['semestre'] == "9") echo "selected='SELECTED'";?> value="9">9</option>
								<option <?php if($acao != 1 && $result['semestre'] == "10") echo "selected='SELECTED'";?> value="10">10</option>
								<option <?php if($acao != 1 && $result['semestre'] == "11") echo "selected='SELECTED'";?> value="11">11</option>
								<option <?php if($acao != 1 && $result['semestre'] == "12") echo "selected='SELECTED'";?> value="12">12</option>
							</select><br><br>
							
							<a style="font-weight: bolder">12 - Turno:</a><br>
							<select name="turno" class="campo" style="width: 250px;">
								<option <?php if($acao != 1 && $result['turno'] === "Matutino") echo "selected='SELECTED'";?> value="Matutino">Matutino</option>
								<option <?php if($acao != 1 && $result['turno'] === "Vespertino") echo "selected='SELECTED'";?> value="Vespertino">Vespertino</option>
								<option <?php if($acao != 1 && $result['turno'] === "Noturno") echo "selected='SELECTED'";?> value="Noturno">Noturno</option>
							</select><br><br>
							
							<a style="font-weight: bolder">13 - Ano:</a><br>
							<select name="ano" class="campo" style="width: 70px;">
								<option <?php if($acao != 1 && $result['ano'] === "") echo "selected='SELECTED'";?> value=""></option>
								<option <?php if($acao != 1 && $result['ano'] === "2011") echo "selected='SELECTED'";?> value="2011">2011</option>
								<option <?php if($acao != 1 && $result['ano'] === "2012") echo "selected='SELECTED'";?> value="2012">2012</option>
								<option <?php if($acao != 1 && $result['ano'] === "2013") echo "selected='SELECTED'";?> value="2013">2013</option>
							</select>
							
						</blockquote>
				</div>
				<div class="rodape_form"">
					<center>
						<a style="font-weight: bolder; font-size: 12; color: red;">
							<?php 
								if(isset($_GET['sucesso'])){
									if($_GET['sucesso'] == 0) echo "Cadastrado com sucesso!";
									elseif ($_GET['sucesso'] == 1) echo "Alterado com sucesso!";
									elseif ($_GET['sucesso'] == 2) echo "Excludo com sucesso!";
									elseif ($_GET['sucesso'] == 200) echo "Erro ao Cadastrar. Turma j cadastrada!";
									elseif ($_GET['sucesso'] == 202) echo "Erro ao Excluir. Existem disciplinas para essa turma!";
								}
							?>
						</a><br>
						<input name="submit" type="submit" value="<?php if($acao == 1) echo "Cadastrar"; else echo "Atualizar";?>" class="botao"/>
						<input type="button" onClick="javascript: location.href='/paginas/cadastro_turma.php?acao=1';" value="Cancelar" class="botao"/>
					</center>
				</div>
			</form>
			</div>			
		</div>
	</body>
</html>