<?php

	session_start();
	ob_start();	
	
	require("boletim/scripts/conecta.php");
	require("boletim/seguranca.php");
	
	if(!isset($_POST['usuario']) || !isset($_POST['senha'])){
		$_SESSION['login'] = false;
		header("Location: /index.php");	
	}

	$usuario = seguranca($_POST['usuario']);
	$senha =  md5($_POST['senha']);
	$referencia = seguranca($_POST['referencia']);
	
	$sql = "SELECT usuario.usuario_pass, usuario.nome, usuario.usuario_atrib, usuario.cod_usuario, usuario.referencia, usuario.cod_aluno_professor, instituicao.nome, usuario.cod_instituicao, mantenedora.cod_mantenedora FROM usuario, instituicao, mantenedora WHERE usuario_atrib = '$referencia' AND usuario_login = '$usuario' AND usuario.cod_instituicao = instituicao.cod_instituicao AND instituicao.cod_mantenedora = mantenedora.cod_mantenedora";
	echo "$sql";
	$consulta = mysql_query($sql);
	
	// Se retornou algum resultado
	if (mysql_num_rows($consulta) > 0){
		$resultado = mysql_fetch_row($consulta);
		if($resultado[0] == $senha){
			session_regenerate_id();
			$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
			$_SESSION['remote_addr'] = $_SERVER['REMOTE_ADDR'];
			// Verificando a area de login
			switch($referencia){
				case 1: $_SESSION['area_login'] = "DIRECAO"; break;
				case 2: $_SESSION['area_login'] = "SECRETARIA"; break;
				case 3: $_SESSION['area_login'] = "ALUNOS"; break;
				case 4: $_SESSION['area_login'] = "PROFESSORES"; break;
			}
			$_SESSION['NomeUsuario']= $resultado[1];
		    $_SESSION['permissao']= (int) $resultado[2]; 
			$_SESSION['id_usuario'] = (int) $resultado[3];
			$_SESSION['id_referencia']= (int) $resultado[4];
			$_SESSION['id_aluno_professor']= (int) $resultado[5];
			$_SESSION['instituicao']= $resultado[6];				
			$_SESSION['id_instituicao'] = (int) $resultado[7];
			$_SESSION['id_mantenedora'] = (int) $resultado[8];
			$_SESSION['login'] = true;			
			header("Location: /paginas/principal.php");
		}
		else{
			$_SESSION['login'] = false;
			header("Location: /index.php");
		}
	}
	else{
		$_SESSION['login'] = false;
		header("Location: /index.php");
	}
	