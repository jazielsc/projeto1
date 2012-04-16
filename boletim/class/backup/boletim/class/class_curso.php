<?php

/**
 * classe para manipulação dos dados referente ao curso
 *
 * @author Administrador
 */
class Class_curso
{


     public $cod_curso;
     public $nome;
     public $cod_instituicao;
     
              
     public function insert_curso($nome,$cod_instituicao)
     {


                 

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_curso FROM curso WHERE nome = '$nome' AND cod_instituicao = '$cod_instituicao'") or die ("Erro select ". mysql_errno());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 $this->resultado = "NAO";
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO curso VALUE (NULL, '$nome','$cod_instituicao')") or die ("Erro insert ". mysql_errno());
                     
                     $query_grid = mysql_query("SELECT cod_curso, curso.nome, instituicao.nome FROM curso, instituicao WHERE curso.cod_instituicao = instituicao.cod_instituicao AND instituicao.cod_instituicao = '$cod_instituicao' ORDER BY curso.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&instituicao$i=$result[2]";
                            
                            $i++;

                        }


                     $this->resultado = "ok";
                }
     }// fim do método

     public function select_grid_curso() { // método para preenchimento da grid no form
        session_start();
                      $cod_instituicao = (int) $_SESSION['id_instituicao'];
     
                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                    $query_grid = mysql_query("SELECT cod_curso, curso.nome, instituicao.nome FROM curso, instituicao WHERE curso.cod_instituicao = instituicao.cod_instituicao AND instituicao.cod_instituicao = '$cod_instituicao'  ORDER BY curso.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                   $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&instituicao$i=$result[2]";
                            
                            $i++;

                        }
                     
                     
     }

     public function select_curso($cod_curso){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT curso.nome, curso.cod_instituicao, instituicao.nome  FROM curso, instituicao WHERE curso.cod_instituicao = instituicao.cod_instituicao AND curso.cod_curso = '$cod_curso'") or die (mysql_error(). "erro em select");

         $quant = mysql_num_rows($query_select);

				// se retornou então preenche os dados
	if ($quant > 0)
	{	


                $result = mysql_fetch_array($query_select); // retornando os valores da consulta em array e enviando para o flash


                            echo "&nome=$result[0]";
                            echo "&cod_instituicao=$result[1]";
                            echo "&nome_instituicao=$result[2]";
                          

                        
                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function update_curso($nome,$cod_instituicao,$cod_curso)
     {
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         
                     $query_insert = mysql_query("UPDATE curso SET nome = '$nome',  cod_instituicao = '$cod_instituicao' WHERE cod_curso = '$cod_curso'") or die ("Erro update". mysql_errno());

                     $query_grid = mysql_query("SELECT cod_curso, curso.nome, instituicao.nome FROM curso, instituicao WHERE curso.cod_instituicao = instituicao.cod_instituicao ORDER BY curso.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&instituicao$i=$result[2]";
                            
                            $i++;

                        }


                     $this->resultado = "ok";
               
     }// fim do método
}
?>
