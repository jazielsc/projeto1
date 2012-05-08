<?php

	class Class_item{
		public $cod_item;
		public $cod_turma;
		public $cod_aluno;
		public $cod_curso;
		public $cod_status;

		public function insert_item($cod_aluno,$cod_turma){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_select = mysql_query("SELECT cod_item FROM item WHERE cod_aluno = '$cod_aluno' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());
			$quant = mysql_num_rows($query_select);
			if ($quant > 0){
				$this->resultado = "NAO";
			}
			else{
				$cod_status = 1;
				$query_insert = mysql_query("INSERT INTO item VALUE (NULL, '$cod_turma','$cod_aluno','$cod_status')") or die ("Erro insert ". mysql_erro());
				$this->resultado = "ok";
			}
		}

		public function update_item($codigo,$cod_turma){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_insert = mysql_query("UPDATE item SET cod_status = 2 WHERE cod_item = '$codigo'") or die ("Erro update". mysql_errno());
			$this->resultado = "ok";
		}

		public function delete_item($codigo,$cod_turma){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_insert = mysql_query("DELETE FROM item WHERE cod_item = '$codigo'") or die ("Erro update". mysql_errno());
			$this->resultado = "ok";
		}		
	}
	
?>
