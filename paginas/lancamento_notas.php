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
			case 0: $ordem = 'cod_aluno'; break;
			case 1: $ordem = 'nome'; break;
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
		$recupera = mysql_query("SELECT cod_aluno, nome, email, cidade, bairro, rua, complemento, numero, cod_uf, cep, telefone, celular, matricula, responsavel, email_responsavel, cod_curso, identidade, datanasc, cod_status FROM aluno WHERE cod_instituicao = ".$_SESSION['id_instituicao']." AND cod_aluno = ".$_GET['id']) or die ("Error na consulta");
		$result = mysql_fetch_array($recupera);
	}
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="../css/estilo.css" />
		<script language="javascript" type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/funcoes.js"></script>
	</head>
<body>
	<div class="corpo">
		<?php  require_once('../partes/menu_login.php');?>	
		<div class="conteudo">
			<div class="titulo">
				<img src="../img/Bandeira_lancamento_notas.png" />		    </div>
			<br><br><br><br><br>
			<div style="position: relative; height: 200px; width: 600px; left: 50%; margin-left: -300px; overflow-x: none; overflow-y: scroll; border: 1px solid blue;">
				<form name="lanc_turma" action="boletim/scripts/objeto_aluno.php" method="POST">
					<center>
						<table>
							<tr>
								<td class="rotulo">Curso: </td>
								<td>
									<select name="cod_curso" class="campo" style="width: 250px;" onChange="carregaTurma(this.value, 'carrega_turma');">
<?php 
	echo '<option value="0" disabled="disabled">Selecione o Curso</option>';
	$query_curso = mysql_query("SELECT cod_curso, curso.nome FROM curso WHERE curso.cod_instituicao = ".$_SESSION['id_instituicao']." ORDER BY curso.nome") or die ("Error na consulta");
	while ($res_curso = mysql_fetch_array($query_curso)){
	?>
										<option value="<?php echo $res_curso[0];?>"><?php echo $res_curso[1];?></option>
										<?php 
												}
											?>
								    </select>								
								</td>
							</tr>
							<tr>
								<td class="rotulo">Turma: </td>
								<td>
								<select name="cod_turma" id="carrega_turma" class="campo" style="width: 250px;" onChange="carregaDisciplina(this.value, 'carrega_disciplina');">
										
								    </select>	
								</td>
							</tr>
							<tr>
								<td class="rotulo">Disciplina: </td>
								<td>
								<select name="cod_disciplina" id="carrega_disciplina"										class="campo" style="width: 250px;" onChange="carregaProfessor(this.value, 'carrega_professor');">
						
								    </select>	
								</td>
							</tr>
							<tr>
								<td class="rotulo">Professor: </td>
								<td>
								<select name="cod_professor" id="carrega_professor" class="campo" style="width: 250px;">
										
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
								}
							?>
						</a><br>
						<input name="submit" type="submit" value="<?php if($acao == 1) echo "Cadastrar"; else echo "Atualizar";?>" class="botao"/>
						<input type="button" onClick="javascript: location.href='/paginas/cadastro_aluno.php?acao=1';" value="Cancelar" class="botao"/>
					</center>
				</div>
			</form>
			<div class="lista_selecao" style="width: 730px; height:400px; top: 350px; left: 50%; margin-left: -365px;">
				<table id="box-table-a">
					<thead>
						<tr>
							<th scope="col" style="width: 40px;"><a href="lancamento_notas.php?ordem=0">Cod</a></th>
							<th scope="col" style="width: 230px;"><a href="lancamento_notas?ordem=1">Aluno</a></th>
							<th scope="col" style="width: 230px;"><a href="lancamento_notas?ordem=2">Disciplina</a></th>
						</tr>
				    </thead>
					<tbody>
					  <?php 
							/* IMPRESSO DA LISTAGEM DE CURSOS */
							$query_grid = mysql_query("SELECT cod_aluno, nome, email, matricula FROM aluno WHERE aluno.cod_instituicao = ".$_SESSION['id_instituicao']." AND cod_status = 1 ORDER BY $ordem") or die ("Error na consulta");
							while ($result = mysql_fetch_array($query_grid)){
						?>
						<tr>
							<td><a href="cadastro_aluno.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;";?>"><?php echo $result[0];?></a></td>
							<td><a href="cadastro_aluno.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;"; ?>"><?php echo $result[1];?></a></td>
							<td><a href="cadastro_aluno.php?acao=2&id=<?php echo $result[0];?>" style="<?php if(isset($_GET['id']) && $_GET['id'] == $result[0]) echo "background-color: orange;"; ?>"><?php echo $result[2];?></a></td>
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