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
			case 0: $ordem = 'cod_disciplina'; break;
			case 1: $ordem = 'disciplina.nome'; break;
			case 2: $ordem = 'professor.nome'; break;
			case 3: $ordem = 'turma.nome'; break;
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
<html>
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
					<img src="../img/Bandeira_cadastro_disciplinas.png" />
				</div>
				<br><br><br><br><br>
				<div style="position: relative; height: 200px; width: 600px; left: 50%; margin-left: -300px; overflow-x: none; overflow-y: scroll; border: 1px solid blue;">
					<form name="cad_disciplina" action="/boletim/scripts/objeto_disciplina.php" method="POST">
						<center>
							<input type="hidden" name="cod_disciplina" value="<?php if($acao != 1) echo $result[0];?>" class="campo" style="width: 400px;"/>
							<table>
								<input type="hidden" name="acao" value="<?php if($acao == 1) echo "insert_disciplina"; else echo "update_disciplina";?>" />
								<tr>
									<td class="rotulo">Nome: </td>
									<td><input name="nome" value="<?php if($acao != 1) echo $result[1];?>" class="campo" style="width: 400px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">Professor: </td>
									<td>
										<select name="cod_professor" class="campo" style="width: 200px;">
											<option value="-1" selected="selected" disabled="disabled">Selecione o Professor</option>
											<?php 
												$query_status = mysql_query("SELECT cod_professor, nome FROM professor WHERE cod_instituicao = ".$_SESSION['id_instituicao']."  ORDER BY nome") or die ("Error na consulta");
												while ($res_status = mysql_fetch_array($query_status)){
											?>
											<option <?php if($acao != 1 && $res_status[0] == $result[2]) echo "selected='selected'";?> value="<?php echo $res_status[0];?>"><?php echo $res_status[1];?></option>
											<?php 
												}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td class="rotulo">Curso: </td>
									<td>
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
										</select>
									</td>
								</tr>
								<tr>
									<td class="rotulo">Turma: </td>
									<td>
										<select name="cod_turma" class="campo" style="width: 200px;">
											<?php 
												if($acao != 1){
													if(isset($_GET['curso'])){
														$condicao = " turma.cod_curso = ".$_GET['curso']." AND ";
													}
													else {
														$condicao = " ";
													}
													$query_status = mysql_query("SELECT cod_turma, nome FROM turma WHERE".$condicao."cod_instituicao = ".$_SESSION['id_instituicao']."  ORDER BY nome") or die ("Error na consulta");
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
										</select>
									</td>
								</tr>
								<tr>
									<td class="rotulo">C. Horria: </td>
									<td><input name="cargahoraria" value="<?php if($acao != 1) echo $result[5];?>" class="campo" style="width: 100px;"/></td>
								</tr>
								<tr>
									<td class="rotulo">N. de faltas: </td>
									<td><input name="numerofaltas" value="<?php if($acao != 1) echo $result[6];?>" class="campo" style="width: 100px;"/></td>
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
									elseif ($_GET['sucesso'] == 302) echo "Erro ao Excluir. Existem alunos cadastrados na disciplina!";
								}
							?>
						</a><br>
						<input name="submit" type="submit" value="<?php if($acao == 1) echo "Cadastrar"; else echo "Atualizar";?>" class="botao"/>
						<input type="button" onclick="javascript: location.href='/paginas/cadastro_disciplina.php?acao=1';" value="Cancelar" class="botao"/>
					</center>
				</div>
				</form>
				<div class="lista_selecao" style="width: 730px; height:400px; top: 350px; left: 50%; margin-left: -365px;">
					<table id="box-table-a">
						<thead>
							<tr>
								<th scope="col" style="width: 40px;"><a href="cadastro_disciplina.php?ordem=0">ID</a></th>
								<th scope="col" style="width: 200px;"><a href="cadastro_disciplina.php?ordem=1">Nome</a></th>
								<th scope="col" style="width: 200px;"><a href="cadastro_disciplina.php?ordem=2">Professor</a></th>
								<th scope="col" style="width: 200px;"><a href="cadastro_disciplina.php?ordem=3">Turma</a></th>
								<th scope="col" style="width: 60px;"><a>Excluir</a></th>
							</tr>
						</thead>
						<tbody>
						<?php 
							/* IMPRESSO DA LISTAGEM DE CURSOS */
							$query_grid = mysql_query("SELECT cod_disciplina, disciplina.nome, professor.nome as pnome, turma.nome as tnome, turma.cod_curso FROM disciplina, professor, turma WHERE turma.cod_instituicao = ".$_SESSION['id_instituicao']." AND professor.cod_professor = disciplina.cod_professor AND turma.cod_turma = disciplina.cod_turma ORDER BY $ordem") or die ("Error na consulta");
							while ($result = mysql_fetch_array($query_grid)){
						?>
							<tr>
								<td><a href="cadastro_disciplina.php?acao=2&id=<?php echo $result[0];?>&curso=<?php echo $result[4];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php =$result[0];?></a></td>
								<td><a href="cadastro_disciplina.php?acao=2&id=<?php echo $result[0];?>&curso=<?php echo $result[4];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php =$result[1];?></a></td>
								<td><a href="cadastro_disciplina.php?acao=2&id=<?php echo $result[0];?>&curso=<?php echo $result[4];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php =$result[2];?></a></td>
								<td><a href="cadastro_disciplina.php?acao=2&id=<?php echo $result[0];?>&curso=<?php echo $result[4];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php =$result[3];?></a></td>
								<form name="f_exclusao" action="/boletim/scripts/objeto_disciplina.php" method="POST">
									<input type="hidden" name="codigo" value="<?php echo $result[0];?>" />
									<input type="hidden" name="acao" value="delete_disciplina" />
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