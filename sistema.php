<?php 
	session_start();
	ob_start();

	header("Content-Type: text/html; charset=utf-8",true);

	if(!defined("kshjdhjshd1263a118")){ 
		define("kshjdhjshd1263a118","nada"); 
	} 
	
	require("boletim/scripts/conecta.php");
	require("boletim/seguranca.php");

	if (isset($_POST['usuario'])){
		$usuario = seguranca($_POST['usuario']);
	}
	// senha criptografada em md5
	if (isset($_POST['senha'])){
		$senha =  md5($_POST['senha']);
	}
	if (isset($_POST['instituicao'])){
		$instituicao = seguranca($_POST['instituicao']);
	}else{
		$instituicao = 0;
	}

	if(isset($_POST['area_login'])){
		$area_login = seguranca($_POST['area_login']);
	}

	if(isset($_POST['referencia'])){
		$referencia = seguranca($_POST['referencia']);
	}

	$query_pasta = mysql_query("SELECT cod_instituicao FROM instituicao WHERE pasta = '$instituicao'") or die ("Erro em consultar instituicao".mysql_error());
	$resultado = mysql_fetch_row($query_pasta);
	$query = mysql_query("SELECT cod_usuario, usuario.nome, usuario_login, usuario_pass, usuario_atrib, referencia, cod_aluno_professor, pasta, instituicao.nome FROM usuario, instituicao WHERE usuario_atrib = '$referencia' AND usuario_login = '$usuario' AND usuario.cod_instituicao = '$resultado[0]' AND usuario.cod_instituicao = instituicao.cod_instituicao AND usuario_atrib < 6") or die ("Erro em consultar usuario".mysql_error());
	
	if (mysql_num_rows($query)>0){
	
		$result = mysql_fetch_row($query);
		if ($result[3]==$senha){	
			session_regenerate_id();
			$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
			$_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'];

			/*$_SESSION['area_login'] = $area_login;*/
			switch($referencia){
				case 1: $_SESSION['area_login'] = "DIREÇÃO"; break;
				case 2: $_SESSION['area_login'] = "SECRETÁRIA"; break;
				case 3: $_SESSION['area_login'] = "ALUNOS"; break;
				case 4: $_SESSION['area_login'] = "PROFESSORES"; break;
			}
			$_SESSION['NomeUsuario']= $result[1];
			$_SESSION['passagem']= "kjsadjksjdksjdksj12";         
		    $_SESSION['permissao']= (int) $result[4]; 
			$_SESSION['id_usuario'] = (int) $result[0];
			$_SESSION['id_referencia']= (int) $result[5];
			$_SESSION['id_aluno_professor']= (int) $result[6];
			$_SESSION['pasta']= $result[7];
			$_SESSION['instituicao']= $result[8];				
			$_SESSION['id_instituicao'] = $resultado[0];
			$_SESSION['login'] = true;

			header("Location: /paginas/principal.php");
		}else{
			$_SESSION['login'] = false;
			header("Location: /index.php");
		}
	}else{
		$_SESSION['login'] = false;
		header("Location: /index.php");
	}               
?>

