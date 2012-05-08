<?php

	class Class_prova{
		public $cod_prova;
		public $numero;
		public $resposta;
		public $cod_avaliaçao;
		public $cod_aluno;
		public $session;
		public $cod_resultado;
		public $data;
		public $tempo;
		public $nota;

		public function insert_prova($numero,$resposta,$cod_avaliacao,$session,$cod_aluno){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_select = mysql_query("SELECT cod_prova FROM prova WHERE numero = '$numero' AND session = '$session' AND cod_avaliacao = '$cod_avaliacao'") or die ("Erro select ". mysql_error());
			// verificando se a query retornou algum valor
			$quant = mysql_num_rows($query_select);
			// se retornou então envia a mensagem
			if ($quant > 0){
				if ($resposta != ""){
					$query_update = mysql_query("UPDATE prova SET resposta = '$resposta' WHERE numero = '$numero' AND session = '$session' AND cod_avaliacao = '$cod_avaliacao'") or die ("Erro update". mysql_errno());
				}
				$this->resultado = "update";
			}
			else{
				$query_insert = mysql_query("INSERT INTO prova VALUE (NULL, '$numero','$resposta', '$cod_avaliacao', '$session','$cod_aluno')") or die ("Erro insert1 ". mysql_erro());
				$this->resultado = "insert";
			}
		}
		
		public function update_prova($nome,$cod_professor,$cod_curso,$cod_turma,$codigo){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_insert = mysql_query("UPDATE prova SET nome = '$nome',  cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma' WHERE cod_prova = '$codigo'") or die ("Erro update". mysql_errno());
			$this->resultado = "ok";
		}
	}
?>
