<?php

	class Class_resposta{

		public $cod_resposta;
		public $numero;
		public $alternativa;
		public $resposta;
		public $comentario;
		public $cod_questao;
		public $session;

		public function insert_resposta($numero,$alternativa,$resposta,$comentario,$session,$cod_questao){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_select = mysql_query("SELECT cod_resposta FROM resposta WHERE numero = '$numero' AND session = '$session' AND alternativa = '$alternativa'") or die ("Erro select ". mysql_error());
			// verificando se a query retornou algum valor
			$quant = mysql_num_rows($query_select);
			// se retornou então envia a mensagem
			if ($quant > 0){
				if ($comentario != "")
					$query_update = mysql_query("UPDATE resposta SET comentario = '$comentario' WHERE alternativa = '$alternativa' AND numero = '$numero' AND session = '$session'") or die ("Erro update". mysql_errno());
				if ($resposta != "")
					$query_update = mysql_query("UPDATE resposta SET resposta = '$resposta' WHERE alternativa = '$alternativa' AND numero = '$numero' AND session = '$session'") or die ("Erro update". mysql_errno());
				$this->resultado = "update";
			}
			else{
				$query_insert = mysql_query("INSERT INTO resposta VALUE (NULL, '$numero','$alternativa','$resposta', '$comentario', '$cod_questao', '$session')") or die ("Erro insert1 ". mysql_erro());
				$this->resultado = "insert";
			}
		}

		public function insert_resposta_consulta($numero,$alternativa,$resposta,$comentario,$session,$cod_questao){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_select = mysql_query("SELECT cod_resposta FROM resposta WHERE numero = '$numero' AND cod_questao = '$cod_questao' AND alternativa = '$alternativa'") or die ("Erro select ". mysql_error());
			// verificando se a query retornou algum valor
			$quant = mysql_num_rows($query_select);
			// se retornou então envia a mensagem
			if ($quant > 0){
				if ($comentario != "")
					$query_update = mysql_query("UPDATE resposta SET comentario = '$comentario' WHERE alternativa = '$alternativa' AND numero = '$numero' AND cod_questao = '$cod_questao'") or die ("Erro update". mysql_errno());
				if ($resposta != "")
					$query_update = mysql_query("UPDATE resposta SET resposta = '$resposta' WHERE alternativa = '$alternativa' AND numero = '$numero' AND cod_questao = '$cod_questao'") or die ("Erro update". mysql_errno());
				$this->resultado = "update";
			}
			else{
				$query_insert = mysql_query("INSERT INTO resposta VALUE (NULL, '$numero','$alternativa','$resposta', '$comentario', '$cod_questao', '$session')") or die ("Erro insert1 ". mysql_erro());
				$this->resultado = "insert";
			}
		}

		public function update_resposta($nome,$cod_professor,$cod_curso,$cod_turma,$codigo){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_insert = mysql_query("UPDATE resposta SET nome = '$nome',  cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma' WHERE cod_resposta = '$codigo'") or die ("Erro update". mysql_errno());
			$this->resultado = "ok";
		}// fim do método
	}
	
?>
