<title>Brasil FlexSys - Fale Conosco/Contatos</title>
<?
//pega as variaveis por POST
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$assunto         = $_POST["assunto"];
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////// Código de Autenticação Host Net
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$nome               = $_POST["nome"];
$cidade             = $_POST["cidade"];
$estado             = $_POST["estado"];
$email              = $_POST["email"];
$telefone           = $_POST["telefone"];
$msg                = $_POST["msg"];
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
global $email; //função para validar a variável $email no script todo
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$data      = date("d/m/y");                     //função para pegar a data de envio do e-mail
$ip        = $_SERVER['REMOTE_ADDR'];           //função para pegar o ip do usuário
$navegador = $_SERVER['HTTP_USER_AGENT'];       //função para pegar o navegador do visitante
$hora      = date("H:i");                       //para pegar a hora com a função date
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//aqui envia o e-mail para você

$para = "equipe@brasilflexsys.com.br";
$emailsender = "equipe@brasilflexsys.com.br";

$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: brasilflexsys <equipe@brasilflexsys.com.br\n";
$headers .= "Return-Path: brasilflexsys <equipe@brasilflexsys.com.br>";

	  $mensagem = "Nome: $nome \n";
	   $mensagem .= "Cidade: $cidade \n";
	   $mensagem .= "Estado: $estado \n";
	   $mensagem .= "Email: $email \n";
	   $mensagem .= "Telefone: $telefone \n";
	   $mensagem .= "Mensagem: $msg \n";
	   $mensagem .= "Data: $data \nIp: $ip \n";
	   $mensagem .= "Navegador: $navegador \n";
	   $mensagem .= "Hora: $hora";

mail($para, $assunto, $mensagem, $headers,"-r".$emailsender) or die ("ERRO ao enviar mensagem!");


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//aqui são as configurações para enviar o e-mail para o visitante
$site   = "www.brasilflexsys.com.br";    //o e-mail que aparecerá na caixa postal do visitante
$titulo = "Contatos - Fala Conosco";    //titulo da mensagem enviada para o visitante
$msg    = "Sucesso no seu contato, obrigado pela a sua visita e pela mensagem... \nEstaremos reconfirmando em breve. \nVisite agora mesmo o nosso site: \nhttp://www.brasilflexsys.com.br";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//aqui envia o e-mail de auto-resposta para o visitante
mail($email,$titulo,$msg,$headers,"-r".$emailsender)or die ("ERRO ao enviar mensagem!");
    
?>
