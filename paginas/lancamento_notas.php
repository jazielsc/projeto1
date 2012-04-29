<?php 
	//ver possibilidade de dar um include que verifique as permissoes
	session_start();
	if (!(isset($_SESSION['id_instituicao']) != "" and $_SESSION['id_instituicao'] != 0 and isset($_SESSION['NomeUsuario']) and isset($_SESSION['passagem']) and $_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'] and  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'])){
		header("Location: /index.php");
	}
	require_once($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="../css/estilo.css" />
		<script language="javascript" type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/jquery.tablesorter.min.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>		
		<script language="javascript" type="text/javascript" src="../js/funcoes.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
	<div class="corpo">
	  <?php  require_once('../partes/menu_login.php');?>
	  <div class="conteudo">
			<div class="titulo">
				<img src="../img/Bandeira_lancaentos_notas.png" />			
			</div>
		  <br><br><br><br><br>
		  <div style="position: relative; height: 70px; width: 700px; left: 40%; margin-left: -300px; overflow-x: none; overflow-y: scroll; border: 1px solid blue;">
					<center>
						<table >
							<tr>
								<td class="rotulo">Curso: </td>
								<td>
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
								</td>
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
							
								<td class="rotulo">Professor: </td>
								<td>
								<select name="cod_professor" id="carrega_professor" class="campo" style="width: 250px;" onChange="carregaTabelaTurmaAluno(document.getElementById('carrega_disciplina').value ,this.value,'carrega_alunos_diciplina')">
										
							      </select>	
								</td>
							</tr>
				      </table>
					</center>
		</div>
		  <div class="lista_selecao" style="width: 730px; height:320px; top: 165px; left: 371px; margin-left: -365px; overflow-x: none; ">
		  	<div >
		    <table width="580" id="tabela-lista">
              <thead>
                <tr>
                  <th width="67" >Cod</th>
                  <th width="306" align="left">Aluno</th>
                  <th width="191" >Disciplina</th>
                </tr>
              </thead>
              <tbody  id="carrega_alunos_diciplina">
              </tbody>
            </table>
			<div id="pager" class="pager">
        <form>
                <span>
                    Exibir <select class="pagesize">
                            <option selected="selected"  value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option  value="40">40</option>
                    </select> registros
                </span>

                <img src="../img/first.png" class="first"/>
            <img src="../img/prev.png" class="prev"/>
            <input type="text" class="pagedisplay"/>
            <img src="../img/next.png" class="next"/>
            <img src="../img/last.png" class="last"/>
        </form>
    </div>
    
    		</div>
	    </div>
	  </div>	
	  <!-- INICIO DA DIV BOLETIM -->
	  <div style="position: absolute; height: 168px; width: 724px; overflow-x: none; overflow-y: scroll; border: 1px solid blue; overflow: visible; z-index: 1; left: 9px; top: 619px;" align="left">
	  <form name="Form_boletim" id="Form_boletim" style="width:700px" action="../boletim/scripts/objeto_boletim.php" >
		  <input id="acao" type="hidden" name="acao" value="insert_notas" >
  		  <input id="cod_curso" type="hidden" name="cod_curso" value="" >
  		  <input id="cod_turma" type="hidden" name="cod_turma" value="" >
  		  <input id="cod_disciplina" type="hidden" name="cod_disciplina" value="" >
  		  <input id="cod_professor" type="hidden" name="cod_professor" value="" >
    	 <label for="cod_aluno">Matricula:</label> <input id="cod_aluno" type="text" name="cod_aluno" style="width:70px" >
	    <label for="nome">Aluno: </label>
	    <input type="text" id="nome" name="nome" style="width:300px" disabled="disabled">
	    <br>
		<label>Nota 1: </label> <input type="text" name="nota_1" style="width:30px" >
		<label>Nota 2: </label>  <input type="text" name="nota_2" style="width:30px" >
		<label>Nota 3: </label>  <input type="text" name="nota_3" style="width:30px" >
		<label>Nota 4: </label>  <input type="text" name="nota_4" style="width:30px" >
		<label>Nota 5: </label>  <input type="text" name="nota_5" style="width:30px" >
		<label>Nota 6: </label>  <input type="text" name="nota_6" style="width:30px" >
		<label>Faltas: </label>  <input type="text" name="faltas" style="width:30px" >
		<br>
		<label>N. de avaliações: </label> 
		<select name="numero_avaliacoes">
		  <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		  <option value="5">5</option>
		  <option value="6">6</option>
		</select>
		<label>Unidade: </label>
		<select name="unidade">
		  <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="deletar" type="button" value="Deletar Notas">	
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="cadastrar" type="button" value="Cadastrar Notas" onClick="cadastraNotas()">
	  </form>		
	  <div id="retorno" style="font-weight:bold;color:#FF0000;">
	  aguarde
	  </div>
	  </div>	
	  <div id="lista_boletim">
	  
	  </div>	
</div>
	
</body>
</html>