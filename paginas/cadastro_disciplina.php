<?php 
	session_start();
	if (!(isset($_SESSION['id_instituicao']) != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'])){
		header("Location: ../index.php");
	}
	require_once("../boletim/scripts/conecta.php");
	
	/* CDIGO PARA ORDENAR A TABELA PELO CABEALHO CLICADO */
	if(!isset($_GET['ordem'])){
		$ordem = 'nome';
	}
	else{
		switch($_GET['ordem']){
			case 0: $ordem = 'cod_disciplina'; break;
			case 1: $ordem = 'disciplina.nome'; break;
			case 2: $ordem = 'professor.2_'; break;
			case 3: $ordem = 'turma.1_'; break;
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
		$recupera = mysql_query("SELECT disciplina.cod_disciplina, disciplina.nome, disciplina.cod_professor, disciplina.cod_curso, disciplina.cod_turma, disciplina.carga_horaria, disciplina.numero_faltas, curso.cod_curso as ccurso FROM disciplina, curso WHERE disciplina.cod_curso = curso.cod_curso AND curso.cod_instituicao = ".$_SESSION['id_instituicao']." AND disciplina.cod_disciplina = ".$_GET['id']) or die ("Error na consulta");
		$result = mysql_fetch_array($recupera);
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr">
	<head>
		<link type="text/css" rel="stylesheet" href="../css/estilo.css" />
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("select[name=cod_curso]").change(function(){
					$("select[name=cod_turma]").html('<option value="0">Carregando...</option>');
					
					$.post("./loader/carrega_turma.php",
						{id:$(this).val()},
						function(valor){
							$("select[name=cod_turma]").html(valor);
						}
					)
				})
			})
		</script>
	</head>
	<body>
		<div class="corpo">
			<?php  require_once('../partes/menu_login.php');?>	
			<div class="conteudo">
				<div class="titulo">
					<!--<img src="../img/Bandeira_cadastro_disciplinas.png" />-->
					Cadastro de Disciplina
				</div>
				<div class="formulario">
					<form name="cad_disciplina" action="/boletim/scripts/objeto_disciplina.php" method="POST">
						<blockquote>
							<img src="../img/linha_identificacao.png" WIDTH="100%"/><br><br>
							<input type="hidden" name="cod_disciplina" value="<?php if($acao != 1) echo $result[0];?>" class="campo" style="width: 400px;"/>
							<input type="hidden" name="acao" value="<?php if($acao == 1) echo "insert_disciplina"; else echo "update_disciplina";?>" />
							<a style="font-weight: bolder">1 - Nome da Disciplina:</a><br>
							<input name="nome" value="<?php if($acao != 1) echo $result[1];?>" class="campo" style="width: 400px;"/><br>
							<a style="font-weight: bolder">2 - Professor:</a><br>
								<select name="cod_professor" class="campo" style="width: 200px;">
									<option value="-1" selected="selected" disabled="disabled">Selecione o Professor</option>
									<?php 
										$query_status = mysql_query("SELECT cod_professor, 2_ FROM professor WHERE cod_instituicao = ".$_SESSION['id_instituicao']."  ORDER BY 2_") or die ("Error na consulta");
										while ($res_status = mysql_fetch_array($query_status)){
									?>
									<option <?php if($acao != 1 && $res_status[0] == $result[2]) echo "selected='selected'";?> value="<?php echo $res_status[0];?>"><?php echo $res_status[1];?></option>
									<?php 
										}
									?>
								</select><br>
							<a style="font-weight: bolder">3 - Curso:</a><br>
								<select name="cod_curso" class="campo" style="width: 200px;">
									<option value="-1" selected="selected" disabled="disabled">Selecione o curso</option>
									<?php 
										$query_status = mysql_query("SELECT cod_curso, nome FROM curso WHERE cod_instituicao = ".$_SESSION['id_instituicao']."  ORDER BY nome") or die ("Error na consulta");
										while ($res_status = mysql_fetch_array($query_status)){
									?>
									<option <?php if($acao != 1 && $res_status[0] == $result[3]) echo "selected='selected'";?> value="<?php echo $res_status[0];?>"><?php echo $res_status[1];?></option>
									<?php 
										}
									?>
								</select><br>
							<a style="font-weight: bolder">4 - Turma:</a><br>
								<select name="cod_turma" class="campo" style="width: 200px;">
									<?php 
										if($acao != 1){
												if(isset($_GET['curso'])){
												$condicao = " turma.cod_curso = ".$_GET['curso']." AND ";
											}
											else {
												$condicao = " ";
											}
											$query_status = mysql_query("SELECT cod_turma, 1_ FROM turma WHERE".$condicao."cod_instituicao = ".$_SESSION['id_instituicao']."  ORDER BY 1_") or die ("Error na consulta");
											while ($res_status = mysql_fetch_array($query_status)){
										?>
										<option <?php if($acao != 1 && $res_status[0] == $result[4]) echo "selected='selected'";?> value="<?php echo $res_status[0];?>"><?php echo $res_status[1];?></option>
										<?php 
											}
										}
										else {
										?>
										<option value="-1" selected="selected" disabled="disabled">Selecione a Turma</option>
										<?php 
										}
										?>
								</select><br>
							<a style="font-weight: bolder">5 - Carga Horria:</a><br>
							<input name="cargahoraria" value="<?php if($acao != 1) echo $result[5];?>" class="campo" style="width: 100px;"/><br>
							<a style="font-weight: bolder">6 - Numero de Faltas:</a><br>
							<input name="numerofaltas" value="<?php if($acao != 1) echo $result[6];?>" class="campo" style="width: 100px;"/><br>
						</blockquote>
				</div>
				<div class="rodape_form">
					<center>
						<a style="font-weight: bolder; font-size: 12; color: red;">
							<?php 
								if(isset($_GET['sucesso'])){
									if($_GET['sucesso'] == 0) echo "Cadastrado com sucesso!";
									elseif ($_GET['sucesso'] == 1) echo "Alterado com sucesso!";
									elseif ($_GET['sucesso'] == 2) echo "Excludo com sucesso!";
									elseif ($_GET['sucesso'] == 302) echo "Erro ao Excluir. Existem alunos cadastrados na disciplina!";
								}
							?>
						</a><br>
						<input name="submit" type="submit" value="<?php if($acao == 1) echo "Cadastrar"; else echo "Atualizar";?>" class="botao"/>
						<input type="button" onClick="javascript: location.href='/paginas/cadastro_disciplina.php?acao=1';" value="Cancelar" class="botao"/>
					</center>
				</div>
				</form>
			</div>			
		</div>
	</body>
</html>