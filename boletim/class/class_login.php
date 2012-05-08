<?php

	class Class_login{

		public $cod_usuario;
		public $nome;
		public $usuario;
		public $senha;
		public $atribuicao;
		public $referencia;
		public $cod_aluno_professor;
		public $cod_instituicao;
		public $area_login;

		public function logar($usuario,$senha,$referencia,$area_login){
			session_start();
			if ($area_login == "Alunos"){
				$where = "AND referencia = 1";
			}
			elseif($area_login != "Alunos" AND $referencia == 3){
				$where = "AND referencia = 4";
			}
			else{
				$where = "";
			}
			echo $where;
			if(isset($_SESSION['id_instituicao'])){
				$cod_instituicao = (int) $_SESSION['id_instituicao'];
			}
			else{
				$cod_instituicao = NULL;
			}
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query = mysql_query("SELECT cod_usuario, usuario.nome,  usuario_login, usuario_pass, usuario_atrib, referencia, cod_aluno_professor, pasta, instituicao.nome  FROM usuario, instituicao WHERE usuario_atrib = '$referencia' AND usuario_login = '$usuario' AND usuario.cod_instituicao = '$cod_instituicao' AND usuario.cod_instituicao = instituicao.cod_instituicao AND usuario_atrib < 6 $where") or die ("Erro em consultar usu�rio".mysql_error());
			// se a query retornar alguma linha ent�o fa�a
			if (mysql_num_rows($query)>0){
				// obtendo o resultado da query como um array com �ndices num�ricos come�ando do indice 0
				$result = mysql_fetch_row($query);
				// verificando se o valor da matriz no indice 2 � = a senha 
				if ($result[3]==$senha){
					$_SESSION['area_login'] = $area_login;
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
					$_SESSION['instituicao']= $result[8];
					$this->resultado = "ok";
				}
				else{
					$this->resultado = "nao";
				}
			}
			else{
				$this->resultado = "nao";
			}
		}
	}
	
?>
