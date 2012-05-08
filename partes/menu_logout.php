<div>
	<img src="/img/banner_logout.png" width=766 height=195 />
	<div id="tela_login">
		<form action="sistema.php" method="POST">
			<input type="radio" name="referencia" value=1 checked>Direção/SE</input><br>
			<input type="radio" disabled="disabled" name="referencia" value=2>Secretária</input><br>
			<input type="radio" disabled="disabled" name="referencia" value=4>Professores</input><br>
			<input type="radio" disabled="disabled" name="referencia" value=3>Alunos</input><br>
			<input type="radio" disabled="disabled" name="referencia" value=5>Responsáveis</input>
			<div id="campos_login">
				<table>
					<tr>
						<td>Instituição:</td>
						<td><input type="text" name="instituicao"></td>
					</tr>
					<tr>
						<td>Usuário:</td>
						<td><input type="text" name="usuario"></td>
					</tr>
					<tr>
						<td>Senha:</td>
						<td><input type="password" name="senha"></td>
					</tr>
					<tr>
						<td><a style="color: red; font-size: 9;"><?if(isset($_SESSION['login']) && ($_SESSION['login'] == false)) echo "Login inválido!";?></a></td>
						<td>
							<center>
								<input type="submit" value="OK" style="background-color: gray; width: 70px;"><input type="reset" value="Limpar" style="background-color: gray; width: 70px;">
							</center>
						</td>
					</tr>
				</table>
			</div>
		</form>
	</div>
</div>