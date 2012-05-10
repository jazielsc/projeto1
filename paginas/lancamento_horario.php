<?php 
	//ver possibilidade de dar um include que verifique as permissoes
	session_start();
	if (!(isset($_SESSION['id_instituicao']) != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'])){
		header("Location: /index.php");
	}
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr">
	<head>
		<link type="text/css" rel="stylesheet" href="../css/estilo2.css" />
		<script language="javascript" type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/jquery.tablesorter.min.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/funcoes.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <link href="../css/estilo.css" rel="stylesheet" type="text/css">
	</head>
	
<body>
	<div class="corpo">
		<?php  require_once('../partes/menu_login.php');?>
		<div class="conteudo">
			<div class="titulo">
				LAN&Ccedil;AMENTO HORÁRIOS
			</div>
			
			<div class="formulario" style="height:300px;">
				<form name="Form_Horario" id="Form_Horario" style="width:700px" action="../boletim/scripts/objeto_Horario.php" >
				<blockquote>
					<input type="hidden" name="acao" id="acao" value="insert_horario">
					<input type="hidden" name="codigo" id="codigo" >
					<input type="hidden" name="dia" id="dia" value="1" >
					<div class="form_subtitulo">LAN&Ccedil;AMENTO HORÁRIOS</div>
						<br>
						<br>
					<label class="rotulo">1 - Curso</label><br>
							
								<select name="cod_curso" id="carrega_curso" class="campo" style="width: 250px;" onChange="carregaTurma(this.value, 'carrega_turma');">
									<?php 
										echo '<option value="0" disabled="disabled">Selecione o Curso</option>';
										$query_curso = mysql_query("SELECT cod_curso, curso.nome FROM curso WHERE curso.cod_instituicao = ".$_SESSION['id_instituicao']." ORDER BY curso.nome") or die ("Error na consulta");
										while ($res_curso = mysql_fetch_array($query_curso)){
									?>
									<option value="<?php echo $res_curso[0];?>"><?php echo utf8_encode($res_curso[1]);?></option>
									<?php 
										}
									?>
								</select>								
							<br>
							<label class="rotulo">2 - Turma</label><br>
								<select name="cod_turma" id="carrega_turma" class="campo" style="width: 250px;" onChange="carregaDisciplina2(this.value, 'carrega_disciplina'); carregaGridHorario(this.value,'carrega_horario')">
							    </select>								
							<br>
							<label class="rotulo">3 - Disciplina</label><br>
							
								<select name="cod_disciplina" id="carrega_disciplina"										class="campo" style="width: 250px;" onChange="carregaProfessor(this.value, 'carrega_professor');">
								</select>
								<br>
								<label class="rotulo">4 - Professor</label><br>
							
								<select name="cod_professor" id="carrega_professor" class="campo" style="width: 250px;" >
							    </select>
				
							<br>
								<label class="rotulo">5 - Dia</label><br> 
								<select name="dia_numero" id="dia_numero" onChange="atualizaDia()">
									<option value='1'>Segunda</option>
									<option value='2'>Terça</option>
									<option value='3'>Quarta</option>
									<option value='4'>Quinta</option>
									<option value='5'>Sexta</option>
									<option value='6'>Sábado</option>
									<option value='7'>Domingo</option>																																																		
								</select>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<br>
								<label class="rotulo">6 - Horário</label><br> 
								Hora Início: 
								<input type="text" name="horainicio" style="width:70px">
							
								Hora Término: 
								<input type="text" name="horatermino" style="width:70px">
								&nbsp;&nbsp;&nbsp;&nbsp;
								Horário: <select name="horario">
									<option value=''></option>
									<option value='I'>I</option>
									<option value='II'>II</option>
									<option value='III'>III</option>
									<option value='IV'>IV</option>
									<option value='V'>V</option>
									<option value='VI'>VI</option>
</select>
						</blockquote>
						<div class='retorno' id="retorno">
						</div>
					</form>
				</div>
				<center style="margin-top:5px;">
					<input id="botao" name="cadastrar" type="button" value="Cadastrar" alt="Cadastrar Horário" onClick="cadastraHorario()" class="botao">
					<input name="Cancelar" type="button" value="Cancelar" alt="Cancelar Alteração" onClick="prepara_insert_horario();" class="botao">
				</center>
				<br>
			<div class="lista_selecao" style="width: 730px; height:380px; margin-left:15px;">
				<div>
					<table width="580" id="box-table-a"  >
						<thead>
							<tr>
								<th width="50" >Cod</th>
								<th width="100" >Dia</th>
								<th width="150" >Horário</th>
								<th width="300" >Disciplina</th>
								<th width="300" >Professor</th>
							</tr>
						</thead>
						<tbody  id="carrega_horario">
						</tbody>
					</table>
					
				</div>
			</div>

			<!-- INICIO DA DIV BOLETIM -->
			
		</div>
	</div>
</body>
</html>