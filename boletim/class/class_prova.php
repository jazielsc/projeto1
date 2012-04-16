<?php

/**
 * classe para manipulação dos dados referente ao prova
 *
 * @author Administrador
 */
class Class_prova
{


     public $cod_prova;
     public $numero;
     public $resposta;
     public $cod_avaliaçao;
     public $cod_aluno;
     public $session;

     public $cod_resultado;
     public $data;
     public $tempo;
     public $nota;
    

                   
     public function insert_prova($numero,$resposta,$cod_avaliacao,$session,$cod_aluno)
     {

        
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_prova FROM prova WHERE numero = '$numero' AND session = '$session' AND cod_avaliacao = '$cod_avaliacao'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {


               

                  if ($resposta != "")
                $query_update = mysql_query("UPDATE prova SET resposta = '$resposta' WHERE numero = '$numero' AND session = '$session' AND cod_avaliacao = '$cod_avaliacao'") or die ("Erro update". mysql_errno());

                 $this->resultado = "update";
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO prova VALUE (NULL, '$numero','$resposta', '$cod_avaliacao', '$session','$cod_aluno')") or die ("Erro insert1 ". mysql_erro());
                     
                     $this->resultado = "insert";
                }
     }// fim do método

     public function select_grid_prova() { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                    $query_grid = mysql_query("SELECT cod_prova, curso.nome, prova.nome, professor.nome FROM prova, professor, curso WHERE prova.cod_professor = professor.cod_professor AND prova.cod_curso = curso.cod_curso ORDER BY prova.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                   $query_grid = mysql_query("SELECT cod_prova, curso.nome, prova.nome, professor.nome, turma.nome FROM prova, professor, curso, turma WHERE prova.cod_professor = professor.cod_professor AND prova.cod_curso = curso.cod_curso AND turma.cod_turma = prova.cod_turma ORDER BY prova.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&prova$i=$result[2]";
                            echo "&professor$i=$result[3]";
                            echo "&turma$i=$result[4]";



                            $i++;

                        }
                     $this->resultado = "ok";
                
                     
                     
     }

     public function select_prova($codigo,$session,$cod_avaliacao){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT resposta FROM prova WHERE numero = '$codigo' AND session = '$session' AND cod_avaliacao = '$cod_avaliacao'",$conn) or die ("Error na consulta" .mysql_error());

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{	


                $result = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash


                            
                            echo "&resposta=$result[0]";
                            
                            
                           
                          

                        
                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function select_prova_questao($codigo,$cod_avaliacao){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT resposta FROM questao WHERE numero = '$codigo' AND cod_avaliacao = '$cod_avaliacao'",$conn) or die ("Error na consulta" .mysql_error());

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{


                $result = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash



                            echo "&resposta=$result[0]";






                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function update_prova($nome,$cod_professor,$cod_curso,$cod_turma,$codigo)
     {

       
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         
                     $query_insert = mysql_query("UPDATE prova SET nome = '$nome',  cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma' WHERE cod_prova = '$codigo'") or die ("Erro update". mysql_errno());

                     $query_grid = mysql_query("SELECT cod_prova, curso.nome, prova.nome, professor.nome, turma.nome FROM prova, professor, curso, turma WHERE prova.cod_professor = professor.cod_professor AND prova.cod_curso = curso.cod_curso AND turma.cod_turma = prova.cod_turma ORDER BY prova.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&prova$i=$result[2]";
                            echo "&professor$i=$result[3]";
                            echo "&turma$i=$result[4]";



                            $i++;

                        }



                     $this->resultado = "ok";
               
     }// fim do método

     public function resultado_prova($codigo,$session,$cod_aluno){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT  SUM(peso)FROM questao, prova WHERE questao.resposta = prova.resposta AND prova.cod_avaliacao = questao.cod_avaliacao AND questao.numero = prova.numero AND prova.cod_avaliacao = '$codigo' AND prova.session = '$session'") or die ("Error na consulta" .mysql_error());

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{


                $result = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash


                            echo "&nota=$result[0]";

                            $data = date("Y-m-d");
                            $tempo = date('H:m:s');

        $query_insert = mysql_query("INSERT INTO resultado VALUE (NULL, '$cod_aluno','$codigo', '$data', '$tempo','$result[0]')") or die ("Erro insert prova ". mysql_erro());


                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function select_grid_resultado($session,$cod_professor,$cod_avaliacao) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash


                    // zerando contadores
                    $i = 0;

                   $query_grid = mysql_query("SELECT matricula, aluno.nome, curso.nome, turma.nome, disciplina.nome, nota, minima FROM aluno, curso, turma, disciplina, resultado, avaliacao WHERE resultado.cod_aluno = aluno.cod_aluno AND avaliacao.cod_curso = curso.cod_curso AND turma.cod_turma = avaliacao.cod_turma AND avaliacao.cod_disciplina = disciplina.cod_disciplina and avaliacao.cod_professor = disciplina.cod_professor AND resultado.cod_avaliacao = avaliacao.cod_avaliacao AND avaliacao.cod_professor = '$cod_professor'AND avaliacao.cod_avaliacao = '$cod_avaliacao' ORDER BY aluno.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&aluno$i=$result[1]";
                            echo "&curso$i=$result[2]";
                            echo "&turma$i=$result[3]";
                            echo "&disciplina$i=$result[4]";
                            echo "&nota$i=$result[5]";


                            if($result[5]>= $result[6])
                             echo "&situacao$i=aprovado";
                            else
                            echo "&situacao$i=reprovado";
                            $i++;

                        }
                     $this->resultado = "ok";



     }


     public function select_grid_resultado2($session,$cod_aluno,$cod_turma) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash


                    // zerando contadores
                    $i = 0;

                   $query_grid = mysql_query("SELECT matricula, aluno.nome, curso.nome, turma.nome, disciplina.nome, nota, minima FROM aluno, curso, turma, disciplina, resultado, avaliacao WHERE resultado.cod_aluno = aluno.cod_aluno AND avaliacao.cod_curso = curso.cod_curso AND turma.cod_turma = avaliacao.cod_turma AND avaliacao.cod_disciplina = disciplina.cod_disciplina and avaliacao.cod_professor = disciplina.cod_professor AND resultado.cod_avaliacao = avaliacao.cod_avaliacao AND resultado.cod_aluno = '$cod_aluno'AND avaliacao.cod_turma = '$cod_turma' ORDER BY aluno.nome",$conn) or die ("Error na consulta1" . mysql_error());

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&aluno$i=$result[1]";
                            echo "&curso$i=$result[2]";
                            echo "&turma$i=$result[3]";
                            echo "&disciplina$i=$result[4]";
                            echo "&nota$i=$result[5]";


                            if($result[5]>= $result[6])
                             echo "&situacao$i=aprovado";
                            else
                            echo "&situacao$i=reprovado";
                            $i++;

                        }
                     $this->resultado = "ok";



     }

     
}
?>
