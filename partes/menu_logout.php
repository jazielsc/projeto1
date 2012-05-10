<div>
	<img src="/img/banner_logout.png" width=766 height=195 />
	<div id="tela_login">
		<form action="sistema.php" method="POST">
			<input type="radio" disabled="disabled" name="referencia" value=0>Mantenedora</input><br>
			<input type="radio" name="referencia" value=1 checked>Dire&ccedil;&atilde;o/SE</input><br>
			<input type="radio" disabled="disabled" name="referencia" value=2>Secret&aacute;ria</input><br>
			<input type="radio" disabled="disabled" name="referencia" value=3>Professores</input><br>
			<input type="radio" disabled="disabled" name="referencia" value=4>Alunos</input><br>
			<div id="campos_login">
				<table>
					<tr>
						<td>Usu&aacute;rio:</td>
						<td><input type="text" name="usuario"></td>
					</tr>
					<tr>
						<td>Senha:</td>
						<td><input type="password" name="senha"></td>
					</tr>
					<tr>
						<td><a style="color: red; font-size: 9px;"><?php
						if(isset($_REQUEST['msg'])){					
							$msg = $_REQUEST['msg'];
							if($msg==1) 
								echo "Login inválido!";
							elseif($msg==2) 
								echo "Senha inválida!";	
						}
						?></a></td>
						<td>
							<br>
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