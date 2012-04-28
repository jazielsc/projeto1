<?php 
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
	</head>
<body>
	<div class="corpo">
	  <?php  require_once('../partes/menu_login.php');?>
	  <div class="conteudo">
			<div class="titulo">
				<img src="../img/Bandeira_lancaentos_notas.png" />			</div>
			<br><br><br><br><br>
		  <div style="position: relative; height: 70px; width: 700px; left: 40%; margin-left: -300px; overflow-x: none; overflow-y: scroll; border: 1px solid blue;">
					<center>
						<table >
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
	  <div style="position: absolute; height: 73px; width: 724px; overflow-x: none; overflow-y: scroll; border: 1px solid blue; overflow: visible; z-index: 1; left: 9px; top: 619px;">
	  <form name="Form_booletim">
	  </form>			
	  </div>		
</div>
	
</body>
</html>