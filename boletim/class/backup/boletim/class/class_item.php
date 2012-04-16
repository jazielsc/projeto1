<?php

/**
 * classe para manipulação dos dados referente ao item
 *
 * @author Administrador
 */
class Class_item
{


     public $cod_item;
     public $cod_turma;
     public $cod_aluno;
     public $cod_curso;
     public $cod_status;


     public function insert_item($cod_aluno,$cod_turma)
     {


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_item FROM item WHERE cod_aluno = '$cod_aluno' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 $this->resultado = "NAO";
            } else
                 {

                    $cod_status = 1;

                    $query_insert = mysql_query("INSERT INTO item VALUE (NULL, '$cod_turma','$cod_aluno','$cod_status')") or die ("Erro insert ". mysql_erro());

                    $query_grid = mysql_query("SELECT cod_item, aluno.nome, turma.nome FROM item, turma, aluno WHERE item.cod_turma = turma.cod_turma AND item.cod_aluno = aluno.cod_aluno AND item.cod_turma = '$cod_turma' AND item.cod_status = 1 ORDER BY aluno.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&aluno$i=$result[1]";
                            echo "&turma$i=$result[2]";
                            

                            $i++;

                        }


                     $this->resultado = "ok";
                }
     }// fim do método

     public function select_grid_item($cod_turma) { // método para preenchimento da grid no form

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT DISTINCT aluno.cod_aluno, aluno.nome, turma.nome FROM item2, turma, aluno, disciplina WHERE item2.cod_disciplina = disciplina.cod_disciplina AND disciplina.cod_turma = turma.cod_turma AND item2.cod_aluno = aluno.cod_aluno AND disciplina.cod_turma = '$cod_turma' AND item2.cod_status = 1 ORDER BY aluno.nome",$conn) or die ("Error na consulta " .mysql_error() );

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&aluno$i=$result[1]";
                            echo "&turma$i=$result[2]";


                            $i++;

                        }


                     $this->resultado = "ok";



     }

     public function select_item($codigo){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT aluno.cod_aluno, aluno.nome FROM item, aluno WHERE item.cod_aluno = aluno.cod_aluno AND cod_item = '$codigo' ORDER BY aluno.nome",$conn) or die ("Error na consulta" .mysql_error());

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{


                $result = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash


                           
                            echo "&cod_aluno=$result[0]";
                            echo "&nome_aluno=$result[1]";
                            



                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function update_item($codigo,$cod_turma)
     {


                  include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


                     $query_insert = mysql_query("UPDATE item SET cod_status = 2 WHERE cod_item = '$codigo'") or die ("Erro update". mysql_errno());

                    $query_grid = mysql_query("SELECT cod_item, aluno.nome, turma.nome FROM item, turma, aluno WHERE item.cod_turma = turma.cod_turma AND item.cod_aluno = aluno.cod_aluno AND item.cod_turma = '$cod_turma' AND item.cod_status = 1 ORDER BY aluno.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&aluno$i=$result[1]";
                            echo "&turma$i=$result[2]";


                            $i++;

                        }





                     $this->resultado = "ok";

     }// fim do método

     public function delete_item($codigo,$cod_turma)
     {


                  include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


                     $query_insert = mysql_query("DELETE FROM item WHERE cod_item = '$codigo'") or die ("Erro update". mysql_errno());

                    $query_grid = mysql_query("SELECT cod_item, aluno.nome, turma.nome FROM item, turma, aluno WHERE item.cod_turma = turma.cod_turma AND item.cod_aluno = aluno.cod_aluno AND item.cod_turma = '$cod_turma' AND item.cod_status = 1 ORDER BY aluno.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&aluno$i=$result[1]";
                            echo "&turma$i=$result[2]";


                            $i++;

                        }





                     $this->resultado = "ok";

     }// fim do método
}
?>
