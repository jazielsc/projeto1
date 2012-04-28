<?php 
	session_start();
	if (!(isset($_SESSION['id_instituicao']) != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'])){
		header("Location: /index.php");
	}
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
	
	/* CDIGO PARA ORDENAR A TABELA PELO CABEALHO CLICADO */
	if(!isset($_GET['ordem'])){
		$ordem = 'nome';
	}
	else{
		switch($_GET['ordem']){
			case 0: $ordem = 'cod_professor'; break;
			case 1: $ordem = 'nome'; break;
			case 2: $ordem = 'email'; break;
			case 3: $ordem = 'identidade'; break;
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
		$recupera = mysql_query("SELECT cod_professor, nome, email, cidade, bairro, rua, complemento, numero, cod_uf, cep, telefone, identidade, cod_status FROM professor WHERE cod_instituicao = ".$_SESSION['id_instituicao']." AND cod_professor = ".$_GET['id']) or die ("Error na consulta");
		$result = mysql_fetch_array($recupera);
	}
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="../css/estilo.css" />
		<script language="javascript" type="text/javascript">

		</script>
	</head>
	<body>
		<div class="corpo">
			<?php  require_once('../partes/menu_login.php');?>	
			<div class="conteudo">
				<div class="titulo">
					<img src="../img/Bandeira_cadastro_professores.png" />
				</div>
				<br><br><br><br><br>
				<div style="position: relative; height: 200px; width: 600px; left: 50%; margin-left: -300px; overflow-x: none; overflow-y: scroll; border: 1px solid blue;">
					<form name="cad_professor" action="/boletim/scripts/objeto_professor.php" method="POST">
						<center>
							<input type="hidden" name="cod_professor" value="<?php if($acao != 1) echo $result[0];?>" class="campo" style="width: 400px;"/>
							<table>
								<input type="hidden" name="acao" value="<?php if($acao == 1) echo "insert_professor"; else echo "update_professor";?>" />
								<tr>
									<td class="rotulo">Nome: </td>
									<td><input name="nome" value="<?php if($acao != 1) echo $result[1];?>" class="campo" style="width: 400px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">Email: </td>
									<td><input name="email" value="<?php if($acao != 1) echo $result[2];?>" class="campo" style="width: 200px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">Cidade: </td>
									<td><input name="cidade" value="<?php if($acao != 1) echo $result[3];?>" class="campo" style="width: 200px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">Bairro: </td>
									<td><input name="bairro" value="<?php if($acao != 1) echo $result[4];?>" class="campo" style="width: 100px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">Rua: </td>
									<td><input name="rua" value="<?php if($acao != 1) echo $result[5];?>" class="campo" style="width: 300px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">Compl.: </td>
									<td><input name="complemento" value="<?php if($acao != 1) echo $result[6];?>" class="campo" style="width: 200px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">Nmero: </td>
									<td><input name="numero" value="<?php if($acao != 1) echo $result[7];?>" class="campo" style="width: 70px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">UF: </td>
									<td>
										<select name="cod_uf" class="campo" style="width: 50px;">
											<?php 
												$query_uf = mysql_query("SELECT uf_id, uf_sigla FROM uf ORDER BY uf_sigla") or die ("Error na consulta");
												while ($res_uf = mysql_fetch_array($query_uf)){
											?>
											<option <?php if($acao != 1 && $res_uf[0] == $result[8]) echo "selected='selected'";?> value="<?php echo $res_uf[0];?>"><?php echo $res_uf[1];?></option>
											<?php 
												}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td class="rotulo">CEP: </td>
									<td><input name="cep" value="<?php if($acao != 1) echo $result[9];?>" class="campo" style="width: 80px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">Telefone: </td>
									<td><input name="telefone" value="<?php if($acao != 1) echo $result[10];?>" class="campo" style="width: 150px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">Identidade: </td>
									<td><input name="identidade" value="<?php if($acao != 1) echo $result[11];?>" class="campo" style="width: 200px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">Status: </td>
									<td>
										<select name="cod_status" class="campo" style="width: 200px;">
											<?php 
												$query_status = mysql_query("SELECT cod_status, nome FROM status3 ORDER BY cod_status") or die ("Error na consulta");
												while ($res_status = mysql_fetch_array($query_status)){
											?>
											<option <?php if($acao != 1 && $res_status[0] == $result[12]) echo "selected='selected'";?> value="<?php echo $res_status[0];?>"><?php echo $res_status[1];?></option>
											<?php 
												}
											?>
										</select>
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
									elseif ($_GET['sucesso'] == 110) echo "Professor ou Email j cadastrado!";
								}
							?>
						</a><br>
						<input name="submit" type="submit" value="<?php if($acao == 1) echo "Cadastrar"; else echo "Atualizar";?>" class="botao"/>
						<input type="button" onclick="javascript: location.href='/paginas/cadastro_professor.php?acao=1';" value="Cancelar" class="botao"/>
					</center>
				</div>
				</form>
				<div class="lista_selecao" style="width: 730px; height:400px; top: 350px; left: 50%; margin-left: -365px;">
					<table id="box-table-a">
						<thead>
							<tr>
								<th scope="col" style="width: 40px;"><a href="cadastro_professor.php?ordem=0">ID</a></th>
								<th scope="col" style="width: 230px;"><a href="cadastro_professor.php?ordem=1">Nome</a></th>
								<th scope="col" style="width: 230px;"><a href="cadastro_professor.php?ordem=2">Email</a></th>
								<th scope="col" style="width: 230px;"><a href="cadastro_professor.php?ordem=3">Identidade</a></th>
							</tr>
						</thead>
						<tbody>
						<?php 
							/* IMPRESSO DA LISTAGEM DE CURSOS */
							$query_grid = mysql_query("SELECT cod_professor, nome, email, identidade FROM professor WHERE professor.cod_instituicao = ".$_SESSION['id_instituicao']." AND cod_status = 1 ORDER BY $ordem") or die ("Error na consulta");
							while ($result = mysql_fetch_array($query_grid)){
						?>
							<tr>
								<td><a href="cadastro_professor.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php =$result[0];?></a></td>
								<td><a href="cadastro_professor.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php =$result[1];?></a></td>
								<td><a href="cadastro_professor.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php =$result[2];?></a></td>
								<td><a href="cadastro_professor.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php =$result[3];?></a></td>
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