<?php 

	session_start();
	if (!(isset($_SESSION['id_instituicao']) != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'])){
		header("Location: ../index.php");
	}
	require_once("../boletim/scripts/conecta.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html dir="ltr">
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
					CONSULTA BOLETIM ALUNO
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
								<select name="cod_turma" id="carrega_turma" class="campo" style="width: 250px;" onChange="carregaAluno($('#carrega_curso').val(), this.value, 'carrega_aluno');">
							    </select>								
							</td>
						</tr>
						<tr>
							<td class="rotulo" >Aluno </td>
							<td colspan="3">
								<select name="cod_aluno" id="carrega_aluno" class="campo" style="width: 250px;" onChange="carregaGridBoletimAluno2($('#carrega_curso').val(), $('#carrega_turma').val(), this.value, 'carrega_boletim'); ">
								</select>
							</td>
						</tr>
						</table>
					</div>
				
				<div class="lista_selecao" style="width: 730px; height:400px; margin-left:15px;">
					<table width="580" id="box-table-a" >
						<thead>
						<tr>
							<th width="240"  align="left">Disciplina</th>
							<th width="43" >N1</th>
							<th width="43" >N2</th>
							<th width="43" >N3</th>
							<th width="43" >N4</th>
							<th width="43" >N5</th>
							<th width="42" >N6</th>
							<th width="52" >Média</th>
							<th width="47" >Fal</th>
							<th width="32" >Uni</th>
							<th width="1" ></th>
						</tr>
					</thead>
					<tbody  id="carrega_boletim">
					</tbody>
				</div>
				
			</div>
		</div>
	</body>
</html>