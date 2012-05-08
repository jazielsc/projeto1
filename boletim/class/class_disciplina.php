<?php

class Class_disciplina {

	public $cod_disciplina;
    public $nome;
    public $cod_professor;
    public $cod_curso;
    public $cod_turma;
    public $carga_horaria;
    public $numero_faltas;
                   
	public function insert_disciplina($nome,$cod_professor,$cod_curso,$cod_turma,$carga_horaria,$numero_faltas) {
		session_start();
		$cod_instituicao = (int) $_SESSION['id_instituicao'];
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
		$query_select = mysql_query("SELECT cod_disciplina FROM disciplina WHERE nome = '$nome' AND cod_professor = '$cod_professor' AND cod_curso = '$cod_curso' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());
		$quant = mysql_num_rows($query_select);
		if ($quant > 0) {
			$this->resultado = "NAO"; 
		}
		else {
			$query_insert = mysql_query("INSERT INTO disciplina VALUE (NULL, '$nome','$cod_professor','$cod_curso','$cod_turma','$carga_horaria','$numero_faltas')") or die ("Erro insert1 ". mysql_erro());                         
		}
	}


	public function insert_disciplina_lancamento($nome,$cod_professor,$cod_curso,$cod_turma){
		session_start();
		$cod_instituicao = (int) $_SESSION['id_instituicao'];
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
		$query_select = mysql_query("SELECT cod_disciplina FROM disciplina WHERE nome = '$nome' AND cod_professor = '$cod_professor' AND cod_curso = '$cod_curso' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());
		$quant = mysql_num_rows($query_select);
		if ($quant > 0) {
			$this->resultado = "NAO";
		}
		else {
			$query_select2 = mysql_query("SELECT carga_horaria, numero_faltas FROM disciplina WHERE nome = '$nome' AND cod_curso = '$cod_curso' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());
			$resultado = mysql_fetch_array($query_grid2);
			$query_insert = mysql_query("INSERT INTO disciplina VALUE (NULL, '$nome','$cod_professor','$cod_curso','$cod_turma','$resultado[0]','$resultado[1]')") or die ("Erro insert1 ". mysql_erro());
			$query_disciplina = mysql_query("SELECT cod_disciplina FROM disciplina ORDER BY cod_disciplina DESC LIMIT 0,1");
		}
	}
	
    public function update_disciplina($nome,$cod_professor,$cod_curso,$cod_turma,$codigo,$carga_horaria,$numero_faltas){
		session_start();
		$cod_instituicao = (int) $_SESSION['id_instituicao'];
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");        
		$query_insert = mysql_query("UPDATE disciplina SET nome = '$nome',  cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma', carga_horaria = '$carga_horaria', numero_faltas = '$numero_faltas' WHERE cod_disciplina = '$codigo'") or die ("Erro update". mysql_errno());
		$this->resultado = "ok";      
	}// fim do método

	public function delete_disciplina($codigo){
		$cod_instituicao = (int) $_SESSION['id_instituicao'];
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
		$query = mysql_query("SELECT cod_disciplina FROM item2 WHERE cod_disciplina = '$codigo'") or die (mysql_error());
		$quant = mysql_num_rows($query);
		if ($quant > 0){
			return 302;
		}
		else {
			$query_delete = mysql_query("DELETE FROM disciplina WHERE cod_disciplina = '$codigo'");
			return 2;
		}
	}
}

?>
