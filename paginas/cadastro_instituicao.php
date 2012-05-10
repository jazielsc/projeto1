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

	require_once("../boletim/scripts/conecta.php");
		
	$recupera = mysql_query("SELECT * FROM instituicao WHERE cod_instituicao = ".$_SESSION['id_instituicao']) or die ("Error na consulta");
	$result = mysql_fetch_array($recupera);
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
					<!--<img src="../img/Bandeira_cadastro_instituicao.png" />-->
					Cadastro de Instituio
				</div>
				<div class="formulario">
					<form name="cad_instituicao" action="/boletim/scripts/objeto_escola.php" method="POST">
							<blockquote>
								<img src="../img/linha_identificacao.png" WIDTH="100%"/><br><br>
								<a style="font-weight: bolder">1 - Identificao do Funcionamento:</a><br><br>
								<input type="radio" name="1" <?php if($result['1_'] == "1") echo "checked";?> value="1" />Em atividade</input><br>
								<input type="radio" name="1" <?php if($result['1_'] == "2") echo "checked";?> value="2" />Paralisada</input><br>
								<input type="radio" name="1" <?php if($result['1_'] == "3") echo "checked";?> value="3" />Extinta</input>
								<br><br>
								
								<a style="font-weight: bolder">2 - Ano letivo:</a><br>
								Incio<br>
								<input name="2a" OnKeyPress="formatar(this, '##/##/####')" value="<?php echo converte_data_tela($result['2a_']);?>" class="campo" style="width: 120px;"/> <a style="font-size: 9;">(dd/mm/aaaa)</a><br>
								Trmino (previso)<br>
								<input name="2b" OnKeyPress="formatar(this, '##/##/####')" value="<?php echo converte_data_tela($result['2b_']);?>" class="campo" style="width: 120px;"/> <a style="font-size: 9;">(dd/mm/aaaa)</a><br>
								
								<a style="font-weight: bolder">3 - Nome da escola:</a><br>
								<input name="3" value="<?php echo $result['3_'];?>" class="campo" style="width: 450px;"/><br>
								
								<a style="font-weight: bolder">4 - CEP:</a><br>
								<input name="4" OnKeyPress="formatar(this, '#####-###')" value="<?php echo $result['4_'];?>" class="campo" style="width: 100px;"/><br>
								
								<a style="font-weight: bolder">5 - Endereo:</a><br>
								<input name="5" value="<?php echo $result['5_'];?>" class="campo" style="width: 400px;"/><br>
								
								<a style="font-weight: bolder">6 - Nmero:</a><br>
								<input name="6"  value="<?php echo $result['6_'];?>" class="campo" style="width: 150px;"/><br>
								
								<a style="font-weight: bolder">7 - Complemento:</a><br>
								<input name="7"  value="<?php echo $result['7_'];?>" class="campo" style="width: 200px;"/><br>
								
								<a style="font-weight: bolder">8 - Bairro:</a><br>
								<input name="8"  value="<?php echo $result['8_'];?>" class="campo" style="width: 150px;"/><br>
								
								<a style="font-weight: bolder">9 - UF:</a><br>
								<input name="9"  value="<?php echo $result['9_'];?>" class="campo" style="width: 30px;"/><br>
								
								<a style="font-weight: bolder">10 - Municpio:</a><br>
								<input name="10"  value="<?php echo $result['10_'];?>" class="campo" style="width: 200px;"/><br>
								
								<a style="font-weight: bolder">11 - Distrito:</a><br>
								<input name="11"  value="<?php echo $result['11_'];?>" class="campo" style="width: 150px;"/><br>
								
								<a style="font-weight: bolder">12 - DDD:</a><br>
								<input name="12"  value="<?php echo $result['12_'];?>" class="campo" style="width: 30px;"/><br>
								
								<a style="font-weight: bolder">13 - Telefone:</a><br>
								<input name="13"  value="<?php echo $result['13_'];?>" class="campo" style="width: 80px;"/><br>
								
								<a style="font-weight: bolder">14 - Telefone pblico 1:</a><br>
								<input name="14"  value="<?php echo $result['14_'];?>" class="campo" style="width: 80px;"/><br>
								
								<a style="font-weight: bolder">15 - Telefone pblico 2:</a><br>
								<input name="15"  value="<?php echo $result['15_'];?>" class="campo" style="width: 80px;"/><br>
								
								<a style="font-weight: bolder">16 - FAX:</a><br>
								<input name="16"  value="<?php echo $result['16_'];?>" class="campo" style="width: 80px;"/><br>
								
								<a style="font-weight: bolder">17 - Endereo eletrnico (e-mail):</a><br>
								<input name="17"  value="<?php echo $result['17_'];?>" class="campo" style="width: 200px;"/><br>
								
								<a style="font-weight: bolder">18 - Cdigo do rgo regional de ensino:</a><br>
								<input name="18"  value="<?php echo $result['18_'];?>" class="campo" style="width: 80px;"/><br>
								
								<a style="font-weight: bolder">18a - Nome do rgo regional de ensino:</a><br>
								<input name="18a"  value="<?php echo $result['18a_'];?>" class="campo" style="width: 300px;"/><br>
								
								<a style="font-weight: bolder">19 - Dependncia administrativa:</a><br><br>
								<input type="radio" name="19" checked <?php if($result['19_'] == "1") echo "checked";?> value="1" />Federal</input><br>
								<input type="radio" name="19" <?php if($result['19_'] == "2") echo "checked";?> value="2" />Estadual</input><br>
								<input type="radio" name="19" <?php if($result['19_'] == "3") echo "checked";?> value="3" />Municipal</input><br>
								<input type="radio" name="19" <?php if($result['19_'] == "4") echo "checked";?> value="4" />Privada</input>
								<br><br>
								
								<a style="font-weight: bolder">20 - Localizao/Zona da escola:</a><br><br>
								<input type="radio" name="20" <?php if($result['20_'] == "1") echo "checked";?> value="1" />Urbana</input><br>
								<input type="radio" name="20" <?php if($result['20_'] == "2") echo "checked";?> value="2" />Rural</input><br>
								<br>
								
								<a style="font-weight: bolder">21 - Categoria da escola privada:</a><br><br>
								<input type="radio" name="21" <?php if($result['21_'] == "1") echo "checked";?> value="1" />Particular</input><br>
								<input type="radio" name="21" <?php if($result['21_'] == "2") echo "checked";?> value="2" />Comunitria</input><br>
								<input type="radio" name="21" <?php if($result['21_'] == "3") echo "checked";?> value="3" />Confessional</input><br>
								<input type="radio" name="21" <?php if($result['21_'] == "4") echo "checked";?> value="4" />Filantrpica</input>
								<br><br>
								
								<a style="font-weight: bolder">21a - Conveniada com o poder pblico:</a><br><br>
								<input type="radio" name="21a" <?php if($result['21a_'] == "1") echo "checked";?> value="1" />Estadual</input><br>
								<input type="radio" name="21a" <?php if($result['21a_'] == "2") echo "checked";?> value="2" />Municipal</input><br>
								<input type="radio" name="21a" <?php if($result['21a_'] == "3") echo "checked";?> value="3" />Estadual e Municipal</input>
								<br><br>

								<a style="font-weight: bolder">21b - Nmero do registro no CNAS:</a><br>
								<input name="21b"  value="<?php echo $result['21b_'];?>" class="campo" style="width: 250px;"/><br>
								
								<a style="font-weight: bolder">21c - Nmero do Certificado de Entidade Beneficente de Assistncia Social (Cebas):</a><br>
								<input name="21c"  value="<?php echo $result['21c_'];?>" class="campo" style="width: 250px;"/><br>
								
								<a style="font-weight: bolder">22 - Mantenedora da escola privada (assinalar mais de uma opo, se for o caso):</a><br><br>
								<input type="checkbox" name="22_1" <?php if($result['22_1_'] == "true") echo "checked";?> value="true" />Empresa, grupo empresarial do setor privado ou pessoa fsica</input><br>
								<input type="checkbox" name="22_2" <?php if($result['22_2_'] == "true") echo "checked";?> value="true" />Organizao no-governamental - ONG internacional ou nacional</input><br>
								<input type="checkbox" name="22_3" <?php if($result['22_3_'] == "true") echo "checked";?> value="true" />Sindicatos de trabalhadores ou patronais, associaes, cooperativas, sistema S</input><br>
								<input type="checkbox" name="22_4" <?php if($result['22_4_'] == "true") echo "checked";?> value="true" />Instituies sem fins lucrativos</input>
								<br><br>
								
								<a style="font-weight: bolder">23 - CNPJ da mantenedora principal da escola privada:</a><br>
								<input name="23" value="<?php echo $result['23_'];?>" class="campo" style="width: 250px;"/><br>
								
								<a style="font-weight: bolder">24 - Nmero do CNPJ da escola privada:</a><br>
								<input name="24"  value="<?php echo $result['24_'];?>" class="campo" style="width: 250px;"/><br>
								
								<a style="font-weight: bolder">25 - Regulamentao/Credenciamento no conselho ou rgo municipal, estadual ou federal de educao:</a><br><br>
								<input type="radio" name="25" <?php if($result['25_'] == "1") echo "checked";?> value="1" />Em atividade</input><br>
								<input type="radio" name="25" <?php if($result['25_'] == "2") echo "checked";?> value="2" />Paralisada</input><br>
								<input type="radio" name="25" <?php if($result['25_'] == "3") echo "checked";?> value="3" />Extinta</input>
								<br><br>
								
								<img src="../img/linha_autenticacao.png" WIDTH="100%"/><br><br>
								
								<a style="font-weight: bolder">26 - Nmero do CPF:</a><br>
								<input name="26"  value="<?php echo $result['26_'];?>" class="campo" style="width: 200px;"/><br>
								
								<a style="font-weight: bolder">27 - Nome do Diretor/Responsvel:</a><br>
								<input name="27"  value="<?php echo $result['27_'];?>" class="campo" style="width: 400px;"/><br>
								
								<a style="font-weight: bolder">28 - Cargo:</a><br>
								<input name="28"  value="<?php echo $result['28_'];?>" class="campo" style="width: 250px;"/><br>
								
								<a style="font-weight: bolder">29 - Endereo eletrnico (e-mail):</a><br>
								<input name="29"  value="<?php echo $result['29_'];?>" class="campo" style="width: 200px;"/><br><br>
								
								<img src="../img/linha_caracterizacao.png" WIDTH="100%"/><br><br>
								
								<a style="font-weight: bolder">30 - Local de funcionamento da escola (assinalar mais de uma opo, se for o caso):</a><br><br>
								<input type="checkbox" name="30_1" <?php if($result['30_1_'] == "true") echo "checked";?> value="true" />Prdio escolar</input><br>
								<input type="checkbox" name="30_2" <?php if($result['30_1_'] == "true") echo "checked";?> value="true" />Templo/Igreja</input><br>
								<input type="checkbox" name="30_3" <?php if($result['30_1_'] == "true") echo "checked";?> value="true" />Salas de empresa</input><br>
								<input type="checkbox" name="30_4" <?php if($result['30_1_'] == "true") echo "checked";?> value="true" />Casa do professor</input><br>
								<input type="checkbox" name="30_5" <?php if($result['30_1_'] == "true") echo "checked";?> value="true" />Salas em outra escola</input><br>
								<input type="checkbox" name="30_6" <?php if($result['30_1_'] == "true") echo "checked";?> value="true" />Galpo/Rancho/Paiol/Barraco</input><br>
								<input type="checkbox" name="30_7" <?php if($result['30_1_'] == "true") echo "checked";?> value="true" />Unidade de internao/prisional</input><br>
								<input type="checkbox" name="30_8" <?php if($result['30_1_'] == "true") echo "checked";?> value="true" />Outros</input>
								<br><br>
								
								<a style="font-weight: bolder">30a - Forma de ocupao do prdio:</a><br><br>
								<input type="radio" name="30a" <?php if($result['30a_'] == "1") echo "checked";?> value="1" />Prprio</input><br>
								<input type="radio" name="30a" <?php if($result['30a_'] == "2") echo "checked";?> value="2" />Alugado</input><br>
								<input type="radio" name="30a" <?php if($result['30a_'] == "3") echo "checked";?> value="3" />Cedido</input>
								<br><br>
								
								<a style="font-weight: bolder">31 - Prdio compartilhado com outra escola:</a><br><br>
								<input type="radio" name="31" <?php if($result['31_'] == "1") echo "checked";?> value="1" />Sim</input><br>
								<input type="radio" name="31" <?php if($result['31_'] == "2") echo "checked";?> value="2" />No</input>
								<br><br>
								
								<a style="font-weight: bolder">31a - Cdigo da escola com qual compartilha:</a><br>
								<input name="31a_1"  value="<?php echo $result['31a_1_'];?>" class="campo" style="width: 100px;"/><br>
								<input name="31a_2"  value="<?php echo $result['31a_2_'];?>" class="campo" style="width: 100px;"/><br>
								<input name="31a_3"  value="<?php echo $result['31a_3_'];?>" class="campo" style="width: 100px;"/><br>
								<input name="31a_4"  value="<?php echo $result['31a_4_'];?>" class="campo" style="width: 100px;"/><br>
								<input name="31a_5"  value="<?php echo $result['31a_5_'];?>" class="campo" style="width: 100px;"/><br>
								<input name="31a_6"  value="<?php echo $result['31a_6_'];?>" class="campo" style="width: 100px;"/><br>
								
								<a style="font-weight: bolder">32 - guua consumida pelos alunos:</a><br><br>
								<input type="radio" name="32" <?php if($result['32_'] == "1") echo "checked";?> value="1" />Filtrada</input><br>
								<input type="radio" name="32" <?php if($result['32_'] == "2") echo "checked";?> value="2" />No filtrada</input>
								<br><br>
								
								<a style="font-weight: bolder">33 - Abastecimento de gua:</a><br><br>
								<input type="radio" name="33" <?php if($result['33_'] == "1") echo "checked";?> value="1" />Rede pblica</input><br>
								<input type="radio" name="33" <?php if($result['33_'] == "2") echo "checked";?> value="2" />Poo artesiano</input><br>
								<input type="radio" name="33" <?php if($result['33_'] == "3") echo "checked";?> value="3" />Cacimba/Cisterna/Poo</input><br>
								<input type="radio" name="33" <?php if($result['33_'] == "4") echo "checked";?> value="4" />Fonte/Rio/Igarap/Riacho/Crrego</input><br>
								<input type="radio" name="33" <?php if($result['33_'] == "5") echo "checked";?> value="5" />Inexistente</input>
								<br><br>
								
								<a style="font-weight: bolder">34 - Abastecimento de energia eltrica:</a><br><br>
								<input type="radio" name="34" <?php if($result['34_'] == "1") echo "checked";?> value="1" />Rede pblica</input><br>
								<input type="radio" name="34" <?php if($result['34_'] == "2") echo "checked";?> value="2" />Gerador</input><br>
								<input type="radio" name="34" <?php if($result['34_'] == "3") echo "checked";?> value="3" />Outros (energia alternativa)</input><br>
								<input type="radio" name="34" <?php if($result['34_'] == "4") echo "checked";?> value="4" />Inexistente</input>
								<br><br>
								
								<a style="font-weight: bolder">35 - Esgoto sanitrio:</a><br><br>
								<input type="radio" name="35" <?php if($result['35_'] == "1") echo "checked";?> value="1" />Rede pblica</input><br>
								<input type="radio" name="35" <?php if($result['35_'] == "2") echo "checked";?> value="2" />Fossa</input><br>
								<input type="radio" name="35" <?php if($result['35_'] == "2") echo "checked";?> value="3" />Inexistente</input>
								<br><br>
								
								<a style="font-weight: bolder">36 - Destinao do lixo:</a><br><br>
								<input type="radio" name="36" <?php if($result['36_'] == "1") echo "checked";?> value="1" />Coleta peridica</input><br>
								<input type="radio" name="36" <?php if($result['36_'] == "2") echo "checked";?> value="2" />Queima</input><br>
								<input type="radio" name="36" <?php if($result['36_'] == "3") echo "checked";?> value="3" />Joga em outra rea</input><br>
								<input type="radio" name="36" <?php if($result['36_'] == "4") echo "checked";?> value="4" />Recicla</input><br>
								<input type="radio" name="36" <?php if($result['36_'] == "5") echo "checked";?> value="5" />Enterra</input><br>
								<input type="radio" name="36" <?php if($result['36_'] == "6") echo "checked";?> value="6" />Outros</input><br>
								<br><br>
								
								<a style="font-weight: bolder">37 - Dependncias existentes na escola:</a><br><br>
								<input type="checkbox" name="37_1" <?php if($result['37_1_'] == "true") echo "checked";?> value="true" />Diretoria</input><br>
								<input type="checkbox" name="37_2" <?php if($result['37_2_'] == "true") echo "checked";?> value="true" />Sala de professores</input><br>
								<input type="checkbox" name="37_3" <?php if($result['37_3_'] == "true") echo "checked";?> value="true" />Laboratrio de informtica</input><br>
								<input type="checkbox" name="37_4" <?php if($result['37_4_'] == "true") echo "checked";?> value="true" />Laboratrio de cincias</input><br>
								<input type="checkbox" name="37_5" <?php if($result['37_5_'] == "true") echo "checked";?> value="true" />Sala de recursos multifuncionais para atendimento Educacional Especializado</input><br>
								<input type="checkbox" name="37_6" <?php if($result['37_6_'] == "true") echo "checked";?> value="true" />Quadra de esportes coberta</input><br>
								<input type="checkbox" name="37_7" <?php if($result['37_7_'] == "true") echo "checked";?> value="true" />Quadra de esportes descoberta</input><br>
								<input type="checkbox" name="37_8" <?php if($result['37_8_'] == "true") echo "checked";?> value="true" />Cozinha</input><br>
								<input type="checkbox" name="37_9" <?php if($result['37_9_'] == "true") echo "checked";?> value="true" />Biblioteca</input><br>
								<input type="checkbox" name="37_10" <?php if($result['37_10_'] == "true") echo "checked";?> value="true" />Sala de leitura</input><br>
								<input type="checkbox" name="37_11" <?php if($result['37_11_'] == "true") echo "checked";?> value="true" />Parque infantil</input><br>
								<input type="checkbox" name="37_12" <?php if($result['37_12_'] == "true") echo "checked";?> value="true" />Berrio</input><br>
								<input type="checkbox" name="37_13" <?php if($result['37_13_'] == "true") echo "checked";?> value="true" />Sanitrio fora do prdio</input><br>
								<input type="checkbox" name="37_14" <?php if($result['37_14_'] == "true") echo "checked";?> value="true" />Sanitrio dentro do prdio</input><br>
								<input type="checkbox" name="37_15" <?php if($result['37_15_'] == "true") echo "checked";?> value="true" />Sanitrio adequado a educao infantil</input><br>
								<input type="checkbox" name="37_16" <?php if($result['37_16_'] == "true") echo "checked";?> value="true" />Sanitrio adequado a alunos com deficincia ou mobilidade reduzida</input><br>
								<input type="checkbox" name="37_17" <?php if($result['37_17_'] == "true") echo "checked";?> value="true" />Dependncias e vias adequadas a alunos com deficincia</input><br>
								<input type="checkbox" name="37_18" <?php if($result['37_18_'] == "true") echo "checked";?> value="true" />Nenhuma das dependncias relacionadas</input><br>
								<br><br>
								
								<a style="font-weight: bolder">38 - Nmero de salas de aula existentes na escola:</a><br>
								<input name="38"  value="<?php echo $result['38_'];?>" class="campo" style="width: 100px;"/><br>
								
								<a style="font-weight: bolder">39 - Nmero de salas utilizadas como salas de aula (dentro e fora do prdio):</a><br>
								<input name="39"  value="<?php echo $result['39_'];?>" class="campo" style="width: 100px;"/><br><br>
																
								<img src="../img/linha_equipamentos.png" WIDTH="100%"/><br><br>
								
								<a style="font-weight: bolder">40 - Equipamentos existentes na escola:</a><br><br>
								<input type="checkbox" name="40_1" <?php if($result['40_1_'] == "true") echo "checked";?> value="true" />Aparelho de televiso</input><br>
								<input type="checkbox" name="40_2" <?php if($result['40_2_'] == "true") echo "checked";?> value="true" />Videocassete</input><br>
								<input type="checkbox" name="40_3" <?php if($result['40_3_'] == "true") echo "checked";?> value="true" />DVD</input><br>
								<input type="checkbox" name="40_4" <?php if($result['40_4_'] == "true") echo "checked";?> value="true" />Antena parablica</input><br>
								<input type="checkbox" name="40_5" <?php if($result['40_5_'] == "true") echo "checked";?> value="true" />Copiadora</input><br>
								<input type="checkbox" name="40_6" <?php if($result['40_6_'] == "true") echo "checked";?> value="true" />Retroprojetor</input><br>
								<input type="checkbox" name="40_7" <?php if($result['40_7_'] == "true") echo "checked";?> value="true" />Impressora</input><br>
								<br>
								
								<a style="font-weight: bolder">41 - Computadores:</a><br><br>
								<input type="radio" name="41" <?php if($result['41_'] == "1") echo "checked";?> value="1" />Possui</input><br>
								<input type="radio" name="41" <?php if($result['41_'] == "2") echo "checked";?> value="2" />No Possui</input>
								<br><br>
								
								<a style="font-weight: bolder">41a - Quantidade de computadores na escola:</a><br>
								<input name="41a"  value="<?php echo $result['41a_'];?>" class="campo" style="width: 100px;"/><br>
								
								<a style="font-weight: bolder">41b - Quantidade de computadores de uso administrativo:</a><br>
								<input name="41b"  value="<?php echo $result['41b_'];?>" class="campo" style="width: 100px;"/><br>
								
								<a style="font-weight: bolder">41c - Quantidade de computadores para uso dos alunos:</a><br>
								<input name="41c"  value="<?php echo $result['41c_'];?>" class="campo" style="width: 100px;"/><br>
								
								<a style="font-weight: bolder">41d - Acesso  Internet:</a><br><br>
								<input type="radio" name="41d" <?php if($result['41d_'] == "1") echo "checked";?> value="1" />Sim</input><br>
								<input type="radio" name="41d" <?php if($result['41d_'] == "2") echo "checked";?> value="2" />No</input>
								<br><br>
								
								<a style="font-weight: bolder">41e - Internet banda larga:</a><br><br>
								<input type="radio" name="41e" <?php if($result['41e_'] == "1") echo "checked";?> value="1" />Possui</input><br>
								<input type="radio" name="41e" <?php if($result['41e_'] == "1") echo "checked";?> value="2" />No possui</input>
								<br><br>
								
								<img src="../img/linha_recursos_humanos.png" WIDTH="100%"/><br><br>
								
								<a style="font-weight: bolder">42 - Total de funcionrios da escola (inclusive professores, auxiliares de Educao Infantil, profissionais/monitores de Atividade Complementar e tradutores intrpretes de Libras:</a><br>
								<input name="42"  value="<?php echo $result['42_'];?>" class="campo" style="width: 100px;"/><br><br>
								
								<img src="../img/linha_alimentacao_escolar.png" WIDTH="100%"/><br><br>
								
								<a style="font-weight: bolder">43 - Alimentao escolar para os alunos:</a><br><br>
								<input type="radio" name="43" <?php if($result['43_'] == "1") echo "checked";?> value="1" />Oferece</input><br>
								<input type="radio" name="43" <?php if($result['43_'] == "2") echo "checked";?> value="2" />No oferece</input>
								<br><br>
								
								<img src="../img/linha_dados_educacionais.png" WIDTH="100%"/><br><br>
								
								<a style="font-weight: bolder">44 - Atendimento Educacional Especializado (AEE):</a><br><br>
								<input type="radio" name="44" <?php if($result['44_'] == "1") echo "checked";?> value="1" />Exclusivamente</input><br>
								<input type="radio" name="44" <?php if($result['44_'] == "2") echo "checked";?> value="2" />No exclusivamente</input><br>
								<input type="radio" name="44" <?php if($result['44_'] == "3") echo "checked";?> value="3" />No oferece</input>
								<br><br>
								
								<a style="font-weight: bolder">45 - Atividade complementar:</a><br><br>
								<input type="radio" name="45" <?php if($result['45_'] == "1") echo "checked";?> value="1" />Exclusivamente</input><br>
								<input type="radio" name="45" <?php if($result['45_'] == "2") echo "checked";?> value="2" />No exclusivamente</input><br>
								<input type="radio" name="45" <?php if($result['45_'] == "3") echo "checked";?> value="3" />No oferece</input>
								<br><br>
								
								<a style="font-weight: bolder">46 - Modalidades:</a><br><br>
								<input type="radio" name="46" <?php if($result['46_'] == "1") echo "checked";?> value="1" />Ensino Regular</input><br>
								<input type="radio" name="46" <?php if($result['46_'] == "2") echo "checked";?> value="2" />Educao Especial - Modalidade Substitutiva</input><br>
								<input type="radio" name="46" <?php if($result['46_'] == "3") echo "checked";?> value="3" />Educao de Jovens e Adultos</input>
								<br><br>
								
								<a style="font-weight: bolder">47 - Etapas:</a><br><br>
								Educao Infantil<br>
								<input type="radio" name="47_1" <?php if($result['47_1_'] == "1") echo "checked";?> value="1" />Creche</input><br>
								<input type="radio" name="47_1" <?php if($result['47_1_'] == "2") echo "checked";?> value="2" />Pr-escola</input><br>
								Ensino Fundamental<br>
								<input type="radio" name="47_2" <?php if($result['47_2_'] == "1") echo "checked";?> value="1" />8 anos</input><br>
								<input type="radio" name="47_2" <?php if($result['47_2_'] == "2") echo "checked";?> value="2" />9 anos</input><br>
								Ensino Mdio<br>
								<input type="radio" name="47_3" <?php if($result['47_3_'] == "1") echo "checked";?> value="1" />Mdio</input><br>
								<input type="radio" name="47_3" <?php if($result['47_3_'] == "2") echo "checked";?> value="2" />Integrado</input><br>
								<input type="radio" name="47_3" <?php if($result['47_3_'] == "3") echo "checked";?> value="3" />Normal/Magistrio</input><br>
								<input type="radio" name="47_3" <?php if($result['47_3_'] == "4") echo "checked";?> value="4" />Educao Profissional</input><br>
								Educao de Jovens e Adultos<br>
								<input type="radio" name="47_4" <?php if($result['47_4_'] == "1") echo "checked";?> value="1" />Ensino Fundamental</input><br>
								<input type="radio" name="47_4" <?php if($result['47_4_'] == "2") echo "checked";?> value="2" />Ensino Mdio</input><br>
								<br><br>
								
								<a style="font-weight: bolder">48 - Ensino Fundamental organizado em ciclos:</a><br><br>
								<input type="radio" name="48" <?php if($result['48_'] == "1") echo "checked";?> value="1" />Sim</input><br>
								<input type="radio" name="48" <?php if($result['48_'] == "2") echo "checked";?> value="2" />No</input><br>
								<br><br>
								
								<a style="font-weight: bolder">49 - Localizao diferenciada da escola:</a><br><br>
								<input type="radio" name="49" <?php if($result['49_'] == "1") echo "checked";?> value="1" />rea de assentamento</input><br>
								<input type="radio" name="49" <?php if($result['49_'] == "2") echo "checked";?> value="2" />Terra indgena</input><br>
								<input type="radio" name="49" <?php if($result['49_'] == "3") echo "checked";?> value="3" />rea remanescente de quilombos</input><br>
								<input type="radio" name="49" <?php if($result['49_'] == "4") echo "checked";?> value="4" />No se aplica</input><br>
								<br><br>
								
								<a style="font-weight: bolder">50 - Materiais didticos especficos para atendimento  diversidade sociocultural:</a><br><br>
								<input type="radio" name="50" <?php if($result['50_'] == "1") echo "checked";?> value="1" />Quilombolas</input><br>
								<input type="radio" name="50" <?php if($result['50_'] == "2") echo "checked";?> value="2" />Indgenas</input><br>
								<input type="radio" name="50" <?php if($result['50_'] == "3") echo "checked";?> value="3" />No utiliza</input><br>
								<br><br>
								
								<a style="font-weight: bolder">51 - Educao Indgena:</a><br><br>
								<input type="radio" name="51" <?php if($result['51_'] == "1") echo "checked";?> value="1" />Sim</input><br>
								<input type="radio" name="51" <?php if($result['51_'] == "2") echo "checked";?> value="2" />No</input><br>
								<br><br>
								
								<a style="font-weight: bolder">52 - Lngua em que o ensino  ministrado (apenas para Educao Indgena):</a><br><br>
								<input type="radio" name="52" <?php if($result['52_'] == "1") echo "checked";?> value="0" />Lngua Indgena</input> | Cdigo da Lngua Indigna <input name="52_1" value="<?php echo $result['52_1_'];?>" class="campo" style="width: 60px;"/><br>
								<input type="radio" name="52" <?php if($result['52_'] == "2") echo "checked";?> value="1" />Lngua Portuguesa</input><br>
								<br><br>
							</blockquote>
				</div>
				<div class="rodape_form">
					<center>
						<a style="font-weight: bolder; font-size: 12; color: red;">
							<?php 
								if(isset($_GET['sucesso'])){
									if($_GET['sucesso'] == 1) echo "Alterado com sucesso!";
								}
							?>
						</a>
						<br><input name="submit" type="submit" value="Atualizar" class="botao"/>
					</center>
				</div>
				</form>
			</div>			
		</div>
	</body>
</html>