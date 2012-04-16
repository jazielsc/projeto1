<?php

/*

define("NOME_SISTEMA", "NUCLEOBA");

define("URL_PAG_EXCECAO", "http://www.google.com.br/search?q=Aprendendo+a+programar");

define("URL_RAIZ", "http://www.f9action/sistemas/nucleoba/");

define("EMAIL_ADM", "leokapdesigner@hotmail.com");

define("EXIBIR_ERROS", false);

define("ENVIAR_EMAIL_ERRO", true);

define("ASSUNTO_ERRO", "Exce��o disparada no site do export");

define("MENSAGEM_ERRO_EXCECAO", "Infelizmente o sistema est&aacute; encontrando dificuldades para executar a solicita&ccedil;&atilde;o. O N&uacute;cleo Web ir&aacute; receber um relat&oacute;rio informando sobre esta dificuldade.<br /> <br />att, <br />".NOME_SISTEMA);

define("PATH_LOG_ERRO", $_SERVER['DOCUMENT_ROOT']."/sistemas/nucleoba/pag_erros/");

define("PATH_RAIZ", $_SERVER['DOCUMENT_ROOT']."/sistemas/nucleoba/");

require_once($_SERVER['DOCUMENT_ROOT']."/sistemas/nucleoba/scripts/classes/class_excecao.php");


if(!EXIBIR_ERROS)
	error_reporting(!E_ALL);
set_error_handler(array("Excecao", "erro"));


function in_arrayr($needle, $haystack) {
  foreach ($haystack as $v)//varre o array
  {
    if ($needle == $v) return true;//caso encontre o elemento procurado retorna true
    elseif (is_array($v)) {//caso o elemento dessa posi��o seja um array chama recursivamente outra instancia dessa fun��o
      if (in_arrayr($needle, $v) === true) return true;//caso a chamada recursiva enctorne o elemento retorna true tb.
    }
  }
  return false;
}

*/

	

//SE N�O TIVER VARI�VEIS REGISTRADAS
//RETORNA PARA A TELA DE LOGIN
if( (!isset($_SESSION['NomeUsuario'])) AND (!isset($_SESSION['passagem'])) )
   Header("Location: index.php");

// verificando se o User-Agent mudou   
if ($_SESSION['user_agent'] != $_SERVER['HTTP_USER_AGENT'])
	Header("Location: index.php");

// verificando se o ip mudou
if ($_SESSION['remote_addr'] != $_SERVER['REMOTE_ADDR'])
Header("Location: index.php");
   
   
?>
