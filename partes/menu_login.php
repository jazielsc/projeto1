<!-- Lembrar de colocar troca de banner caso esteja logado -->
<div>
	<img src="../img/banner_login.png" width=766 height=79 />
	<div id="dados_login">
		<table>
			<tr>
				<td style="color: red;">Area Restrita:</td>
				<td style="padding-left: 10px; color: red; font-size: 12;"><?php echo $_SESSION['area_login'];?></td>
			</tr>
			<tr>
				<td>Instituição:</td>
				<td style="padding-left: 10px;"><?php echo $_SESSION['instituicao'];?></td>
			</tr>
			<tr>
				<td>Usurio:</td>
				<td style="padding-left: 10px;"><?php echo $_SESSION['NomeUsuario'];?></td>
			</tr>
		</table>
	</div>
	<nav id="menu">
		<div id="menu">
			<ul>
				<li><a href="/paginas/principal.php">INCIO</a></li>
				<li><a href="#">CADASTRO</a>
					<ul>
						<li><a href="paginas/cadastro_aluno.php">&nbsp;&nbsp;&nbsp;ALUNO</a></li>
						<li><a href="paginas/cadastro_professor.php">&nbsp;&nbsp;&nbsp;PROFESSOR</a></li>
						<li><a href="paginas/cadastro_curso.php">&nbsp;&nbsp;&nbsp;CURSO</a></li>
						<li><a href="paginas/cadastro_turma.php">&nbsp;&nbsp;&nbsp;TURMA</a></li>
						<li><a href="paginas/cadastro_disciplina.php">&nbsp;&nbsp;&nbsp;DISCIPLINA</a></li>
						<li><a href="paginas/cadastro_funcionario.php">&nbsp;&nbsp;&nbsp;FUNCIONRIO</a></li>
					</ul>
				</li>
				<li><a href="#">LANAMENTO</a>
					<ul>
						<li><a href="lancamento_notas.php">&nbsp;&nbsp;&nbsp;NOTAS/TURMAS</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;NOTAS/ALUNOS</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;PROFESSOR/DISCIPLINA</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;HORRIO</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;DATA DE PROVA</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;PLANO DE AULA </a></li>
					</ul>
				</li>
				<li><a href="#">RELATRIO</a>
					<ul>
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
				<li><a href="#">MEU ESPAO</a>
					<ul>
						<li><a href="#">&nbsp;&nbsp;&nbsp;EDITAR ACESSO</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;CONFIGURAO</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;ENVIAR MENSAGEM</a></li>
						<li><a href="#">&nbsp;&nbsp;&nbsp;CAIXA POSTAL</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</div>