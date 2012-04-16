<?php

/**
 * classe para manipulação dos dados referente ao disciplina
 *
 * @author Administrador
 */
class Class_disciplina
{


     public $cod_disciplina;
     public $nome;
     public $cod_professor;
     public $cod_curso;
     public $cod_turma;
     public $carga_horaria;
     public $numero_faltas;

                   
     public function insert_disciplina($nome,$cod_professor,$cod_curso,$cod_turma,$carga_horaria,$numero_faltas)
     {

        session_start();
                      $cod_instituicao = (int) $_SESSION['id_instituicao'];
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_disciplina FROM disciplina WHERE nome = '$nome' AND cod_professor = '$cod_professor' AND cod_curso = '$cod_curso' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 $this->resultado = "NAO"; 
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO disciplina VALUE (NULL, '$nome','$cod_professor','$cod_curso','$cod_turma','$carga_horaria','$numero_faltas')") or die ("Erro insert1 ". mysql_erro());
                     
                    $query_grid = mysql_query("SELECT cod_disciplina, curso.nome, disciplina.nome, professor.nome, turma.nome FROM disciplina, professor, curso, turma WHERE disciplina.cod_professor = professor.cod_professor AND disciplina.cod_curso = curso.cod_curso AND turma.cod_turma = disciplina.cod_turma AND curso.cod_instituicao = '$cod_instituicao' ORDER BY disciplina.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&disciplina$i=$result[2]";
                            echo "&professor$i=$result[3]";
                            echo "&turma$i=$result[4]";
                            
                           
                            
                            $i++;

                        }

                   
                   $query_disciplina = mysql_query("SELECT cod_disciplina FROM disciplina ORDER BY cod_disciplina DESC LIMIT 0,1");
                   $fim = mysql_fetch_array($query_disciplina);

                  // $query_alunos = mysql_query("SELECT cod_aluno FROM item WHERE cod_turma = '$cod_turma'");
                  //  while ($resultado = mysql_fetch_array($query_alunos))
                  //      {
                        
                  //  $query_inserir = mysql_query("INSERT INTO item2 VALUE(NULL,'$fim[0]]','$resultado[0]',1)");
                        
                   //     }


                     $this->resultado = "ok";
                }
     }// fim do método

     public function select_grid_disciplina() { // método para preenchimento da grid no form

         session_start();
                      $cod_instituicao = (int) $_SESSION['id_instituicao'];
                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                   
                   $query_grid = mysql_query("SELECT cod_disciplina, curso.nome, disciplina.nome, professor.nome, turma.nome FROM disciplina, professor, curso, turma WHERE disciplina.cod_professor = professor.cod_professor AND disciplina.cod_curso = curso.cod_curso AND turma.cod_turma = disciplina.cod_turma AND curso.cod_instituicao = '$cod_instituicao' ORDER BY disciplina.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&disciplina$i=$result[2]";
                            echo "&professor$i=$result[3]";
                            echo "&turma$i=$result[4]";



                            $i++;

                        }
                     $this->resultado = "ok";
                
                     
                     
     }

     public function select_grid_disciplina2() { // método para preenchimento da grid no form

         session_start();
                      $cod_instituicao = (int) $_SESSION['id_instituicao'];
                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                    
                   $query_grid = mysql_query("SELECT cod_disciplina, curso.nome, disciplina.nome, professor.nome, turma.nome FROM disciplina, professor, curso, turma WHERE disciplina.cod_professor = professor.cod_professor AND disciplina.cod_curso = curso.cod_curso AND turma.cod_turma = disciplina.cod_turma AND curso.cod_instituicao = '$cod_instituicao' ORDER BY disciplina.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&disciplina$i=$result[2]";
                            echo "&professor$i=$result[3]";
                            echo "&turma$i=$result[4]";



                            $i++;

                        }
                     $this->resultado = "ok";



     }

     public function select_disciplina($codigo){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT cod_disciplina, professor.cod_professor, professor.nome, curso.cod_curso, curso.nome, turma.cod_turma, turma.nome, disciplina.nome, carga_horaria, numero_faltas FROM disciplina, professor, curso, turma WHERE disciplina.cod_professor = professor.cod_professor AND disciplina.cod_curso = curso.cod_curso AND disciplina.cod_turma = turma.cod_turma AND cod_disciplina = '$codigo' ORDER BY disciplina.nome",$conn) or die ("Error na consulta" .mysql_error());

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{	


                $result = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo=$result[0]";
                            echo "&cod_professor=$result[1]";
                            echo "&nome_professor=$result[2]";
                            echo "&cod_curso=$result[3]";
                            echo "&nome_curso=$result[4]";
                            echo "&cod_turma=$result[5]";
                            echo "&nome_turma=$result[6]";
                            echo "&nome=$result[7]";
                            echo "&cargahoraria=$result[8]";
                            echo "&numero_faltas=$result[9]";
                           
                          

                        
                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function update_disciplina($nome,$cod_professor,$cod_curso,$cod_turma,$codigo,$carga_horaria,$numero_faltas)
     {

       
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         
                     $query_insert = mysql_query("UPDATE disciplina SET nome = '$nome',  cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma', carga_horaria = '$carga_horaria', numero_faltas = '$numero_faltas' WHERE cod_disciplina = '$codigo'") or die ("Erro update". mysql_errno());

                     $query_grid = mysql_query("SELECT cod_disciplina, curso.nome, disciplina.nome, professor.nome, turma.nome FROM disciplina, professor, curso, turma WHERE disciplina.cod_professor = professor.cod_professor AND disciplina.cod_curso = curso.cod_curso AND turma.cod_turma = disciplina.cod_turma ORDER BY disciplina.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&disciplina$i=$result[2]";
                            echo "&professor$i=$result[3]";
                            echo "&turma$i=$result[4]";



                            $i++;

                        }



                     $this->resultado = "ok";
               
     }// fim do método
}
?>
