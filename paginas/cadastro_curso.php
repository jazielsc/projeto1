<?php 
	session_start();

	require_once("../boletim/scripts/conecta.php");
	
	/* CDIGO PARA ORDENAR A TABELA PELO CABEALHO CLICADO */
	if(!isset($_GET['ordem'])){
		$ordem = 'cod_curso';
	}
	else{
		switch($_GET['ordem']){
			case 0: $ordem = 'cod_curso'; break;
			case 1: $ordem = 'nome'; break;
			case 2: $ordem = 'tipo'; break;
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
		$recupera = mysql_query("SELECT cod_curso, nome, tipo FROM curso WHERE cod_instituicao = ".$_SESSION['id_instituicao']." AND cod_curso = ".$_GET['id']) or die ("Error na consulta");
		$result = mysql_fetch_array($recupera);
	}
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="../css/estilo.css" />
		<script language="javascript" type="text/javascript">
			function validaBranco() {
				nome = document.cad_curso.nome.value;
				if((nome == "") || (tipo=="0")) {
					alert("Preencha todos os campos!");
					document.cad_curso.nome.focus();
					return false;
				}
			}
		</script>
	</head>
	<body>
		<div class="corpo">
			<?php  require_once('../partes/menu_login.php');?>	
			<div class="conteudo">
				<div class="titulo">
					<!--<img src="../img/Bandeira_cadastro_cursos.png" />-->
					Cadastro de Curso
				</div>
				<div class="formulario">
					<form name="cad_curso" action="/boletim/scripts/objeto_curso.php" method="POST">
						<blockquote>
							<img src="../img/linha_identificacao.png" WIDTH="100%"/><br><br>
							<input type="hidden" name="acao" value="<?php if($acao == 1) echo "insert_curso"; else echo "update_curso";?>" />
							<a style="font-weight: bolder">1 - Nome do Curso:</a><br>
							<input name="nome" value="<?php if($acao != 1) echo $result[1];?>" class="campo" style="width: 400px;"/><br>
							<a style="font-weight: bolder">2 - Tipo do Curso:</a><br>
							<select name="tipo" class="campo" style="width: 250px;">
								<option <?php if($acao != 1 && $result[2] === "Educao Infantil") echo "selected='SELECTED'";?> value="Educao Infantil">Educao Infantil</option>
								<option <?php if($acao != 1 && $result[2] === "Ensino Fundamental") echo "selected='SELECTED'";?>value="Ensino Fundamental">Ensino Fundamental</option>
								<option <?php if($acao != 1 && $result[2] === "Ensino Médio") echo "selected='SELECTED'";?>value="Ensino Médio">Ensino Médio</option>
								<option <?php if($acao != 1 && $result[2] === "Ensino Técnico") echo "selected='SELECTED'";?>value="Ensino Técnico">Ensino Técnico</option>
							</select>
							<input type="hidden" name="cod_instituicao" value="<?php echo $_SESSION['id_instituicao'];?>" />
							<input type="hidden" name="cod_curso" value="<?php if(isset($_GET['id'])) echo $_GET['id'];?>" />
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
										elseif ($_GET['sucesso'] == 102) echo "Excluso no permitida. Existem turmas cadastradas!";
									}
								?>
							</a><br>
									<input name="submit" type="submit" onClick="return validaBranco()" value="<?php if($acao == 1) echo "Cadastrar"; else echo "Atualizar";?>" class="botao"/>
									<input type="button" onClick="javascript: location.href='/paginas/cadastro_curso.php?acao=1';" value="Cancelar" class="botao"/>
						</center>
					</div>
				</form>

			</div>			
		</div>
	</body>
</html>