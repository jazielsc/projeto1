<?php

	class Class_questao{

		public $cod_questao;
		public $numero;
		public $peso;
		public $pergunta; 
		public $resposta;
		public $cod_avaliaçao;
		public $session;
		public $tipo;

		public function insert_questao($numero,$peso,$pergunta,$resposta,$cod_avaliacao,$session,$tipo){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_select = mysql_query("SELECT cod_questao FROM questao WHERE numero = '$numero' AND session = '$session'") or die ("Erro select ". mysql_error());
			// verificando se a query retornou algum valor
			$quant = mysql_num_rows($query_select);
			// se retornou então envia a mensagem
			if ($quant > 0){
				if ($tipo != ""){
					$query_update = mysql_query("UPDATE questao SET tipo = '$tipo' WHERE numero = '$numero' AND session = '$session'") or die ("Erro update". mysql_errno());
					if ($peso != ""){
						$query_update = mysql_query("UPDATE questao SET peso = '$peso' WHERE numero = '$numero' AND session = '$session'") or die ("Erro update". mysql_errno());
					}
					if ($pergunta != ""){
						$query_update = mysql_query("UPDATE questao SET pergunta = '$pergunta' WHERE numero = '$numero' AND session = '$session'") or die ("Erro update". mysql_errno());
					}
					if ($resposta != ""){
						$query_update = mysql_query("UPDATE questao SET resposta = '$resposta' WHERE numero = '$numero' AND session = '$session'") or die ("Erro update". mysql_errno());
					}
					$this->resultado = "update";
				}
				else{
					$query_insert = mysql_query("INSERT INTO questao VALUE (NULL, '$numero','$peso','$pergunta','$resposta', '$cod_avaliacao', '$session','$tipo')") or die ("Erro insert1 ". mysql_erro());
					$this->resultado = "insert";
				}
			}
		}

		public function insert_questao_consulta($numero,$peso,$pergunta,$resposta,$cod_avaliacao,$session,$tipo){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_select = mysql_query("SELECT cod_questao FROM questao WHERE numero = '$numero' AND cod_avaliacao = '$cod_avaliacao'") or die ("Erro select ". mysql_error());
			// verificando se a query retornou algum valor
			$quant = mysql_num_rows($query_select);
			// se retornou então envia a mensagem
			if ($quant > 0){
				if ($tipo != "")
					$query_update = mysql_query("UPDATE questao SET tipo = '$tipo' WHERE numero = '$numero' AND cod_avaliacao = '$cod_avaliacao'") or die ("Erro update". mysql_errno());
				if ($peso != "")
					$query_update = mysql_query("UPDATE questao SET peso = '$peso' WHERE numero = '$numero' AND cod_avaliacao = '$cod_avaliacao'") or die ("Erro update". mysql_errno());
				if ($pergunta != "")
					$query_update = mysql_query("UPDATE questao SET pergunta = '$pergunta' WHERE numero = '$numero' AND cod_avaliacao = '$cod_avaliacao'") or die ("Erro update". mysql_errno());
				if ($resposta != "")
					$query_update = mysql_query("UPDATE questao SET resposta = '$resposta' WHERE numero = '$numero' AND cod_avaliacao = '$cod_avaliacao'") or die ("Erro update". mysql_errno());
				$this->resultado = "update";
			}
			else{
				$query_insert = mysql_query("INSERT INTO questao VALUE (NULL, '$numero','$peso','$pergunta','$resposta', '$cod_avaliacao', 0,'$tipo')") or die ("Erro insert1 ". mysql_erro());
				$this->resultado = "insert";
			}
		}

		public function insert_banco_questao($peso,$pergunta,$resposta,$cod_avaliacao,$session,$tipo,$referencia){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_numero = mysql_query("SELECT COUNT(numero) FROM questao WHERE session = '$session'AND cod_avaliacao = 0") or die ("ERRO 1 select" . mysql_error());
			$resultado = mysql_fetch_array($query_numero);
			$numero = $resultado[0] + 1;
			$query_insert = mysql_query("INSERT INTO questao VALUE (NULL, '$numero','$peso','$pergunta','$resposta', 0, '$session', '$tipo')") or die ("Erro insert1 ". mysql_erro());
			$query_select = mysql_query("SELECT alternativa, resposta, comentario FROM resposta WHERE numero = '$referencia' AND cod_questao = '$cod_avaliacao'") or die ("Erro select ". mysql_error());
			$i = 0;
			while($result = mysql_fetch_array($query_select)){
				$alternativa = $result[0];
				$resposta = $result[1];
				$comentario = $result[2];
				$query_insert = mysql_query("INSERT INTO resposta VALUE (NULL, '$numero','$alternativa','$resposta', '$comentario', 0, '$session')") or die ("Erro insert1 ". mysql_erro());
				$i++;
			}
			$this->resultado = "OK";
		}
		
		public function update_questao($nome,$cod_professor,$cod_curso,$cod_turma,$codigo){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_insert = mysql_query("UPDATE questao SET nome = '$nome',  cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma' WHERE cod_questao = '$codigo'") or die ("Erro update". mysql_errno());
			$this->resultado = "ok";
		}
	}
?>
