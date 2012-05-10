<!-- Lembrar de colocar troca de banner caso esteja logado -->

<div>
	<img src="/img/banner_login.png" width=766 height=79 />
	<div id="dados_login">
		<table>
			<tr>
				<td style="color: red;">&Aacute;rea Restrita:</td>
				<td style="padding-left: 10px; color: red; font-size: 12;"><?echo $_SESSION['area_login'];?></td>
			</tr>
			<tr>
				<td>Instituio:</td>
				<td style="padding-left: 10px;"><?echo $_SESSION['instituicao'];?></td>
			</tr>
			<tr>
				<td>Usu&aacute;rio:</td>
				<td style="padding-left: 10px;"><?echo $_SESSION['NomeUsuario'];?></td>
			</tr>
		</table>
	</div>
	<!--<nav id="menu"> -->
		<div id="menu" >
			<!-- Start css3menu.com BODY section -->
<ul id="css3menu1" class="topmenu">
				<li id="css3menu1" class="topfirst"><a href="#">SISTEMA</a>
					<ul id="css3menu1">
						<li><a href="principal.php">&nbsp;&nbsp;&nbsp;INCIO</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;REQUISITOS</a></li>
						<li><a href="../partes/logout.php">&nbsp;&nbsp;&nbsp;SAIR DO SISTEMA</a></li>
					</ul>
				</li>
				<li class="topmenu"><a href="#">CADASTRO</a>
					<ul id="css3menu1">
						<li><a href="cadastro_instituicao.php">&nbsp;&nbsp;&nbsp;INSTITUI&Ccedil;&Atilde;O</a></li>
						<li><a href="cadastro_aluno.php">&nbsp;&nbsp;&nbsp;ALUNO</a></li>
						<li><a href="cadastro_professor.php">&nbsp;&nbsp;&nbsp;PROFESSOR</a></li>
						<li><a href="cadastro_curso.php">&nbsp;&nbsp;&nbsp;CURSO</a></li>
						<li><a href="cadastro_turma.php">&nbsp;&nbsp;&nbsp;TURMA</a></li>
						<li><a href="cadastro_disciplina.php">&nbsp;&nbsp;&nbsp;DISCIPLINA</a></li>
					</ul>
				</li>
				<li class="topmenu"><a href="#">LAN&Ccedil;AMENTO</a>
					<ul id="css3menu1">
						<li><a href="lancamento_notas.php">&nbsp;&nbsp;&nbsp;NOTAS/TURMAS</a></li>
						<li><a href="lancamento_notas2.php">&nbsp;&nbsp;&nbsp;NOTAS/ALUNOS</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;PROFESSOR/DISCIPLINA</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;HORÁRIO</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;DATA DE PROVA</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;PLANO DE AULA </a></li>
					</ul>
				</li>
				<li class="topmenu"><a href="#">CONSULTA</a>
					<ul id="css3menu1">
						<li><a href="consulta_aluno.php">&nbsp;&nbsp;&nbsp;ALUNOS </a></li>
						<li><a href="consulta_professor.php">&nbsp;&nbsp;&nbsp;PROFESSORES </a></li>
						<li><a href="consulta_curso.php">&nbsp;&nbsp;&nbsp;CURSO </a></li>
						<li><a href="consulta_turma.php">&nbsp;&nbsp;&nbsp;TURMA </a></li>
						<li><a href="consulta_disciplina.php">&nbsp;&nbsp;&nbsp;DISCIPLINA </a></li>
						<li><a href="boletim.php">&nbsp;&nbsp;&nbsp;BOLETIM </a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;TURMA/DISCIPLINA </a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;TURMA/ALUNO </a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;TURMA/HORRIO</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;TURMA/PROVA</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;DISCIPLINA/ALUNO</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;PROFESSOR/DISCIPLINA</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;PROFESSOR/HORRIO</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;ALUNO/DISCIPLINA</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;ALUNO/NOTA</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;FUNCIONRIO</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;PLANO DE AULA</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;INATIVOS</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;RANKING</a></li>
					</ul>
				</li>
				<li class="toplast"><a href="#">MENSAGEM</a>
					<ul id="css3menu1">
						<li><a href="#">&nbsp;&nbsp;&nbsp;ENVIAR MENSAGEM</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;CAIXA POSTAL</a></li>
					</ul>
				</li>
</ul>
<!-- End css3menu.com BODY section -->	
		</div>
<!--	</nav>-->
</div>