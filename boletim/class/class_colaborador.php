<?php

	class Class_colaborador{

	public $cod_colaborador;
	public $nome;
	public $email;
	public $cod_cidade;
	public $cod_bairro;
	public $cod_rua;
	public $complemento;
	public $numero;
	public $cod_uf;
	public $telefone;
	public $celular;
	public $cod_status;
	public $resultado;
	public $cod_instituicao;
	public $cep;
	public $login;
	public $senha;
          
	public function insert_colaborador($nome,$email,$cod_cidade,$cod_bairro,$cod_rua,$complemento,$numero,$cod_uf,$telefone,$celular,$cod_status,$cod_instituicao,$cep){
		session_start();
		$instituicao = $_SESSION['instituicao'];
		$pasta = $_SESSION['pasta'];
		$cod_instituicao = (int) $_SESSION['id_instituicao'];
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
		$query_select = mysql_query("SELECT cod_colaborador FROM colaborador WHERE email = '$email'") or die ("Erro select ". mysql_errno());
		$query_select2 = mysql_query("SELECT cod_usuario FROM usuario WHERE email = '$email'") or die ("Erro select ". mysql_errno());
		$quant = mysql_num_rows($query_select);
		$quant2 = mysql_num_rows($query_select2);
		if ($quant > 0 or $quant2 > 0){
			$this->resultado = "NAO";
		}
		else{
			$query_insert = mysql_query("INSERT INTO colaborador VALUE (NULL, '$nome','$email','$cod_cidade','$cod_bairro','$cod_rua','$complemento','$numero','$cod_uf','$telefone','$celular',$cod_status', '$cod_instituicao','$cep')") or die ("Erro insert ". mysql_errno());
			$query_grid = mysql_query("SELECT cod_professor, professor.nome, cidade_nome , telefone FROM professor, cidade WHERE professor.cod_cidade = cidade_id AND cod_instituicao = '$cod_instituicao' AND cod_status = 1 ORDER BY professor.nome",$conn) or die ("Error na consulta");
			$i = 0;
			while ($result = mysql_fetch_array($query_grid)){ // retornando os valores da consulta em array e enviando para o flash
				echo "&codigo$i=$result[0]";
				echo "&nome$i=$result[1]";
				echo "&cidade$i=$result[2]";
				echo "&telefone$i=$result[3]";
				$i++;
			}
			$query_consulta = mysql_query("SELECT cod_professor FROM professor WHERE cod_instituicao = '$cod_instituicao' ORDER BY  cod_professor DESC LIMIT 1",$conn) or die ("Error na consulta");
			$resultado = mysql_fetch_array($query_consulta);
			$senha =  md5($pasta."123");
			$query_insert = mysql_query("INSERT INTO usuario VALUE (NULL, '$nome','$email','$senha',4,2,$resultado[0],'$cod_instituicao','$email')") or die ("Erro insert ". mysql_error());
			$para = $email;
			$emailsender = "equipe@boletimflex.com";
			$area = "Professores";
			$str[0] = utf8_decode("Olá");
			$str[1] = utf8_decode("Instituição");
			$str[2] = utf8_decode("Área Restrita");
			$assunto = "Cadastro Boletimflex!";
			$headers = "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\n";
			$headers .= "From: boletimflex <equipe@boletimflex.com>\n";
			$headers .= "Return-Path: boletimflex <equipe@boletimflex.com>";
			$mensagem = "$str[0]!, $nome. <br /> <br />";
			$mensagem .= "Voce foi cadastrado pela $str[1] $instituicao no sistema boletimflex, abaixo segue seus dados de acesso! <br /> <br />";
			$mensagem .= "<a href=\"http://www.boletimflex.com/boletim/$pasta\">http://www.boletimflex.com/boletim/$pasta</a><br /> <br />";
			$mensagem .= "$str[2]: $area. <br />";
			$mensagem .= "login: " .$email. "<br />";
			$mensagem .= "senha: " .$pasta."123";
			mail($para, $assunto, $mensagem, $headers,"-r".$emailsender) or die ("ERRO ao enviar mensagem!");
			$this->resultado = "ok";
		}
	}

	public function update_professor($nome,$email,$cod_cidade,$cod_bairro,$cod_rua,$complemento,$numero,$cod_uf,$telefone,$cod_status,$cod_professor,$cod_instituicao,$cep){
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
		if($cod_status > 1){
			$query_update = mysql_query("UPDATE usuario SET usuario_atrib = 6 WHERE cod_aluno_professor = '$cod_professor' AND referencia = 2") or die("ERRO!");
		}
		elseif($cod_status == 1){
			$query_update = mysql_query("UPDATE usuario SET usuario_atrib = 4 WHERE cod_aluno_professor = '$cod_professor' AND referencia = 2") or die("ERRO!");
		}
		$query_insert = mysql_query("UPDATE professor SET nome = '$nome', email = '$email', cod_cidade = '$cod_cidade', cod_bairro = '$cod_bairro', cod_rua = '$cod_rua', complemento = '$complemento', numero = '$numero', cod_uf = '$cod_uf', telefone = '$telefone', cod_status = '$cod_status', cod_instituicao = '$cod_instituicao', cep = '$cep' WHERE cod_professor = '$cod_professor'") or die ("Erro insert ". mysql_errno());
		$this->resultado = "ok";
	}
}
?>
