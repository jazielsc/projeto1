<?php

/**
 * classe para manipulação dos dados referente ao questao
 *
 * @author Administrador
 */
class Class_questao
{


     public $cod_questao;
     public $numero;
     public $peso;
     public $pergunta; 
     public $resposta;
     public $cod_avaliaçao;
     public $session;
     public $tipo;

                   
     public function insert_questao($numero,$peso,$pergunta,$resposta,$cod_avaliacao,$session,$tipo)
     {

        
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_questao FROM questao WHERE numero = '$numero' AND session = '$session'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {


                if ($tipo != "")
                $query_update = mysql_query("UPDATE questao SET tipo = '$tipo' WHERE numero = '$numero' AND session = '$session'") or die ("Erro update". mysql_errno());

                if ($peso != "")
                $query_update = mysql_query("UPDATE questao SET peso = '$peso' WHERE numero = '$numero' AND session = '$session'") or die ("Erro update". mysql_errno());

                 if ($pergunta != "")
                $query_update = mysql_query("UPDATE questao SET pergunta = '$pergunta' WHERE numero = '$numero' AND session = '$session'") or die ("Erro update". mysql_errno());

                  if ($resposta != "")
                $query_update = mysql_query("UPDATE questao SET resposta = '$resposta' WHERE numero = '$numero' AND session = '$session'") or die ("Erro update". mysql_errno());

                 $this->resultado = "update";
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO questao VALUE (NULL, '$numero','$peso','$pergunta','$resposta', '$cod_avaliacao', '$session','$tipo')") or die ("Erro insert1 ". mysql_erro());
                     
                     $this->resultado = "insert";
                }
     }// fim do método


     public function insert_questao_consulta($numero,$peso,$pergunta,$resposta,$cod_avaliacao,$session,$tipo)
     {


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_questao FROM questao WHERE numero = '$numero' AND cod_avaliacao = '$cod_avaliacao'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {


                if ($tipo != "")
                $query_update = mysql_query("UPDATE questao SET tipo = '$tipo' WHERE numero = '$numero' AND cod_avaliacao = '$cod_avaliacao'") or die ("Erro update". mysql_errno());

                if ($peso != "")
                $query_update = mysql_query("UPDATE questao SET peso = '$peso' WHERE numero = '$numero' AND cod_avaliacao = '$cod_avaliacao'") or die ("Erro update". mysql_errno());

                 if ($pergunta != "")
                $query_update = mysql_query("UPDATE questao SET pergunta = '$pergunta' WHERE numero = '$numero' AND cod_avaliacao = '$cod_avaliacao'") or die ("Erro update". mysql_errno());

                  if ($resposta != "")
                $query_update = mysql_query("UPDATE questao SET resposta = '$resposta' WHERE numero = '$numero' AND cod_avaliacao = '$cod_avaliacao'") or die ("Erro update". mysql_errno());

                 $this->resultado = "update";
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO questao VALUE (NULL, '$numero','$peso','$pergunta','$resposta', '$cod_avaliacao', 0,'$tipo')") or die ("Erro insert1 ". mysql_erro());

                     $this->resultado = "insert";
                }
     }// fim do método



     public function insert_banco_questao($peso,$pergunta,$resposta,$cod_avaliacao,$session,$tipo,$referencia){

      include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
     
     $query_numero = mysql_query("SELECT COUNT(numero) FROM questao WHERE session = '$session'AND cod_avaliacao = 0") or die ("ERRO 1 select" . mysql_error());
     $resultado = mysql_fetch_array($query_numero);

     $numero = $resultado[0] + 1;

     $query_insert = mysql_query("INSERT INTO questao VALUE (NULL, '$numero','$peso','$pergunta','$resposta', 0, '$session', '$tipo')") or die ("Erro insert1 ". mysql_erro());

     $query_select = mysql_query("SELECT alternativa, resposta, comentario FROM resposta WHERE numero = '$referencia' AND cod_questao = '$cod_avaliacao'") or die ("Erro select ". mysql_error());

     $i = 0;
     while($result = mysql_fetch_array($query_select)){
         
     
         $alternativa = $result[0];
         $resposta = $result[1];
         $comentario = $result[2];


     $query_insert = mysql_query("INSERT INTO resposta VALUE (NULL, '$numero','$alternativa','$resposta', '$comentario', 0, '$session')") or die ("Erro insert1 ". mysql_erro());
     
     $i++;

     }

     $query_grid = mysql_query("SELECT numero, pergunta FROM questao WHERE session = '$session' ORDER BY numero",$conn) or die ("Error na consulta" .mysql_error());

                $i = 0;
                while($result = mysql_fetch_array($query_grid))
                    { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&pergunta$i=$result[1]";

                             $i++;
                    }



      $this->resultado = "OK";
     
      
     }

