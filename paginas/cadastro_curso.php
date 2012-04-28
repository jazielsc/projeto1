<?php 
	session_start();
	if (!(isset($_SESSION['id_instituicao']) != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'])){
		header("Location: /index.php");
	}
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
	
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
					<img src="../img/Bandeira_cadastro_cursos.png" />
				</div>
				<br><br><br><br><br>
				<div style="position: relative; height: 200px; width: 600px; left: 50%; margin-left: -300px; overflow-x: none; overflow-y: scroll; border: 1px solid blue;">
					<form name="cad_curso" action="/boletim/scripts/objeto_curso.php" method="POST">
						<center>
							<table>
								<input type="hidden" name="acao" value="<?php if($acao == 1) echo "insert_curso"; else echo "update_curso";?>" />
								<tr>
									<td class="rotulo">Nome: </td>
									<td><input name="nome" value="<?php if($acao != 1) echo $result[1];?>" class="campo" style="width: 400px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">Tipo: </td>
									<td>
										<select name="tipo" class="campo" style="width: 250px;">
											<option <?php if($acao != 1 && $result[2] === "Educao Infantil") echo "selected='SELECTED'";?> value="Educao Infantil">Educao Infantil</option>
											<option <?php if($acao != 1 && $result[2] === "Ensino Fundamental") echo "selected='SELECTED'";?>value="Ensino Fundamental">Ensino Fundamental</option>
											<option <?php if($acao != 1 && $result[2] === "Ensino Mdio") echo "selected='SELECTED'";?>value="Ensino Mdio">Ensino Mdio</option>
											<option <?php if($acao != 1 && $result[2] === "Ensino Tcnico") echo "selected='SELECTED'";?>value="Ensino Tcnico">Ensino Tcnico</option>
										</select>
										<input type="hidden" name="cod_instituicao" value="<?php =$_SESSION['id_instituicao'];?>" />
										<input type="hidden" name="cod_curso" value="<?php if(isset($_GET['id'])) echo $_GET['id'];?>" />
									</td>
								</tr>
							</table>
						</center>
					</div>
					<div>
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
				<div class="lista_selecao" style="width: 730px; height:400px; top: 350px; left: 50%; margin-left: -365px;">
					<table id="box-table-a">
						<thead>
							<tr>
								<th scope="col" style="width: 40px;"><a href="cadastro_curso.php?ordem=0">ID</a></th>
								<th scope="col" style="width: 230px;"><a href="cadastro_curso.php?ordem=1">Curso</a></th>
								<th scope="col" style="width: 230px;"><a href="cadastro_curso.php?ordem=2">Tipo</a></th>
								<th scope="col" style="width: 20px;"><a>Excluir</a></th>
							</tr>
						</thead>
						<tbody>
						<?php 
							/* IMPRESSO DA LISTAGEM DE CURSOS */
							$query_grid = mysql_query("SELECT cod_curso, curso.nome, curso.tipo FROM curso WHERE curso.cod_instituicao = ".$_SESSION['id_instituicao']." ORDER BY $ordem") or die ("Error na consulta");
							while ($result = mysql_fetch_array($query_grid)){
						?>
							<tr>
								<td><a href="cadastro_curso.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php =$result[0];?></a></td>
								<td><a href="cadastro_curso.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php =$result[1];?></a></td>
								<td><a href="cadastro_curso.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php =$result[2];?></a></td>
								<form name="f_exclusao" action="/boletim/scripts/objeto_curso.php" method="POST">
									<input type="hidden" name="codigo" value="<?php echo $result[0];?>" />
									<input type="hidden" name="acao" value="delete_curso" />
									<td style="text-align: center;"><input type="submit" value="-" style="display: block; width: 45px; height: 18px;"/></td>
								</form>
							</tr>
						<?php 	
							}
						?>
						</tbody>
					</table>
				</div>
			</div>			
		</div>
	</body>
</html>