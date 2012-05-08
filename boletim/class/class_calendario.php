<?php

class Class_calendario{
    
	public $cod_calendario;
    public $cod_professor;
    public $cod_turma;
    public $cod_disciplina;
    public $dia;
    public $inicio;
    public $termino;
    public $calendario;
    public $dia_numero;
    public $cod_curso;
                  
	public function insert_calendario($dia,$inicio,$termino,$cod_turma,$cod_disciplina,$cod_professor,$calendario,$dia_numero,$cod_curso){
        if(!empty($dia)){ // testando se foi passado algum valor para variável
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			$query_select = mysql_query("SELECT cod_calendario FROM calendario WHERE calendario = '$calendario' AND dia = '$dia' AND cod_professor = '$cod_professor' AND cod_disciplina = '$cod_disciplina' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());
			$quant = mysql_num_rows($query_select);
            if ($quant > 0){
				return 400;
            }
			else {
				$query_insert = mysql_query("INSERT INTO calendario VALUE (NULL, '$dia','$inicio','$termino','$cod_turma', '$cod_disciplina', '$cod_professor', '$calendario', '$dia_numero', '$cod_curso')") or die ("Erro insert1 ". mysql_erro());
				return 0;
			}
		}
	}
	
    public function update_calendario($dia,$inicio,$termino,$cod_turma,$cod_disciplina,$cod_professor,$calendario,$dia_numero,$cod_curso,$codigo){
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");        
		$query_insert = mysql_query("UPDATE calendario SET dia = '$dia', inicio = '$inicio', termino = '$termino', cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma', cod_disciplina = '$cod_disciplina', calendario = '$calendario', dia_numero = '$dia_numero' WHERE cod_calendario = '$codigo'") or die ("Erro update". mysql_errno());
		return 1;
     }



	public function delete_calendario($codigo,$cod_turma){
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
		$query_delete = mysql_query("DELETE FROM calendario WHERE cod_calendario = '$codigo'");
		return 2;
	}
}
?>
