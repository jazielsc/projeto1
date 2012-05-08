<?php

/**
 * classe para manipulação dos dados referente ao curso
 *
 * @author Administrador
 */
class Class_curso{
	public $cod_curso;
    public $nome;
    public $cod_instituicao;
    public $tipo;   
              
    public function insert_curso($nome,$cod_instituicao,$tipo){               
		
		include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
        $query_select = mysql_query("SELECT cod_curso FROM curso WHERE nome = '$nome' AND cod_instituicao = '$cod_instituicao'") or die ("Erro select ". mysql_errno());
		// verificando se a query retornou algum valor
		$quant = mysql_num_rows($query_select);
		// se retornou então envia a mensagem
		if ($quant > 0){
			$this->resultado = "NAO";
		}else {
			$query_insert = mysql_query("INSERT INTO curso VALUE (NULL, '$nome','$cod_instituicao','$tipo')") or die ("Erro insert ". mysql_errno());
			$query_grid = mysql_query("SELECT cod_curso, curso.nome, instituicao.nome, curso.tipo FROM curso, instituicao WHERE curso.cod_instituicao = instituicao.cod_instituicao AND instituicao.cod_instituicao = '$cod_instituicao' ORDER BY curso.nome",$conn) or die ("Error na consulta");
			// zerando contadores
			$i = 0;
			while ($result = mysql_fetch_array($query_grid)){ // retornando os valores da consulta em array e enviando para o flash
				echo "&codigo$i=$result[0]";
				echo "&curso$i=$result[1]";
				echo "&instituicao$i=$result[2]";
				echo "&tipo$i=$result[3]";
				$i++;
			}
			$this->resultado = "ok";
		}
     }// fim do método

    public function update_curso($nome,$cod_instituicao,$cod_curso,$tipo){
		session_start();
        $cod_instituicao = (int) $_SESSION['id_instituicao'];
        include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");    
		$query_insert = mysql_query("UPDATE curso SET nome = '$nome',  cod_instituicao = '$cod_instituicao', tipo = '$tipo' WHERE cod_curso = '$cod_curso'") or die ("Erro update". mysql_errno());
		$query_grid = mysql_query("SELECT cod_curso, curso.nome, instituicao.nome, curso.tipo FROM curso, instituicao WHERE curso.cod_instituicao = instituicao.cod_instituicao AND instituicao.cod_instituicao = '$cod_instituicao'  ORDER BY curso.nome",$conn) or die ("Error na consulta");
		// zerando contadores
		$i = 0;
		while ($result = mysql_fetch_array($query_grid)){ // retornando os valores da consulta em array e enviando para o flash
			echo "&codigo$i=$result[0]";
			echo "&curso$i=$result[1]";
			echo "&instituicao$i=$result[2]";
			echo "&tipo$i=$result[3]";
			$i++;
		}
		$this->resultado = "ok";
	}// fim do método



    public function delete_curso($codigo){
		session_start();
		$cod_instituicao = (int) $_SESSION['id_instituicao'];
        include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
        $query = mysql_query("SELECT cod_curso FROM turma WHERE cod_curso = '$codigo'") or die (mysql_error());
        $quant = mysql_num_rows($query);
		// se retornou então envia a mensagem
        if ($quant > 0){
			return 102;
		}else {
			$query_delete = mysql_query("DELETE FROM curso WHERE cod_curso = '$codigo'");
			$query_grid = mysql_query("SELECT cod_curso, curso.nome, instituicao.nome, curso.tipo FROM curso, instituicao WHERE curso.cod_instituicao = instituicao.cod_instituicao AND instituicao.cod_instituicao = '$cod_instituicao'  ORDER BY curso.nome",$conn) or die ("Error na consulta");         
			return 2;
		}
	}// fim do método
}
?>
