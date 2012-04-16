<?php

/**
 * classe para manipulação dos dados referente ao item2 - disciplinas dos alunos
 *
 * @author Administrador
 */
class Class_item2
{


     public $cod_item2;
     public $cod_disciplina;
     public $cod_aluno;
     public $cod_curso;
     public $cod_status;


     public function insert_item2($cod_aluno,$cod_disciplina)
     {


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_item2 FROM item2 WHERE cod_aluno = '$cod_aluno' AND cod_disciplina = '$cod_disciplina'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 $this->resultado = "NAO";
            } else
                 {

                    $cod_status = 1;

                    $query_insert = mysql_query("INSERT INTO item2 VALUE (NULL, '$cod_disciplina','$cod_aluno','$cod_status')") or die ("Erro insert ". mysql_erro());

                    $query_grid = mysql_query("SELECT cod_item2, aluno.nome, disciplina.nome, curso.nome FROM item2, disciplina, aluno, curso WHERE curso.cod_curso = disciplina.cod_curso AND item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND item2.cod_disciplina = '$cod_disciplina' AND item2.cod_status = 1 ORDER BY aluno.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&aluno$i=$result[1]";
                            echo "&disciplina$i=$result[2]";
                            echo "&curso$i=$result[3]";
                            

                            $i++;

                        }


                     $this->resultado = "ok";
                }
     }// fim do método

     public function insert_item2_disciplina($cod_aluno,$cod_disciplina,$cod_turma)
     {


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_item2 FROM item2 WHERE cod_aluno = '$cod_aluno' AND cod_disciplina = '$cod_disciplina'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 $this->resultado = "NAO";
            } else
                 {


                    $cod_status = 1;

                    if($cod_disciplina != "0")
                    {

                        $query_insert = mysql_query("INSERT INTO item2 VALUE (NULL, '$cod_disciplina','$cod_aluno','$cod_status')") or die ("Erro insert ". mysql_erro());
                        }else
                            {


                                $query_select2 = mysql_query("SELECT cod_disciplina FROM disciplina WHERE cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());

                                while ($resultado = mysql_fetch_array($query_select2))
                                {
                        
                    

                                    $query_select = mysql_query("SELECT cod_item2 FROM item2 WHERE cod_aluno = '$cod_aluno' AND cod_disciplina = '$resultado[0]'") or die ("Erro select ". mysql_error());
                                    $quantidade = mysql_num_rows($query_select);

                                    // se retornou então envia a mensagem
                                    if ($quantidade == 0)
                                        {

                
                                            $query_insert = mysql_query("INSERT INTO item2 VALUE (NULL, '$resultado[0]','$cod_aluno','$cod_status')") or die ("Erro insert ". mysql_erro());
                
                                        }
                                }

                            }
                    $query_grid = mysql_query("SELECT cod_item2, aluno.nome, disciplina.nome, curso.nome FROM curso, item2, disciplina, aluno WHERE curso.cod_curso = disciplina.cod_curso AND item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND aluno.cod_aluno = '$cod_aluno' AND item2.cod_status = 1 ORDER BY aluno.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&aluno$i=$result[1]";
                            echo "&disciplina$i=$result[2]";
                            echo "&curso$i=$result[3]";


                            $i++;

                        }


                     $this->resultado = "ok";
                }
     }// fim do método


     public function select_grid_item2($cod_disciplina) { // método para preenchimento da grid no form

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT cod_item2, aluno.nome, disciplina.nome, curso.nome FROM item2, disciplina, aluno, curso WHERE curso.cod_curso = disciplina.cod_curso AND item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND item2.cod_disciplina = '$cod_disciplina' AND item2.cod_status = 1 ORDER BY aluno.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&aluno$i=$result[1]";
                            echo "&disciplina$i=$result[2]";
                            echo "&curso$i=$result[3]";


                            $i++;

                        }


                     $this->resultado = "ok";



     }

     public function select_grid_item2_disciplina($cod_aluno) { // método para preenchimento da grid no form

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT cod_item2, aluno.nome, disciplina.nome, curso.nome FROM item2, disciplina, aluno, curso WHERE curso.cod_curso = disciplina.cod_curso AND item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND aluno.cod_aluno = '$cod_aluno' AND item2.cod_status = 1 ORDER BY aluno.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&aluno$i=$result[1]";
                            echo "&disciplina$i=$result[2]";
                            echo "&curso$i=$result[3]";


                            $i++;

                        }


                     $this->resultado = "ok";



     }


     public function select_item2($codigo){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT aluno.cod_aluno, aluno.nome FROM item2, aluno WHERE item2.cod_aluno = aluno.cod_aluno AND cod_item2 = '$codigo' ORDER BY aluno.nome",$conn) or die ("Error na consulta" .mysql_error());

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


     public function update_item2($codigo,$cod_disciplina)
     {


                  include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


                     $query_insert = mysql_query("UPDATE item2 SET cod_status = 2 WHERE cod_item2 = '$codigo'") or die ("Erro update". mysql_errno());

                    $query_grid = mysql_query("SELECT cod_item2, aluno.nome, disciplina.nome FROM item2, disciplina, aluno WHERE item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND item2.cod_disciplina = '$cod_disciplina' AND item2.cod_status = 1 ORDER BY aluno.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&aluno$i=$result[1]";
                            echo "&disciplina$i=$result[2]";


                            $i++;

                        }





                     $this->resultado = "ok";

     }// fim do método

     public function delete_item2($codigo,$cod_disciplina)
     {


                  include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


                     $query_insert = mysql_query("DELETE FROM item2 WHERE cod_item2 = '$codigo'") or die ("Erro update". mysql_errno());

                    $query_grid = mysql_query("SELECT cod_item2, aluno.nome, disciplina.nome FROM item2, disciplina, aluno WHERE item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND item2.cod_disciplina = '$cod_disciplina' AND item2.cod_status = 1 ORDER BY aluno.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&aluno$i=$result[1]";
                            echo "&disciplina$i=$result[2]";


                            $i++;

                        }





                     $this->resultado = "ok";

     }// fim do método
}
?>
