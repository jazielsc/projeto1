<?php

class Class_avaliacao{

	public $cod_avaliacao;
	public $nome;
	public $cod_professor; // session
	public $cod_curso;
	public $cod_turma;
	public $cod_disciplina;
	public $valor;
	public $minima;
	public $session;
	public $envia_email;

	public function insert_avaliacao($nome,$cod_professor,$cod_curso,$cod_turma,$cod_disciplina,$valor,$session,$minima,$envia_email){
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
		$query_grid = mysql_query("SELECT SUM(peso) FROM questao WHERE session = '$session'") or die ("Error na consulta" .mysql_error());
		$soma = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash
		echo "&soma=$soma[0]";
		$this->resultado = "nao confere";
		if ($valor == $soma[0]){
			$query_select = mysql_query("SELECT cod_avaliacao FROM avaliacao WHERE nome = '$nome' AND cod_professor = '$cod_professor' AND cod_curso = '$cod_curso' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());
			$quant = mysql_num_rows($query_select);
			if ($quant > 0){
				$this->resultado = "NAO"; 
			}
			else {
				$query_insert = mysql_query("INSERT INTO avaliacao VALUE (NULL, '$nome','$cod_professor','$cod_curso','$cod_turma', '$cod_disciplina', '$valor', '$minima', '$session')") or die ("Erro insert1 ". mysql_erro());
				$query_avaliacao = mysql_query("SELECT cod_avaliacao FROM avaliacao WHERE cod_professor = '$cod_professor' ORDER BY cod_avaliacao DESC LIMIT 0,1");
				$ultima_avaliacao = mysql_fetch_array($query_avaliacao);
				$query_update = mysql_query("UPDATE questao SET session = 0, cod_avaliacao = '$ultima_avaliacao[0]'  WHERE session = '$session'") or die ("Erro update". mysql_errno());
				$query_update = mysql_query("UPDATE resposta SET session = 0, cod_questao = '$ultima_avaliacao[0]'  WHERE session = '$session'") or die ("Erro update". mysql_errno());
				$this->resultado = "ok";
				if ($envia_email == "SIM"){
					$query_grid = mysql_query("SELECT aluno.nome, aluno.email, disciplina.nome, instituicao.pasta  FROM aluno, disciplina, item2, instituicao WHERE aluno.cod_instituicao = instituicao.cod_instituicao AND item2.cod_aluno = aluno.cod_aluno AND item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_disciplina = '$cod_disciplina' ORDER BY aluno.nome",$conn) or die ("Error na consulta");
					while ($result = mysql_fetch_array($query_grid)){
						$nome=$result[0];
						$email=$result[1];
						$disciplina=$result[2];
						$pasta = $result[3];
						$para2 = $email;
						$assunto2 = "Avaliação 0n-line Boletim Flex";

						$headers2 = "MIME-Version: 1.1\r\n";
						$headers2 .= "Content-type: text/plain; charset=iso-8859-1\r\n";
						$headers2 .= "From: contato@inforcloud.com.br\r\n";
						$headers2 .= "Return-Path: contato@inforcloud.com.br\r\n";

						$mensagem = "olá " .$nome.", foi cadastrado no sistema Boletim Flex, uma nova avaliação para voce \r\n";
						$mensagem .= "Disciplina: " .$disciplina. "\r\n";
						$mensagem .= "Entre e confira agora mesmo  www.inforcloud.com.br/boletim/".$pasta."/ \r\n";
						/* Enviando a mensagem */
						$envio = mail($para2, $assunto2, $mensagem, $headers2) or die ("ERRO ao enviar mensagem!");
						if($envio){
							echo "&mensagemenvio=OK";
							echo $para2;
						}
						else {
							echo "A mensagem não pode ser enviada";
						}
					}
				}
			}
		}
	}

	public function update_avaliacao($nome,$cod_professor,$cod_curso,$cod_turma,$cod_disciplina,$valor,$session,$minima,$cod_avaliacao){
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
		$query_grid = mysql_query("SELECT SUM(peso) FROM questao WHERE cod_avaliacao = '$cod_avaliacao'") or die ("Error na consulta" .mysql_error());
		$soma = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash
		echo "&soma=$soma[0]";
		$this->resultado = "nao confere";
		if ($valor == $soma[0]){
			$query_insert = mysql_query("UPDATE avaliacao SET nome = '$nome', cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma', cod_disciplina =  '$cod_disciplina', valor =  '$valor', minima =  '$minima' WHERE cod_avaliacao = '$cod_avaliacao'") or die ("Erro update ". mysql_error());
			$this->resultado = "ok";
		}
	}

	public function delete_avaliacao($cod_avaliacao) {
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
		$delete = mysql_query("DELETE FROM avaliacao WHERE cod_avaliacao = '$cod_avaliacao'") or die ("Erro delete!" . mysql_error());
		$delete = mysql_query("DELETE FROM avaliacao WHERE cod_avaliacao = '$cod_avaliacao'") or die ("Erro delete!" . mysql_error());
		$this->resultado = "ok";
	}
}

?>
