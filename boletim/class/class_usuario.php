<?php

class Class_usuario {

     public $cod_usuario;
     public $nome;
     public $login;
     public $senha;
     public $atribuicao;
     public $referencia;
     public $cod_aluno_professor;
     public $cod_instituicao;
     
              
	public function insert_usuario($nome,$login,$senha,$atribuicao,$referencia,$cod_aluno_professor) {
		session_start();
		$cod_instituicao = (int) $_SESSION['id_instituicao'];
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
		$query_select = mysql_query("SELECT cod_usuario FROM usuario WHERE cod_instituicao = '$cod_instituicao' AND usuario_login = '$login' ") or die ("Erro select ". mysql_errno());
		$quant = mysql_num_rows($query_select);
		if ($quant > 0){
			return 500;
		}
		else {
			$query_insert = mysql_query("INSERT INTO usuario VALUE (NULL, '$nome','$login','$senha','$atribuicao','$referencia','$cod_aluno_professor','$cod_instituicao')") or die ("Erro insert ". mysql_errno());
			return 0;
		}
     }

	public function update_usuario($login,$senha,$atribuicao,$referencia,$cod_aluno_professor,$nome_usuario,$codigo) {
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");        
		$query_insert = mysql_query("UPDATE usuario SET nome = '$nome_usuario',  usuario_login = '$login', usuario_atrib = '$atribuicao', referencia = '$referencia', cod_aluno_professor = '$cod_aluno_professor' WHERE cod_usuario = '$codigo'") or die ("Erro update". mysql_errno());
		return 1;
	}
}

?>