     public function select_grid_questao() { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                    $query_grid = mysql_query("SELECT cod_questao, curso.nome, questao.nome, professor.nome FROM questao, professor, curso WHERE questao.cod_professor = professor.cod_professor AND questao.cod_curso = curso.cod_curso ORDER BY questao.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                   $query_grid = mysql_query("SELECT cod_questao, curso.nome, questao.nome, professor.nome, turma.nome FROM questao, professor, curso, turma WHERE questao.cod_professor = professor.cod_professor AND questao.cod_curso = curso.cod_curso AND turma.cod_turma = questao.cod_turma ORDER BY questao.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&questao$i=$result[2]";
                            echo "&professor$i=$result[3]";
                            echo "&turma$i=$result[4]";



                            $i++;

                        }
                     $this->resultado = "ok";
                
                     
                     
     }

     public function select_questao($codigo,$session){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT peso, pergunta, resposta, tipo FROM questao WHERE numero = '$codigo' AND session = '$session'",$conn) or die ("Error na consulta" .mysql_error());

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{	


                $result = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash


                            echo "&peso=$result[0]";
                            echo "&pergunta=$result[1]";
                            echo "&respostass=$result[2]";
                            echo "&tipo=$result[3]";
                            
                           
                          

                        
                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }

     public function consulta_questao($codigo,$cod_avaliacao){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT peso, pergunta, resposta, tipo FROM questao WHERE numero = '$codigo' AND cod_avaliacao = '$cod_avaliacao'",$conn) or die ("Error na consulta" .mysql_error());

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{


                $result = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash


                            echo "&peso=$result[0]";
                            echo "&pergunta=$result[1]";
                            echo "&respostass=$result[2]";
                            echo "&tipo=$result[3]";


$query_grid2 = mysql_query("SELECT cod_resposta, alternativa, resposta, comentario FROM resposta WHERE numero = '$codigo' AND cod_questao = '$cod_avaliacao' ORDER BY alternativa",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid2))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&alternativa$i=$result[1]";
                            echo "&resposta$i=$result[2]";
                            echo "&comentario$i=$result[3]";



                            $i++;

                        }



                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }



     public function update_questao($nome,$cod_professor,$cod_curso,$cod_turma,$codigo)
     {

       
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         
                     $query_insert = mysql_query("UPDATE questao SET nome = '$nome',  cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma' WHERE cod_questao = '$codigo'") or die ("Erro update". mysql_errno());

                     $query_grid = mysql_query("SELECT cod_questao, curso.nome, questao.nome, professor.nome, turma.nome FROM questao, professor, curso, turma WHERE questao.cod_professor = professor.cod_professor AND questao.cod_curso = curso.cod_curso AND turma.cod_turma = questao.cod_turma ORDER BY questao.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&questao$i=$result[2]";
                            echo "&professor$i=$result[3]";
                            echo "&turma$i=$result[4]";



                            $i++;

                        }



                     $this->resultado = "ok";
               
     }// fim do método

      public function banco_questao_grid($cod_curso,$cod_disciplina){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT cod_questao, pergunta FROM questao, avaliacao WHERE questao.cod_avaliacao = avaliacao.cod_avaliacao AND cod_curso = '$cod_curso' AND cod_disciplina = '$cod_disciplina' GROUP BY pergunta",$conn) or die ("Error na consulta" .mysql_error());

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{

                $i = 0;
                while($result = mysql_fetch_array($query_grid))
                    { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&pergunta$i=$result[1]";
                                                        
                             $i++;
                    }



                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function banco_questao_grid2($session){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT numero, pergunta FROM questao WHERE session = '$session' ORDER BY numero",$conn) or die ("Error na consulta" .mysql_error());

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{

                $i = 0;
                while($result = mysql_fetch_array($query_grid))
                    { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&pergunta$i=$result[1]";

                             $i++;
                    }



                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }

     public function banco_questao_consulta($codigo){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


          $query_contagem = mysql_query("SELECT COUNT(*) FROM questao WHERE cod_avaliacao = '$codigo'") or die ("errona na contagem de registros");
          $contagem = mysql_fetch_array($query_contagem);

          echo"&numero=$contagem[0]";

         $query_grid = mysql_query("SELECT avaliacao.cod_avaliacao, professor.nome, curso.nome,  turma.nome, avaliacao.nome, disciplina.nome, valor, minima, questao.numero FROM avaliacao, professor, curso, turma, disciplina, questao WHERE avaliacao.cod_professor = professor.cod_professor AND avaliacao.cod_curso = curso.cod_curso AND avaliacao.cod_turma = turma.cod_turma AND avaliacao.cod_disciplina = disciplina.cod_disciplina AND avaliacao.cod_avaliacao = questao.cod_avaliacao AND cod_questao = '$codigo' ORDER BY avaliacao.nome",$conn) or die ("Error na consulta" .mysql_error());

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{


                $result = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo=$result[0]";
                            echo "&professor=$result[1]";
                            echo "&curso=$result[2]";
                            echo "&turma=$result[3]";
                            echo "&titulo=$result[4]";
                            echo "&disciplina=$result[5]";
                            echo "&valor=$result[6]";
                            echo "&minima=$result[7]";
                            echo "&numero=$result[8]";




                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }



}
?>
