<?php 
include('app\config.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo TITLE ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="app/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="app/js/jquery.form.js"></script>
<script type="text/javascript" src="app/js/global.js"></script>
</head>

<body>
<div class="envolve" align="center">
	<div id="corpo" align="left">
		<div id="login_topo">
		<!--outro logo entra aki-->
		</div>
		<div id="form_login">
		<form id="FormLogin" name="FrmLogin" action="sistema.php" method="post">
		<table id="tabela_login" vspace="0">
				<tr valign="bottom">
				  <td rowspan="6" width="116" valign="bottom">
					<span class="style5">
					<input type="hidden" name="acao" value="logar">
					</span>
					<span class="style5">
					<input name="referencia" type="radio" value="1" checked="checked" >
					Direção<br>
					<input name="referencia" type="radio" value="2">
					Secretaria<br>
					<input name="referencia" type="radio" value="3">
					Professores<br>				
					<input name="referencia" type="radio" value="4">
					Alunos<br>
					<input name="referencia" type="radio" value="5">
					Responsáveis					</span></span></td>	
				</tr>	
				<tr height="15">
					<td  width="72">
					<span class="label">Instituição:</span>					</td>
					<td width="159" class="campos">
						<input width="140" type="text" name="instituicao">
				  </td>
				</tr>
				<tr>
					<td class="label" width="72">
					Login:					</td>
					<td width="159">
						<input width="140" type="text" name="usuario">
				  </td>
				</tr>
				<tr>
					<td class="label" width="72">
					Senha:					</td>
					<td width="159" height="20px">
						<span width="100px">
					  <input style="display:inline;width:100px;" type="password" name="senha" width="100px"></span>
						<input style="display:inline" type="submit" value="ok">
				  </td>
				</tr>
			<tr>
				<td colspan="2"><a href="" style="font-size:9px;">Esqueci a senha</a></td>
			</tr>
			<tr>
				<td  colspan="2" ><div id="retorno"></div></td>
			</tr>
			</table>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
        /* SCRIPT AJAX PARA REGISTRO DE PRODUTO*/
	$(document).ready(function(){
            $('form#FormLogin').submit(
	function(){
		$.blockUI({message: 'Efetuando o Login, aguarde...'});
        $.post(
			$("form#FormLogin").attr('action'),
			$("form#FormLogin").serialize(),
			function(retorno){
				if(retorno.indexOf('ok')!=-1){
					$.blockUI({message: 'Login Efetuado com sucesso!<br>Você esta sendo redirecionado, aguarde...'});
					setTimeout("window.location='boletim/index.php'", 100);
					$("div#retorno").hide();
				}else{
					$("div#retorno").html('<' + 'label class="mensagem_erro" for="nome" generated="true"' + '>' + 'Login ou Senha inválidos;' + '</' + 'label' + '>');
					$("div#retorno").show();
					$.unblockUI();
				}
			}
		);
		/* fim do submit */
        return false;
    }
);

            $("form#FormLogin").keydown(function(event){

			var key = event.keyCode;

			if(key==13){

				$("form#FormLogin").submit();

			}

		});

        });



</script>
</body>
</html>
