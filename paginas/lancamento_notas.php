<?php 

	session_start();
	if (!(isset($_SESSION['id_instituicao']) != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'])){
		header("Location: ../index.php");
	}
	require_once("../boletim/scripts/conecta.php");
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="../css/estilo.css" />
		<script language="javascript" type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/jquery.tablesorter.min.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/funcoes.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2"></head>
	<body>
		<div class="corpo" style="height:1000px;">
			<?php require_once('../partes/menu_login.php');?>	
			<div class="conteudo">
				<div class="titulo">
					LANÇAMENTO DE NOTAS POR TURMA
				</div>
				<br>
				<div class="div_filtro">
					<div class="form_subtitulo" style="width:700px">FILTRO</div>
						<table>
							<tr>
								<td class="rotulo">Curso: </td>
								<td>
									<select name="cod_curso" id="carrega_curso" class="campo" style="width: 250px;" onChange="carregaTurma(this.value, 'carrega_turma');">
										<?php 
											echo '<option value="0" >Selecione o Curso</option>';
											$query_curso = mysql_query("SELECT cod_curso, curso.nome FROM curso WHERE curso.cod_instituicao = ".$_SESSION['id_instituicao']." ORDER BY curso.nome") or die ("Error na consulta");
											while ($res_curso = mysql_fetch_array($query_curso)){
										?>
										<option value="<?php echo $res_curso[0];?>"><?php echo $res_curso[1];?></option>
										<?php 
											}
										?>
									</select>								
								</td>
								<td class="rotulo">Turma:</td>
								<td>
									<select name="cod_turma" id="carrega_turma" class="campo" style="width: 250px;" onChange="carregaDisciplina2(this.value, 'carrega_disciplina');">
									</select>								
								</td>
							</tr>
							<tr>
								<td class="rotulo">Disciplina: </td>
								<td>
									<select name="cod_disciplina" id="carrega_disciplina"										class="campo" style="width: 250px;" onChange="carregaProfessor(this.value, 'carrega_professor');">
									</select>								
								</td>
								<td class="rotulo">Professor: </td>
								<td>
									<select name="cod_professor" id="carrega_professor" class="campo" style="width: 250px;" onChange="carregaTabelaTurmaAluno(document.getElementById('carrega_disciplina').value ,this.value,'carrega_alunos_diciplina'); ">
									</select>
								</td>
							</tr>
						</table>
				</div>
				<div class="formulario" style="height:300px;">
					<form id="Form_boletim" action="../boletim/scripts/objeto_boletim.php">
						<blockquote>
							<input id="acao" type="hidden" name="acao" value="insert_notas" >
							<input id="cod_curso" type="hidden" name="cod_curso" value="" >
							<input id="cod_turma" type="hidden" name="cod_turma" value="" >
							<input id="cod_disciplina" type="hidden" name="cod_disciplina" value="" >
							<input id="cod_professor" type="hidden" name="cod_professor" value="" >
							<div class="form_subtitulo">BOLETIM DO ALUNO</div>
							<br>
							<label for="cod_aluno" class="rotulo">1 - Matr&iacute;cula:</label>
							<br>
							<input id="cod_aluno" class="campo" type="text" name="cod_aluno" style="width:70px" >
							<br>
							<label for="nome" class="rotulo">2 - Nome Aluno: </label><br>
							<input name="nome" type="text" disabled="disable" class="campo" id="nome" style="width:300px">
							<br>
							<label class="rotulo">3 - N&uacute;mero de Avalia&ccedil;&otilde;es: </label>
							<br>
							<select   name="numero_avaliacoes" class="campo" id="numero_avalicaoes">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
						  </select><br>
							<label class="rotulo">4 - Notas: </label><br>
							<label>Nota 1: </label> <input name="nota_1" type="text" class="campo" id="nota_1" style="width:30px" >
							<label>Nota 2: </label>  <input name="nota_2" type="text" class="campo" id="nota_2" style="width:30px" >
							<label>Nota 3: </label>  <input name="nota_3" type="text" class="campo" id="nota_3" style="width:30px" >
							<label>Nota 4: </label>  <input name="nota_4" type="text" class="campo" id="nota_4" style="width:30px" >
							<label>Nota 5: </label>  <input name="nota_5" type="text" class="campo" id="nota_5" style="width:30px" >
							<label>Nota 6: </label>  <input name="nota_6" type="text" class="campo" id="nota_6" style="width:30px" >
							
							<br>
							<label class='rotulo'>5 - Outros</label><br>
							<label>Faltas: </label>  <input  name="faltas" type="text" class="campo" id="faltas" style="width:30px" >
							<label>Unidade: </label>
							<select name="unidade" class="campo" id="unidade">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
						  </select>
						</blockquote>
						<div class='retorno' id="retorno">
						</div>
					</form>
				</div>
				<center style="margin-top:5px;">
						<input type="button" class="botao" value="Cadastrar" onClick="cadastrar_Notas(this)">
						<input type="button" class="botao" value="Cancelar">
				</center>
				<div class="lista_selecao" style="width: 730px; height:400px; margin-left:15px;">
					<table width="580" id="box-table-a" >
						<thead>
							<tr>
								<th width="67" >Cod</th>
								<th width="306" align="left">Aluno</th>
								<th width="191" >Disciplina</th>
							</tr>
						</thead>
						<tbody  id="carrega_alunos_diciplina">
						</tbody>
				</div>
				
			</div>
		</div>
	</body>
</html>