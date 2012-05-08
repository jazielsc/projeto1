<?php

	class Class_item2{
		public $cod_item2;
		public $cod_disciplina;
		public $cod_aluno;
		public $cod_curso;
		public $cod_status;

		public function insert_item2($cod_aluno,$cod_disciplina){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_select = mysql_query("SELECT cod_item2 FROM item2 WHERE cod_aluno = '$cod_aluno' AND cod_disciplina = '$cod_disciplina'") or die ("Erro select ". mysql_error());
			// verificando se a query retornou algum valor
			$quant = mysql_num_rows($query_select);
			// se retornou então envia a mensagem
			if ($quant > 0){
				$this->resultado = "NAO";
			}
			else{
				$cod_status = 1;
				$query_insert = mysql_query("INSERT INTO item2 VALUE (NULL, '$cod_disciplina','$cod_aluno','$cod_status')") or die ("Erro insert ". mysql_erro());
				$this->resultado = "ok";
			}
		}

		public function insert_item2_disciplina($cod_aluno,$cod_disciplina,$cod_turma){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_select = mysql_query("SELECT cod_item2 FROM item2 WHERE cod_aluno = '$cod_aluno' AND cod_disciplina = '$cod_disciplina'") or die ("Erro select ". mysql_error());
			// verificando se a query retornou algum valor
			$quant = mysql_num_rows($query_select);
			// se retornou então envia a mensagem
			if ($quant > 0){
				$this->resultado = "NAO";
			}
			else{
				$cod_status = 1;
				if($cod_disciplina != "0"){
					$query_insert = mysql_query("INSERT INTO item2 VALUE (NULL, '$cod_disciplina','$cod_aluno','$cod_status')") or die ("Erro insert ". mysql_erro());
				}
				else{
					$query_select2 = mysql_query("SELECT cod_disciplina FROM disciplina WHERE cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());
					while ($resultado = mysql_fetch_array($query_select2)){
						$query_select = mysql_query("SELECT cod_item2 FROM item2 WHERE cod_aluno = '$cod_aluno' AND cod_disciplina = '$resultado[0]'") or die ("Erro select ". mysql_error());
						$quantidade = mysql_num_rows($query_select);
						// se retornou então envia a mensagem
						if ($quantidade == 0){
							$query_insert = mysql_query("INSERT INTO item2 VALUE (NULL, '$resultado[0]','$cod_aluno','$cod_status')") or die ("Erro insert ". mysql_erro());
						}
					}
				}
				$this->resultado = "ok";
			}
		}

		public function update_item2($codigo,$cod_disciplina){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_insert = mysql_query("UPDATE item2 SET cod_status = 2 WHERE cod_item2 = '$codigo'") or die ("Erro update". mysql_errno());
			$this->resultado = "ok";
		}

		public function delete_item2($codigo,$cod_disciplina,$cod_aluno){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query = mysql_query("SELECT cod_item2 FROM item2, boletim WHERE item2.cod_disciplina = boletim.cod_disciplina AND item2.cod_aluno = boletim.cod_aluno AND boletim.cod_aluno = '$cod_aluno' AND boletim.cod_disciplina = '$cod_disciplina'",$conn) or die ("Error na consulta");
			$quant = mysql_num_rows($query);
			// se retornou então envia a mensagem
			if ($quant > 0){
				$this->resultado = "NAO";
			}
			else {
				$query_insert = mysql_query("DELETE FROM item2 WHERE cod_item2 = '$codigo'") or die ("Erro update". mysql_errno());
				$this->resultado = "ok";
			}
		}// fim do método
	}
	
?>
