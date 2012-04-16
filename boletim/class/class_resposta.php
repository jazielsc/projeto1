<?php

/**
 * classe para manipulação dos dados referente ao resposta
 *
 * @author Administrador
 */
class Class_resposta
{


     public $cod_resposta;
     public $numero;
     public $alternativa;
     public $resposta;
     public $comentario;
     public $cod_questao;
     public $session;

                   
     public function insert_resposta($numero,$alternativa,$resposta,$comentario,$session,$cod_questao)
     {



         
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_resposta FROM resposta WHERE numero = '$numero' AND session = '$session' AND alternativa = '$alternativa'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {

                
                 if ($comentario != "")
                $query_update = mysql_query("UPDATE resposta SET comentario = '$comentario' WHERE alternativa = '$alternativa' AND numero = '$numero' AND session = '$session'") or die ("Erro update". mysql_errno());

                  if ($resposta != "")
                $query_update = mysql_query("UPDATE resposta SET resposta = '$resposta' WHERE alternativa = '$alternativa' AND numero = '$numero' AND session = '$session'") or die ("Erro update". mysql_errno());

               $this->resultado = "update";
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO resposta VALUE (NULL, '$numero','$alternativa','$resposta', '$comentario', '$cod_questao', '$session')") or die ("Erro insert1 ". mysql_erro());
                     
                     $this->resultado = "insert";
                }
     }// fim do método


     public function insert_resposta_consulta($numero,$alternativa,$resposta,$comentario,$session,$cod_questao)
     {




         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_resposta FROM resposta WHERE numero = '$numero' AND cod_questao = '$cod_questao' AND alternativa = '$alternativa'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {


                 if ($comentario != "")
                $query_update = mysql_query("UPDATE resposta SET comentario = '$comentario' WHERE alternativa = '$alternativa' AND numero = '$numero' AND cod_questao = '$cod_questao'") or die ("Erro update". mysql_errno());

                  if ($resposta != "")
                $query_update = mysql_query("UPDATE resposta SET resposta = '$resposta' WHERE alternativa = '$alternativa' AND numero = '$numero' AND cod_questao = '$cod_questao'") or die ("Erro update". mysql_errno());

               $this->resultado = "update";
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO resposta VALUE (NULL, '$numero','$alternativa','$resposta', '$comentario', '$cod_questao', '$session')") or die ("Erro insert1 ". mysql_erro());

                     $this->resultado = "insert";
                }
     }// fim do método

     public function select_grid_resposta($numero,$session) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                                       

                    // zerando contadores
                    $i = 0;

                   $query_grid = mysql_query("SELECT cod_resposta, alternativa, resposta, comentario FROM resposta WHERE numero = '$numero' AND session = '$session' ORDER BY alternativa",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&alternativa$i=$result[1]";
                            echo "&resposta$i=$result[2]";
                            echo "&comentario$i=$result[3]";



                            $i++;
                            
                        }
                     $this->resultado = "ok";
                
                     
                     
     }


     public function consulta_grid_resposta($numero,$cod_avaliacao) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


                    // zerando contadores
                    $i = 0;

                   $query_grid = mysql_query("SELECT cod_resposta, alternativa, resposta, comentario FROM resposta WHERE numero = '$numero' AND cod_questao = '$cod_avaliacao' ORDER BY alternativa",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&alternativa$i=$result[1]";
                            echo "&resposta$i=$result[2]";
                            echo "&comentario$i=$result[3]";



                            $i++;

                        }
                     $this->resultado = "ok";



     }

     public function select_resposta($codigo,$session){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT tipo, alternativa, resposta FROM resposta WHERE numero = '$codigo' AND session = '$session'",$conn) or die ("Error na consulta" .mysql_error());

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{	


                $result = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash


                            echo "&peso=$result[0]";
                            echo "&pergunta=$result[1]";
                            echo "&resposta=$result[2]";
                            
                           
                          

                        
                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function update_resposta($nome,$cod_professor,$cod_curso,$cod_turma,$codigo)
     {

       
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         
                     $query_insert = mysql_query("UPDATE resposta SET nome = '$nome',  cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma' WHERE cod_resposta = '$codigo'") or die ("Erro update". mysql_errno());

                     $query_grid = mysql_query("SELECT cod_resposta, curso.nome, resposta.nome, professor.nome, turma.nome FROM resposta, professor, curso, turma WHERE resposta.cod_professor = professor.cod_professor AND resposta.cod_curso = curso.cod_curso AND turma.cod_turma = resposta.cod_turma ORDER BY resposta.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&resposta$i=$result[2]";
                            echo "&professor$i=$result[3]";
                            echo "&turma$i=$result[4]";



                            $i++;

                        }



                     $this->resultado = "ok";
               
     }// fim do método
}
?>
