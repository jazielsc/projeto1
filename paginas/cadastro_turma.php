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
			case 0: $ordem = 'cod_turma'; break;
			case 1: $ordem = 'nome'; break;
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
		$recupera = mysql_query("SELECT cod_turma, nome, data, cod_curso, turno, semestre, data_final FROM turma WHERE cod_instituicao = ".$_SESSION['id_instituicao']." AND cod_turma = ".$_GET['id']) or die ("Error na consulta");
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
					<img src="../img/Bandeira_cadastro_turmas.png" />
				</div>
				<br><br><br><br><br>
				<div style="position: relative; height: 200px; width: 600px; left: 50%; margin-left: -300px; overflow-x: none; overflow-y: scroll; border: 1px solid blue;">
					<form name="cad_turma" action="/boletim/scripts/objeto_turma.php" method="POST">
						<center>
							<input type="hidden" name="cod_turma" value="<?php if($acao != 1) echo $result[0];?>" class="campo" style="width: 400px;"/>
							<table>
								<input type="hidden" name="acao" value="<?php if($acao == 1) echo "insert_turma"; else echo "update_turma";?>" />
								<tr>
									<td class="rotulo">Nome: </td>
									<td><input name="nome" value="<?php if($acao != 1) echo $result[1];?>" class="campo" style="width: 400px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">Data Incio: </td>
									<td><input name="data_inicial" value="<?php if($acao != 1) echo $result[2];?>" class="campo" style="width: 100px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">Curso: </td>
									<td>
										<select name="cod_curso" class="campo" style="width: 250px;">
											<?php 
												$query_curso = mysql_query("SELECT cod_curso, curso.nome FROM curso WHERE curso.cod_instituicao = ".$_SESSION['id_instituicao']." ORDER BY curso.nome") or die ("Error na consulta");
												while ($res_curso = mysql_fetch_array($query_curso)){
											?>
											<option <?php if($acao != 1 && $res_curso[0] == $result[3]) echo "selected='selected'";?> value="<?php echo $res_curso[0];?>"><?php echo $res_curso[1];?></option>
											<?php 
												}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td class="rotulo">Turno: </td>
									<td>
										<select name="turno" class="campo" style="width: 250px;">
											<option <?php if($acao != 1 && $result[4] === "Matutino") echo "selected='SELECTED'";?> value="Matutino">Matutino</option>
											<option <?php if($acao != 1 && $result[4] === "Vespertino") echo "selected='SELECTED'";?> value="Matutino">Vespertino</option>
											<option <?php if($acao != 1 && $result[4] === "Noturno") echo "selected='SELECTED'";?> value="Matutino">Noturno</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="rotulo">Semestre: </td>
									<td>
										<select name="semestre" class="campo" style="width: 250px;">
											<option <?php if($acao != 1 && $result[5] == 1) echo "selected='SELECTED'";?> value=1>1</option>
											<option <?php if($acao != 1 && $result[5] == 2) echo "selected='SELECTED'";?> value=2>2</option>
											<option <?php if($acao != 1 && $result[5] == 3) echo "selected='SELECTED'";?> value=3>3</option>
											<option <?php if($acao != 1 && $result[5] == 4) echo "selected='SELECTED'";?> value=4>4</option>
											<option <?php if($acao != 1 && $result[5] == 5) echo "selected='SELECTED'";?> value=5>5</option>
											<option <?php if($acao != 1 && $result[5] == 6) echo "selected='SELECTED'";?> value=6>6</option>
											<option <?php if($acao != 1 && $result[5] == 7) echo "selected='SELECTED'";?> value=7>7</option>
											<option <?php if($acao != 1 && $result[5] == 8) echo "selected='SELECTED'";?> value=8>8</option>
											<option <?php if($acao != 1 && $result[5] == 9) echo "selected='SELECTED'";?> value=9>9</option>
											<option <?php if($acao != 1 && $result[5] == 10) echo "selected='SELECTED'";?> value=10>10</option>
											<option <?php if($acao != 1 && $result[5] == 11) echo "selected='SELECTED'";?> value=11>11</option>
											<option <?php if($acao != 1 && $result[5] == 12) echo "selected='SELECTED'";?> value=12>12</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="rotulo">Data Termino: </td>
									<td><input name="data_final" value="<?php if($acao != 1) echo $result[6];?>" class="campo" style="width: 100px;"/></td>
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
				<div class="lista_selecao" style="width: 730px; height:400px; top: 350px; left: 50%; margin-left: -365px;">
					<table id="box-table-a">
						<thead>
							<tr>
								<th scope="col" style="width: 40px;"><a href="cadastro_turma.php?ordem=0">ID</a></th>
								<th scope="col" style="width: 210px;"><a href="cadastro_turma.php?ordem=1">Nome</a></th>
								<th scope="col" style="width: 210px;"><a href="cadastro_turma.php?ordem=2">Curso</a></th>
								<th scope="col" style="width: 100px;"><a href="cadastro_turma.php?ordem=3">Turno</a></th>
								<th scope="col" style="width: 20px;"><a>Excluir</a></th>
							</tr>
						</thead>
						<tbody>
						<?php 
							/* IMPRESSO DA LISTAGEM DE CURSOS */
							$query_grid = mysql_query("SELECT cod_turma, turma.nome, curso.nome as curso_nome, turno FROM turma, curso WHERE turma.cod_curso = curso.cod_curso AND turma.cod_instituicao = ".$_SESSION['id_instituicao']." ORDER BY $ordem") or die ("Erro na consulta");
							while ($result = mysql_fetch_array($query_grid)){
						?>
							<tr>
								<td><a href="cadastro_turma.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[0];?></a></td>
								<td><a href="cadastro_turma.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[1];?></a></td>
								<td><a href="cadastro_turma.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[2];?></a></td>
								<td><a href="cadastro_turma.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo$result[3];?></a></td>
								<form name="f_exclusao" action="/boletim/scripts/objeto_turma.php" method="POST">
									<input type="hidden" name="codigo" value="<?php echo $result[0];?>" />
									<input type="hidden" name="acao" value="delete_turma" />
									<td style="text-align: center;"><input type="submit" value="-" style="display: block; width: 40px; height: 18px;"/></td>
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