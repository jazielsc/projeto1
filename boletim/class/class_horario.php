<?php

	class Class_horario{

		public $cod_horario;
		public $cod_professor;
		public $cod_turma;
		public $cod_disciplina;
		public $dia;
		public $inicio;
		public $termino;
		public $horario;
		public $dia_numero;
		public $cod_curso;

		public function insert_horario($dia,$inicio,$termino,$cod_turma,$cod_disciplina,$cod_professor,$horario,$dia_numero,$cod_curso){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_select = mysql_query("SELECT cod_horario FROM horario WHERE horario = '$horario' AND dia = '$dia' AND cod_professor = '$cod_professor' AND cod_disciplina = '$cod_disciplina' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());
			$quant = mysql_num_rows($query_select);
			if ($quant > 0){
				$this->resultado = "NAO"; 
			}
			else{
				$query_insert = mysql_query("INSERT INTO horario VALUE (NULL, '$dia','$inicio','$termino','$cod_turma', '$cod_disciplina', '$cod_professor', '$horario', '$dia_numero', '$cod_curso')") or die ("Erro insert1 ". mysql_erro());
				$this->resultado = "ok";
			}
		}
		
		public function update_horario($dia,$inicio,$termino,$cod_turma,$cod_disciplina,$cod_professor,$horario,$dia_numero,$cod_curso,$codigo){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_insert = mysql_query("UPDATE horario SET dia = '$dia', inicio = '$inicio', termino = '$termino', cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma', cod_disciplina = '$cod_disciplina', horario = '$horario', dia_numero = '$dia_numero' WHERE cod_horario = '$codigo'") or die ("Erro update". mysql_errno());
			$this->resultado = "ok";
		}

		public function delete_horario($codigo,$cod_turma){
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_delete = mysql_query("DELETE FROM horario WHERE cod_horario = '$codigo'");
		}
	}

?>
