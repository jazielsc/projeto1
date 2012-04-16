<?php

/**
 * classe para manipulação dos dados referente aos horarios
 *
 * @author Administrador
 */
class Class_horario
{


     public $cod_horario;
     public $cod_professor;
     public $cod_turma;
     public $cod_disciplina;
     public $dia;
     public $inicio;
     public $termino;
     public $horario;
     public $dia_numero;
     public $cod_curso;

                   
     public function insert_horario($dia,$inicio,$termino,$cod_turma,$cod_disciplina,$cod_professor,$horario,$dia_numero,$cod_curso)
     {

        
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_horario FROM horario WHERE horario = '$horario' AND dia = '$dia' AND cod_professor = '$cod_professor' AND cod_disciplina = '$cod_disciplina' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 $this->resultado = "NAO"; 
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO horario VALUE (NULL, '$dia','$inicio','$termino','$cod_turma', '$cod_disciplina', '$cod_professor', '$horario', '$dia_numero', '$cod_curso')") or die ("Erro insert1 ". mysql_erro());
                     
                    $query_grid = mysql_query("SELECT cod_horario, dia, inicio, termino, horario, disciplina.nome, professor.nome, turma.nome FROM horario, disciplina, professor, turma WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor AND horario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND horario.cod_turma = turma.cod_turma AND horario.cod_professor = professor.cod_professor ORDER BY  dia_numero, horario, inicio",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&dia$i=$result[1]";
                            echo "&horario$i=$result[4] - $result[2] - $result[3]";
                            echo "&disciplina$i=$result[5]";
                            echo "&professor$i=$result[6]";
                            
                           
                            
                            $i++;

                        }

                   
                 //  $query_disciplina = mysql_query("SELECT cod_disciplina FROM disciplina ORDER BY cod_disciplina DESC LIMIT 0,1");
                 //  $fim = mysql_fetch_array($query_disciplina);

                  // $query_alunos = mysql_query("SELECT cod_aluno FROM item WHERE cod_turma = '$cod_turma'");
                  //  while ($resultado = mysql_fetch_array($query_alunos))
                  //      {
                        
                  //  $query_inserir = mysql_query("INSERT INTO item2 VALUE(NULL,'$fim[0]]','$resultado[0]',1)");
                        
                   //     }


                     $this->resultado = "ok";
                }
     }// fim do método

     public function select_grid_horario($cod_turma) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                   
                   $query_grid = mysql_query("SELECT cod_horario, dia, inicio, termino, horario, disciplina.nome, professor.nome, turma.nome FROM horario, disciplina, professor, turma WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor AND horario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND horario.cod_turma = turma.cod_turma AND horario.cod_professor = professor.cod_professor ORDER BY  dia_numero, horario, inicio",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&dia$i=$result[1]";
                            echo "&horario$i=$result[4] - $result[2] - $result[3]";
                            echo "&disciplina$i=$result[5]";
                            echo "&professor$i=$result[6]";



                            $i++;

                        }
                          $this->resultado = "ok";
                
                     
                     
     }

     public function select_grid_horario_professor($cod_professor,$ano) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                     if($ano != ""){
                         $where = " AND YEAR(turma.data) = '$ano'";
                     } else{
                        $where = "";
                     }

                   $query_grid = mysql_query("SELECT cod_horario, dia, inicio, termino, horario, disciplina.nome, professor.nome, turma.nome FROM horario, disciplina, professor, turma WHERE professor.cod_professor = '$cod_professor' AND disciplina.cod_professor = professor.cod_professor AND horario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND horario.cod_turma = turma.cod_turma AND horario.cod_professor = professor.cod_professor $where ORDER BY  dia_numero, horario, inicio",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&dia$i=$result[1]";
                            echo "&horario$i=$result[4] - $result[2] - $result[3]";
                            echo "&disciplina$i=$result[5]";
                            echo "&professor$i=$result[6]";
                             echo "&turma$i=$result[7]";



                            $i++;

                        }
                          $this->resultado = "ok";



     }


     public function select_grid_horario_professor2($cod_professor,$semestre) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_horario, dia, inicio, termino, horario, disciplina.nome, professor.nome, turma.nome FROM horario, disciplina, professor, turma WHERE professor.cod_professor = '$cod_professor' AND semestre = '$semestre' AND disciplina.cod_professor = professor.cod_professor AND horario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND horario.cod_turma = turma.cod_turma AND horario.cod_professor = professor.cod_professor ORDER BY  dia_numero, horario, inicio",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&dia$i=$result[1]";
                            echo "&horario$i=$result[4] - $result[2] - $result[3]";
                            echo "&disciplina$i=$result[5]";
                            echo "&professor$i=$result[6]";



                            $i++;

                        }
                          $this->resultado = "ok";



     }

     public function select_grid_horario_aluno($semestre) { // método para preenchimento da grid no form

         session_start();
     $cod_aluno = $_SESSION['id_aluno_professor'];

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_horario, dia, inicio, termino, horario, disciplina.nome, professor.nome, turma.nome FROM horario, disciplina, professor, turma, aluno, item2 WHERE item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND item2.cod_aluno = '$cod_aluno' AND semestre = '$semestre' AND disciplina.cod_professor = professor.cod_professor AND horario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND horario.cod_turma = turma.cod_turma AND horario.cod_professor = professor.cod_professor ORDER BY  dia_numero, horario, inicio",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&dia$i=$result[1]";
                            echo "&horario$i=$result[4] - $result[2] - $result[3]";
                            echo "&disciplina$i=$result[5]";
                            echo "&professor$i=$result[6]";
                            echo "&turma$i=$result[7]";



                            $i++;

                        }
                          $this->resultado = "ok";



     }


     public function select_grid_horario_professor_logado($semestre) { // método para preenchimento da grid no form

         session_start();
     $cod_professor = $_SESSION['id_aluno_professor'];

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_horario, dia, inicio, termino, horario, disciplina.nome, professor.nome, turma.nome FROM horario, disciplina, professor, turma WHERE professor.cod_professor = '$cod_professor' AND semestre = '$semestre' AND disciplina.cod_professor = professor.cod_professor AND horario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND horario.cod_turma = turma.cod_turma AND horario.cod_professor = professor.cod_professor ORDER BY  dia_numero, horario, inicio",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&dia$i=$result[1]";
                            echo "&horario$i=$result[4] - $result[2] - $result[3]";
                            echo "&disciplina$i=$result[5]";
                            echo "&professor$i=$result[6]";
                             echo "&turma$i=$result[7]";



                            $i++;

                        }
                          $this->resultado = "ok";



     }


     
     public function select_horario($codigo){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT cod_horario, dia, inicio, termino, horario, disciplina.cod_disciplina, disciplina.nome, professor.cod_professor, professor.nome, turma.cod_turma, turma.nome, curso.cod_curso, curso.nome, dia_numero FROM horario, disciplina, professor, turma, curso WHERE horario.cod_curso = curso.cod_curso AND disciplina.cod_curso = curso.cod_curso AND turma.cod_curso = curso.cod_curso AND  horario.cod_horario = '$codigo' AND disciplina.cod_professor = professor.cod_professor AND horario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND horario.cod_turma = turma.cod_turma AND horario.cod_professor = professor.cod_professor ORDER BY  dia_numero, horario, inicio",$conn) or die ("Error na consulta1");

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{	


                $result = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo=$result[0]";
                            echo "&dia=$result[1]";
                            echo "&inicio=$result[2]";
                            echo "&termino=$result[3]";
                            echo "&horario=$result[4]";
                            echo "&cod_disciplina=$result[5]";
                            echo "&nome_disciplina=$result[6]";
                            echo "&cod_professor=$result[7]";
                            echo "&nome_professor=$result[8]";
                            echo "&cod_turma=$result[9]";
                            echo "&nome_turma=$result[10]";
                            echo "&cod_curso=$result[11]";
                            echo "&nome_curso=$result[12]";
                            echo "&dia_numero=$result[13]";
                            
                        
                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function update_horario($dia,$inicio,$termino,$cod_turma,$cod_disciplina,$cod_professor,$horario,$dia_numero,$cod_curso,$codigo)
     {

       
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         
                     $query_insert = mysql_query("UPDATE horario SET dia = '$dia', inicio = '$inicio', termino = '$termino', cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma', cod_disciplina = '$cod_disciplina', horario = '$horario', dia_numero = '$dia_numero' WHERE cod_horario = '$codigo'") or die ("Erro update". mysql_errno());

                     $query_grid = mysql_query("SELECT cod_horario, dia, inicio, termino, horario, disciplina.nome, professor.nome, turma.nome FROM horario, disciplina, professor, turma WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor AND horario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND horario.cod_turma = turma.cod_turma AND horario.cod_professor = professor.cod_professor ORDER BY  dia_numero, horario, inicio",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&dia$i=$result[1]";
                            echo "&horario$i=$result[4] - $result[2] - $result[3]";
                            echo "&disciplina$i=$result[5]";
                            echo "&professor$i=$result[6]";



                            $i++;

                        }



                     $this->resultado = "ok";
               
     }// fim do método

     public function delete_horario($codigo,$cod_turma)
     {


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");




                    $query_delete = mysql_query("DELETE FROM horario WHERE cod_horario = '$codigo'");

                     $query_grid = mysql_query("SELECT cod_horario, dia, inicio, termino, horario, disciplina.nome, professor.nome, turma.nome FROM horario, disciplina, professor, turma WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor AND horario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND horario.cod_turma = turma.cod_turma AND horario.cod_professor = professor.cod_professor ORDER BY  dia_numero, horario, inicio",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&dia$i=$result[1]";
                            echo "&horario$i=$result[4] - $result[2] - $result[3]";
                            echo "&disciplina$i=$result[5]";
                            echo "&professor$i=$result[6]";



                            $i++;

                        }



                     $this->resultado = "ok";

                 

     }// fim do método


}
?>
