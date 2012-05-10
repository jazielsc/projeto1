<?php 
	session_start();

	require_once("../boletim/scripts/conecta.php");
	
	/* CDIGO PARA ORDENAR A TABELA PELO CABEALHO CLICADO */
	if(!isset($_GET['ordem'])){
		$ordem = '2_';
	}
	else{
		switch($_GET['ordem']){
			case 0: $ordem = 'cod_professor'; break;
			case 1: $ordem = '2_'; break;
			case 2: $ordem = '3_'; break;
			case 3: $ordem = '13_'; break;
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
		$recupera = mysql_query("SELECT * FROM professor WHERE cod_instituicao = ".$_SESSION['id_instituicao']." AND cod_professor = ".$_GET['id']) or die ("Error na consulta");
		$result = mysql_fetch_array($recupera);
	}
?>
<html>
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
					<!--<img src="../img/Bandeira_cadastro_professores.png" />-->
					Cadastro de Professor
				</div>
				<div class="formulario">
					<form name="cad_professor" action="/boletim/scripts/objeto_professor.php" method="POST">
						<input type="hidden" name="cod_professor" value="<?php if($acao != 1) echo $result[0];?>" class="campo" style="width: 400px;"/>
						<blockquote>
							<input type="hidden" name="acao" value="<?php if($acao == 1) echo "insert_professor"; else echo "update_professor";?>" />
							
							<img src="../img/linha_identificacao.png" WIDTH="100%"/><br><br>
							
							<a style="font-weight: bolder">1 - Identificao nica (cdigo gerado pelo INEP):</a><br>
							<input name="1" value="<?php if($acao != 1) echo $result['1_'];?>" class="campo" style="width: 200px;"/><br>
							
							<a style="font-weight: bolder">2 - Nome Completo:</a><br>
							<input name="2" value="<?php if($acao != 1) echo $result['2_'];?>" class="campo" style="width: 600px;"/><br>
							
							<a style="font-weight: bolder">3 - Endereo eletrnico (e-mail):</a><br>
							<input name="3" value="<?php if($acao != 1) echo $result['3_'];?>" class="campo" style="width: 300px;"/><br>
							
							<a style="font-weight: bolder">4 - Nmero de Identificao Social (NIS):</a><br>
							<input name="4" value="<?php if($acao != 1) echo $result['4_'];?>" class="campo" style="width: 150px;"/><br>
							
							<a style="font-weight: bolder">5 - Data de nascimento:</a><br>
							<input name="5" OnKeyPress="formatar(this, '##/##/####')" value="<?php if($acao != 1) echo $result['5_'];?>" class="campo" style="width: 100px;"/> <a style="font-size: 9;">(dd/mm/aaaa)</a><br>
							
							<a style="font-weight: bolder">6 - Sexo:</a><br>
							<br>
							<input type="radio" name="6" <?php if($acao != 1 && "M" == $result['6_']) echo "checked";?> value="M" />Masculino</input><br>
							<input type="radio" name="6" <?php if($acao != 1 && "F" == $result['6_']) echo "checked";?> value="F" />Feminino</input>
							<br><br>
							
							<a style="font-weight: bolder">7 - Cor/Raa:</a><br>
							<br>
							<input type="radio" name="7" <?php if($acao != 1 && "1" == $result['7_']) echo "checked";?> value="1" />Branca</input><br>
							<input type="radio" name="7" <?php if($acao != 1 && "2" == $result['7_']) echo "checked";?> value="2" />Preta</input><br>
							<input type="radio" name="7" <?php if($acao != 1 && "3" == $result['7_']) echo "checked";?> value="3" />Parda</input><br>
							<input type="radio" name="7" <?php if($acao != 1 && "4" == $result['7_']) echo "checked";?> value="4" />Amarela</input><br>
							<input type="radio" name="7" <?php if($acao != 1 && "5" == $result['7_']) echo "checked";?> value="5" />Indgena</input><br>
							<input type="radio" name="7" <?php if($acao != 1 && "6" == $result['7_']) echo "checked";?> value="6" />No Declarada</input>
							<br><br>
							
							<a style="font-weight: bolder">8 - Nome completo da me:</a><br>
							<input name="1_identificacao_unica" value="<?php if($acao != 1) echo $result['8_'];?>" class="campo" style="width: 600px;"/><br>
							
							<a style="font-weight: bolder">9 - Nacionalidade:</a><br>
							<br>
							<input type="radio" name="9" <?php if($acao != 1 && "1" == $result['9_']) echo "checked";?> value="1" />Brasileira</input><br>
							<input type="radio" name="9" <?php if($acao != 1 && "2" == $result['9_']) echo "checked";?> value="2" />Brasileira - nascido no exterior ou naturalizado</input><br>
							<input type="radio" name="9" <?php if($acao != 1 && "3" == $result['9_']) echo "checked";?> value="3" />Estrangeiro</input>
							<br><br>
							
							<a style="font-weight: bolder">10 - Pas de origem:</a><br>
							<input name="10" value="<?php if($acao != 1) echo $result['10_'];?>" class="campo" style="width: 45px;"/><br>
							
							<a style="font-weight: bolder">11 - UF de nascimento:</a><br>
							<input name="11" value="<?php if($acao != 1) echo $result['11_'];?>" class="campo" style="width: 45px;"/>
							<br>
							
							<a style="font-weight: bolder">12 - Municpio de nascimento:</a><br>
							<input name="12" value="<?php if($acao != 1) echo $result['12_'];?>" class="campo" style="width: 300px;"/><br>
							
							<a style="font-weight: bolder">13 - Nmero do CPF:</a><br>
							<input name="13" OnKeyPress="formatar(this, '###.###.###-##')" value="<?php if($acao != 1) echo $result['13_'];?>" class="campo" style="width: 150px;"/><br><br>
							
							<img src="../img/linha_endereco.png" WIDTH="100%"/><br><br>
							
							<a style="font-weight: bolder">14 - CEP:</a><br>
							<input name="14" value="<?php if($acao != 1) echo $result['14_'];?>" class="campo" style="width: 100px;"/><br>
							
							<a style="font-weight: bolder">15 - Endereo:</a><br>
							<input name="15" value="<?php if($acao != 1) echo $result['15_'];?>" class="campo" style="width: 400px;"/><br>
							
							<a style="font-weight: bolder">16 - Nmero:</a><br>
							<input name="16" value="<?php if($acao != 1) echo $result['16_'];?>" class="campo" style="width: 80px;"/><br>
							
							<a style="font-weight: bolder">17 - Complemento:</a><br>
							<input name="17" value="<?php if($acao != 1) echo $result['17_'];?>" class="campo" style="width: 150px;"/><br>
							
							<a style="font-weight: bolder">18 - Bairro:</a><br>
							<input name="18" value="<?php if($acao != 1) echo $result['18_'];?>" class="campo" style="width: 200px;"/><br>
							
							<a style="font-weight: bolder">19 UF:</a><br>
							<input name="19" value="<?php if($acao != 1) echo $result['19_'];?>" class="campo" style="width: 30px;"/><br>
							
							<a style="font-weight: bolder">20 - Municpio:</a><br>
							<input name="20" value="<?php if($acao != 1) echo $result['20_'];?>" class="campo" style="width: 300px;"/><br><br>
							
							<img src="../img/linha_dadosvar.png" WIDTH="100%"/><br><br>
							
							<a style="font-weight: bolder">21 - Escolaridade:</a><br>
							<br>
							<input type="radio" name="21_1" <?php if($acao != 1 && "1" == $result['21_1_']) echo "checked";?> value="1" />Fundamental incompleto</input><br>
							<input type="radio" name="21_1" <?php if($acao != 1 && "2" == $result['21_1_']) echo "checked";?> value="2" />Fundamental completo</input><br>
							<input type="radio" name="21_1" <?php if($acao != 1 && "3" == $result['21_1_']) echo "checked";?> value="3" />Ensino Mdio - Normal/Magistrio</input><br>
							<input type="radio" name="21_1" <?php if($acao != 1 && "4" == $result['21_1_']) echo "checked";?> value="4" />Ensino Mdio - Normal/Magistrio Especifico Indgena</input><br>
							<input type="radio" name="21_1" <?php if($acao != 1 && "5" == $result['21_1_']) echo "checked";?> value="5" />Ensino Mdio</input><br>
							<input type="radio" name="21_1" <?php if($acao != 1 && "6" == $result['21_1_']) echo "checked";?> value="6" />Superior</input>
							<br><br>
							Situao do curso superior: <br>
							<input type="radio" name="21_2" <?php if($acao != 1 && "1" == $result['21_2_']) echo "checked";?> value="1" />Concludo</input><br>
							<input type="radio" name="21_2" <?php if($acao != 1 && "2" == $result['21_2_']) echo "checked";?> value="2" />Em andamento</input><br><br>
							rea do curso:<br>
							<input name="21_3" value="<?php if($acao != 1) echo $result['21_3_'];?>" class="campo" style="width: 60px;"/><br>							
							Cdigo do curso:<br>
							<input name="21_4" value="<?php if($acao != 1) echo $result['21_4_'];?>" class="campo" style="width: 60px;"/><br>
							Ano de Incio:<br>
							<input name="21_5" value="<?php if($acao != 1) echo $result['21_5_'];?>" class="campo" style="width: 60px;"/><br>
							Ano de concluso:<br>
							<input name="21_6" value="<?php if($acao != 1) echo $result['21_6_'];?>" class="campo" style="width: 60px;"/><br><br>
							Formao/complementao pedaggica: <br>
							<input type="radio" name="21_7" <?php if($acao != 1 && "1" == $result['21_7_']) echo "checked";?> value="1" />Concludo</input><br>
							<input type="radio" name="21_7" <?php if($acao != 1 && "2" == $result['21_7_']) echo "checked";?> value="2" />Em andamento</input><br><br>
							Tipo de instituio: <br>
							<input type="radio" name="21_8" <?php if($acao != 1 && "1" == $result['21_8_']) echo "checked";?> value="1" />Pblica</input><br>
							<input type="radio" name="21_8" <?php if($acao != 1 && "2" == $result['21_8_']) echo "checked";?> value="2" />Privada</input><br>
							<br>
							<hr>
							Situao do curso superior: <br>
							<input type="radio" name="21_9" <?php if($acao != 1 && "1" == $result['21_9_']) echo "checked";?> value="1" />Concludo</input><br>
							<input type="radio" name="21_9" <?php if($acao != 1 && "2" == $result['21_9_']) echo "checked";?> value="2" />Em andamento</input><br><br>
							rea do curso:<br>
							<input name="21_10" value="<?php if($acao != 1) echo $result['21_10_'];?>" class="campo" style="width: 60px;"/><br>							
							Cdigo do curso:<br>
							<input name="21_11" value="<?php if($acao != 1) echo $result['21_11_'];?>" class="campo" style="width: 60px;"/><br>
							Ano de Incio:<br>
							<input name="21_12" value="<?php if($acao != 1) echo $result['21_12_'];?>" class="campo" style="width: 60px;"/><br>
							Ano de concluso:<br>
							<input name="21_13" value="<?php if($acao != 1) echo $result['21_13_'];?>" class="campo" style="width: 60px;"/><br><br>
							Formao/complementao pedaggica: <br>
							<input type="radio" name="21_14" <?php if($acao != 1 && "1" == $result['21_14_']) echo "checked";?> value="1" />Concludo</input><br>
							<input type="radio" name="21_14" <?php if($acao != 1 && "2" == $result['21_14_']) echo "checked";?> value="2" />Em andamento</input><br><br>
							Tipo de instituio: <br>
							<input type="radio" name="21_15" <?php if($acao != 1 && "1" == $result['21_15_']) echo "checked";?> value="1" />Pblica</input><br>
							<input type="radio" name="21_15" <?php if($acao != 1 && "2" == $result['21_15_']) echo "checked";?> value="2" />Privada</input><br>
							<br>
							<hr>
							Situao do curso superior: <br>
							<input type="radio" name="21_16" <?php if($acao != 1 && "1" == $result['21_16_']) echo "checked";?> value="1" />Concludo</input><br>
							<input type="radio" name="21_16" <?php if($acao != 1 && "2" == $result['21_16_']) echo "checked";?> value="2" />Em andamento</input><br><br>
							rea do curso:<br>
							<input name="21_17" value="<?php if($acao != 1) echo $result['21_17_'];?>" class="campo" style="width: 60px;"/><br>							
							Cdigo do curso:<br>
							<input name="21_18" value="<?php if($acao != 1) echo $result['21_18_'];?>" class="campo" style="width: 60px;"/><br>
							Ano de Incio:<br>
							<input name="21_19" value="<?php if($acao != 1) echo $result['21_19_'];?>" class="campo" style="width: 60px;"/><br>
							Ano de concluso:<br>
							<input name="21_20" value="<?php if($acao != 1) echo $result['21_20_'];?>" class="campo" style="width: 60px;"/><br><br>
							Formao/complementao pedaggica: <br>
							<input type="radio" name="21_21" <?php if($acao != 1 && "1" == $result['21_21_']) echo "checked";?> value="1" />Concludo</input><br>
							<input type="radio" name="21_21" <?php if($acao != 1 && "2" == $result['21_21_']) echo "checked";?> value="2" />Em andamento</input><br><br>
							Tipo de instituio: <br>
							<input type="radio" name="21_22" <?php if($acao != 1 && "1" == $result['21_22_']) echo "checked";?> value="1" />Pblica</input><br>
							<input type="radio" name="21_22" <?php if($acao != 1 && "2" == $result['21_22_']) echo "checked";?> value="2" />Privada</input><br><br>							
							
							<a style="font-weight: bolder">22 - Ps-graduao:</a><br>
							<br>
							<input type="radio" name="22" <?php if($acao != 1 && "1" == $result['22_']) echo "checked";?> value="1" />Especializao</input><br>
							<input type="radio" name="22" <?php if($acao != 1 && "2" == $result['22_']) echo "checked";?> value="2" />Mestrado</input><br>
							<input type="radio" name="22" <?php if($acao != 1 && "3" == $result['22_']) echo "checked";?> value="3" />Doutorado</input><br>
							<input type="radio" name="22" <?php if($acao != 1 && "4" == $result['22_']) echo "checked";?> value="4" />Nenhum</input>
							<br><br>
							
							<a style="font-weight: bolder">23 - Outros cursos (formao continuada com, no mnimo, 40 horas):</a><br>
							<input type="checkbox" name="23_1" <?php if($acao != 1 && "true" == $result['23_1_']) echo "checked";?> value="true" />Especfico para creche</input><br>
							<input type="checkbox" name="23_2" <?php if($acao != 1 && "true" == $result['23_2_']) echo "checked";?> value="true" />Especfico para anos finais do ensino fundamental</input><br>
							<input type="checkbox" name="23_3" <?php if($acao != 1 && "true" == $result['23_3_']) echo "checked";?> value="true" />Especfico para educao especial</input><br>
							<input type="checkbox" name="23_4" <?php if($acao != 1 && "true" == $result['23_4_']) echo "checked";?> value="true" />Outros</input><br>
							<input type="checkbox" name="23_5" <?php if($acao != 1 && "true" == $result['23_5_']) echo "checked";?> value="true" />Especfico para pr-escola</input><br>
							<input type="checkbox" name="23_6" <?php if($acao != 1 && "true" == $result['23_6_']) echo "checked";?> value="true" />Especfico para ensino mdio</input><br>
							<input type="checkbox" name="23_7" <?php if($acao != 1 && "true" == $result['23_7_']) echo "checked";?> value="true" />Especfico para educao indigena</input><br>
							<input type="checkbox" name="23_8" <?php if($acao != 1 && "true" == $result['23_8_']) echo "checked";?> value="true" />Nenhum</input><br>
							<input type="checkbox" name="23_9" <?php if($acao != 1 && "true" == $result['23_9_']) echo "checked";?> value="true" />Especfico para anos iniciais do ensino fundamental</input><br>
							<input type="checkbox" name="23_10" <?php if($acao != 1 && "true" == $result['23_10_']) echo "checked";?> value="true" />Especfico para educao de jovens e adultos</input><br>
							<input type="checkbox" name="23_11" <?php if($acao != 1 && "true" == $result['23_11_']) echo "checked";?> value="true" />Intercultural/Diversidade</input><br>
							<br><br>
							
							<img src="../img/linha_dados_docencia.png" WIDTH="100%"/><br><br>
							
							<a style="font-weight: bolder">24 - Funo que exerce na escola:</a><br>
							<br>
							<input type="radio" name="24" <?php if($acao != 1 && "1" == $result['24_']) echo "checked";?> value="1" />Docente</input><br>
							<input type="radio" name="24" <?php if($acao != 1 && "2" == $result['24_']) echo "checked";?> value="2" />Auxiliar de Educao Infantil</input><br>
							<input type="radio" name="24" <?php if($acao != 1 && "3" == $result['24_']) echo "checked";?> value="3" />Profissional/Monitor de Atividade Complementar</input><br>
							<input type="radio" name="24" <?php if($acao != 1 && "4" == $result['24_']) echo "checked";?> value="4" />Tradutor Intrprete de Libras</input>
							<br><br>
							
							<a style="font-weight: bolder">25 - Situao Funcional/Regime de contratao (Apenas para docente de escola pblica):</a><br>
							<br>
							<input type="radio" name="25" <?php if($acao != 1 && "1" == $result['25_']) echo "checked";?> value="1" />Concursado efetivo</input><br>
							<input type="radio" name="25" <?php if($acao != 1 && "2" == $result['25_']) echo "checked";?> value="2" />Contrato temporrio</input><br>
							<input type="radio" name="25" <?php if($acao != 1 && "3" == $result['25_']) echo "checked";?> value="3" />Contrato terceirizado</input>
							<br><br>
							
							<a style="font-weight: bolder">26 - Turma(s) em que atua:</a><br><br>
							Nome da turma 1<br>
							<input name="26_1" value="<?php if($acao != 1) echo $result['26_1_'];?>" class="campo" style="width: 400px;"/><br>
							Nome da turma 2<br>
							<input name="26_2" value="<?php if($acao != 1) echo $result['26_2_'];?>" class="campo" style="width: 400px;"/><br>
							Nome da turma 3<br>
							<input name="26_3" value="<?php if($acao != 1) echo $result['26_3_'];?>" class="campo" style="width: 400px;"/><br>
							Nome da turma 4<br>
							<input name="26_4" value="<?php if($acao != 1) echo $result['26_4_'];?>" class="campo" style="width: 400px;"/><br>
							Nome da turma 5<br>
							<input name="26_5" value="<?php if($acao != 1) echo $result['26_5_'];?>" class="campo" style="width: 400px;"/><br>
							Nome da turma 6<br>
							<input name="26_6" value="<?php if($acao != 1) echo $result['26_6_'];?>" class="campo" style="width: 400px;"/><br>
							
							<br><a style="font-weight: bolder">27 - Cdigo da(s) disciplina(s) que leciona:</a><br><br>
							Turma 1<br>
							<input name="27_1_1" value="<?php if($acao != 1) echo $result['27_1_1_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_1_2" value="<?php if($acao != 1) echo $result['27_1_2_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_1_3" value="<?php if($acao != 1) echo $result['27_1_3_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_1_4" value="<?php if($acao != 1) echo $result['27_1_4_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_1_5" value="<?php if($acao != 1) echo $result['27_1_5_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_1_6" value="<?php if($acao != 1) echo $result['27_1_6_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_1_7" value="<?php if($acao != 1) echo $result['27_1_7_'];?>" class="campo" style="width: 30px;"/><br>
							Turma 2<br>
							<input name="27_2_1" value="<?php if($acao != 1) echo $result['27_2_1_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_2_2" value="<?php if($acao != 1) echo $result['27_2_2_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_2_3" value="<?php if($acao != 1) echo $result['27_2_3_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_2_4" value="<?php if($acao != 1) echo $result['27_2_4_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_2_5" value="<?php if($acao != 1) echo $result['27_2_5_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_2_6" value="<?php if($acao != 1) echo $result['27_2_6_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_2_7" value="<?php if($acao != 1) echo $result['27_2_7_'];?>" class="campo" style="width: 30px;"/><br>
							Turma 3<br>
							<input name="27_3_1" value="<?php if($acao != 1) echo $result['27_3_1_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_3_2" value="<?php if($acao != 1) echo $result['27_3_2_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_3_3" value="<?php if($acao != 1) echo $result['27_3_3_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_3_4" value="<?php if($acao != 1) echo $result['27_3_4_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_3_5" value="<?php if($acao != 1) echo $result['27_3_5_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_3_6" value="<?php if($acao != 1) echo $result['27_3_6_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_3_7" value="<?php if($acao != 1) echo $result['27_3_7_'];?>" class="campo" style="width: 30px;"/><br>
							Turma 4<br>
							<input name="27_4_1" value="<?php if($acao != 1) echo $result['27_4_1_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_4_2" value="<?php if($acao != 1) echo $result['27_4_2_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_4_3" value="<?php if($acao != 1) echo $result['27_4_3_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_4_4" value="<?php if($acao != 1) echo $result['27_4_4_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_4_5" value="<?php if($acao != 1) echo $result['27_4_5_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_4_6" value="<?php if($acao != 1) echo $result['27_4_6_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_4_7" value="<?php if($acao != 1) echo $result['27_4_7_'];?>" class="campo" style="width: 30px;"/><br>
							Turma 5<br>
							<input name="27_5_1" value="<?php if($acao != 1) echo $result['27_5_1_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_5_2" value="<?php if($acao != 1) echo $result['27_5_2_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_5_3" value="<?php if($acao != 1) echo $result['27_5_3_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_5_4" value="<?php if($acao != 1) echo $result['27_5_4_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_5_5" value="<?php if($acao != 1) echo $result['27_5_5_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_5_6" value="<?php if($acao != 1) echo $result['27_5_6_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_5_7" value="<?php if($acao != 1) echo $result['27_5_7_'];?>" class="campo" style="width: 30px;"/><br>
							Turma 6<br>
							<input name="27_6_1" value="<?php if($acao != 1) echo $result['27_6_1_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_6_2" value="<?php if($acao != 1) echo $result['27_6_2_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_6_3" value="<?php if($acao != 1) echo $result['27_6_3_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_6_4" value="<?php if($acao != 1) echo $result['27_6_4_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_6_5" value="<?php if($acao != 1) echo $result['27_6_5_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_6_6" value="<?php if($acao != 1) echo $result['27_6_6_'];?>" class="campo" style="width: 30px;"/>
							<input name="27_6_7" value="<?php if($acao != 1) echo $result['27_6_7_'];?>" class="campo" style="width: 30px;"/>
							<br><br>
							
							<img src="../img/linha_adicionais.png" WIDTH="100%"/><br><br>
							
							<a style="font-weight: bolder">27 - Status:</a><br>
							<select name="cod_status" class="campo" style="width: 200px;">
								<?php 
									$query_status = mysql_query("SELECT cod_status, nome FROM status3 ORDER BY cod_status") or die ("Error na consulta");
									while ($res_status = mysql_fetch_array($query_status)){
								?>
								<option <?php if($acao != 1 && $res_status[0] == $result['cod_status']) echo "selected='selected'";?> value="<?php echo $res_status[0];?>"><?php echo $res_status[1];?></option>
								<?php 
									}
								?>
							</select>
							<br><br>
							
				</div>
				<div class="rodape_form">
					<center>
						<a style="font-weight: bolder; font-size: 12; color: red;">
							<?php 
								if(isset($_GET['sucesso'])){
									if($_GET['sucesso'] == 0) echo "Cadastrado com sucesso!";
									elseif ($_GET['sucesso'] == 1) echo "Alterado com sucesso!";
									elseif ($_GET['sucesso'] == 110) echo "Professor ou Email j cadastrado!";
								}
							?>
						</a><br>
						<input name="submit" type="submit" value="<?php if($acao == 1) echo "Cadastrar"; else echo "Atualizar";?>" class="botao"/>
						<input type="button" onClick="javascript: location.href='/paginas/cadastro_professor.php?acao=1';" value="Cancelar" class="botao"/>
					</center>
				</div>
				</form>
			</div>			
		</div>
	</body>
</html>