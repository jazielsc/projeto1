<?php 
	//ver possibilidade de dar um include que verifique as permissoes
	session_start();
	if (!(isset($_SESSION['id_instituicao']) != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'])){
		header("Location: ../index.php");
	}
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr">
	<head>
		<link type="text/css" rel="stylesheet" href="../css/estilo.css" />
		<script language="javascript" type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/jquery.tablesorter.min.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/funcoes.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body>
	<div class="corpo" style="height:1000px;">
		<?php  require_once('../partes/menu_login.php');?>
		<div class="conteudo">
			<div class="titulo">
				LAN&Ccedil;AMENTO DISCIPLINAS
			</div>

			<div class="formulario" style="height:300px;">
				<form name="Form_disciplina" id="Form_disciplina" style="height:300px" action="../boletim/scripts/objeto_disciplina.php"  >
					<blockquote>
						<input id="acao" type="hidden" name="acao" value="insert_disciplina" >
						<div class="form_subtitulo">LAN&Ccedil;AMENTO DE DISCIPLINAS</div>
						<br>
						<br>
						<label class="rotulo">1 - Professor:</label><br>
						<select name="cod_professor" id="cod_professor" class="campo" style="width: 400px;" onChange="carregaGridDisciplina(this.value, 'carrega_disciplina_professor');" >
							<?php 
								echo '<option value="0" disabled="disabled">Selecione o Curso</option>';
								$query_curso = mysql_query("SELECT cod_professor, professor.2_ FROM professor WHERE cod_instituicao = ".$_SESSION['id_instituicao']."  AND cod_status = 1 ORDER BY 2_") or die ("Error na consulta");
								while ($res_curso = mysql_fetch_array($query_curso)){
							?>
							<option value="<?php echo $res_curso[0];?>"><?php echo $res_curso[1];?></option>
							<?php 
								}
							?>
						</select>						  
						<br>
						<label class="rotulo">2 - Curso: </label><br>
						<select  name="cod_curso" id="carrega_curso" class="campo" style="width: 250px;" onChange="carregaTurma(this.value, 'carrega_turma');">
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
						<br>
						<label class="rotulo">3 - Turma:</label><br>
						<select name="cod_turma" id="carrega_turma" class="campo" style="width: 250px;" >
						</select>	
						<br>
						<label class="rotulo">4 - Disciplina</label><br>
						<input type="text" name="nome" style="width:350px;" class="campo">
						<br>
						<label class="rotulo">5 - Carga Horria:</label><br>
						<input type="text" name="cargahoraria" size="10" style="width:40px">
						<br>
						<label class="rotulo">6 - Numero de Faltas:</label><br>
						<input type="text" name="txt_numerofaltas" size="10" style="width:40px">
						<br>
						<label class="rotulo">7 - Ano Letivo</label><br>
						<select name="ano_letivo" id="ano_letivo" onChange="carregaGridDisciplinaAno($('#cod_professor').val(),this.value,'carrega_disciplina_professor')">
							<?php 
								$ano = 2010;
								for($ano=2010;$ano<=date('Y')+1;$ano++){
									if($ano==date('Y'))
										$select ="selected='selected'";
									else	
										$select ='';
									echo "<option $select value='$ano'>$ano</option>";
								}
							?>						
						</select>
					</blockquote>
					<div class="retorno" id="retorno">
					</div>
				</form>
			</div>
			<center style="margin-top:5px;">
				<input type="button" value="Cadastrar" onClick="cadastraDisciplina();" class="botao">
				<input type="button" value="Cancelar" class="botao" onClick="$('#Form_disciplina').reset()">
			</center>
			<div class="lista_selecao" style="width: 730px; height:400px; margin-left:15px;">
				<table width="580" id="box-table-a" >
					<thead>
						<tr>
							<th width="180" >Professor</th>
							<th width="150" >Disciplina</th>
							<th width="180" >Curso</th>
							<th width="150" >Turma</th>								
						</tr>
					</thead>
					<tbody  id="carrega_disciplina_professor">
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>