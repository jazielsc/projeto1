<?php 
session_start();
ob_start();

header("Content-Type: text/html; charset=utf-8",true);

if(!defined("kshjdhjshd1263a118")) 
{ 
define("kshjdhjshd1263a118","nada"); 
} 


require("scripts/conecta.php");
require("seguranca.php");

// vari�veis vindas do form
if (isset($_POST['usuario'])) 
$usuario = seguranca($_POST['usuario']);
// senha criptografada em md5
if (isset($_POST['senha']))	
$senha =  md5($_POST['senha']);

if (isset($_SESSION['id_instituicao']))
$cod_instituicao = (int) $_SESSION['id_instituicao'];
else
$cod_instituicao = 0;


	// consulta sobre as informa��es do usu�rio do sistema.
	
	$query = mysql_query("SELECT cod_usuario, usuario.nome,  usuario_login, usuario_pass, usuario_atrib, referencia, cod_aluno_professor, pasta  FROM usuario, instituicao WHERE usuario_login = '$usuario' AND usuario.cod_instituicao = 0 AND usuario.cod_instituicao = instituicao.cod_instituicao") or die ("Erro em consultar usu�rio".mysql_error());
	
	// se a query retornar alguma linha ent�o fa�a
	if (mysql_num_rows($query)>0) {
	
	// obtendo o resultado da query como um array com �ndices num�ricos come�ando do indice 0
		$result = mysql_fetch_row($query);
	// verificando se o valor da matriz no indice 2 � = a senha 
	
		if ($result[3]==$senha) {
			
		echo "&mensagem=ok";	
			
		
		// regenerando a sessao por motivo de seguran�a
			session_regenerate_id();
             
			 // verificando o agente 
			$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
			// verificando ip
			$_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'];
		
			//Resgistrar variaveis
						
			$_SESSION['NomeUsuario']= $result[1];
			$_SESSION['passagem']= "kjsadjksjdksjdksj12";
          
		    $_SESSION['permissao']= (int) $result[4]; 
			$_SESSION['id_usuario'] = (int) $result[0];

                        $_SESSION['id_referencia']= (int) $result[5];
			
			$_SESSION['id_aluno_professor']= (int) $result[6];

                        $_SESSION['pasta']= $result[7];
			
		    //delete_old_session(); php5
			
 			// se tudo ok direciona para a tela inicial do sistema
			
			Header("Location: principal.php");
			
          // se o login ou a senha tiverem sido digitadas erradas direciona para tela de login.
			
		}else{
			$mensagem = "usuário ou senha inválida!";
			require("login.php");
                    
                       }
	}else {
		$mensagem = "usuário ou senha inválida!";
		require("login.php");
            
                }

               

?>
