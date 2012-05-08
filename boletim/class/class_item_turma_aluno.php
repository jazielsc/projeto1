<?php

	class Class_aluno{
		public $cod_aluno;
		public $cod_turma;
		public $cod_curso;
		public $cod_status;

		public function insert_aluno($cod_aluno,$cod_turma){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_select = mysql_query("SELECT cod_aluno FROM aluno WHERE cod_aluno = '$cod_aluno' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());
			$quant = mysql_num_rows($query_select);
			if ($quant > 0){
				$this->resultado = "NAO";
            }
			else {
				$query_insert = mysql_query("INSERT INTO aluno VALUE (NULL, '$cod_turma','$data','$cod_instituicao','$cod_curso')") or die ("Erro insert ". mysql_erro());
				$this->resultado = "ok";
			}
		}

		public function update_aluno($nome,$data,$cod_instituicao,$cod_curso,$codigo){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_insert = mysql_query("UPDATE aluno SET nome = '$nome',  data = '$data', cod_instituicao = '$cod_instituicao', cod_curso = '$cod_curso' WHERE cod_aluno = '$codigo'") or die ("Erro update". mysql_errno());
			$this->resultado = "ok";
		}
	}
?>
