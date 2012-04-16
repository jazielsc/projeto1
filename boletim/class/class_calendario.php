<?php

/**
 * classe para manipulação dos dados referente aos calendarios
 *
 * @author Administrador
 */
class Class_calendario
{


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

                   
     public function insert_calendario($dia,$inicio,$termino,$cod_turma,$cod_disciplina,$cod_professor,$calendario,$dia_numero,$cod_curso)
     {


         if(!empty($dia)){ // testando se foi passado algum valor para variável

                $dia = explode("/", $dia);
                $dia = $dia[2]."-".$dia[1]."-".$dia[0];

                } else {

                    $dia = '0000-00-00';
                }


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_calendario FROM calendario WHERE calendario = '$calendario' AND dia = '$dia' AND cod_professor = '$cod_professor' AND cod_disciplina = '$cod_disciplina' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 $this->resultado = "NAO"; 
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO calendario VALUE (NULL, '$dia','$inicio','$termino','$cod_turma', '$cod_disciplina', '$cod_professor', '$calendario', '$dia_numero', '$cod_curso')") or die ("Erro insert1 ". mysql_erro());
                     
                    $query_grid = mysql_query("SELECT cod_calendario, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM calendario, disciplina, professor, turma WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor AND calendario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND calendario.cod_turma = turma.cod_turma AND calendario.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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
     }// fim do método

     public function select_grid_calendario($cod_turma) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                   
                   $query_grid = mysql_query("SELECT cod_calendario, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM calendario, disciplina, professor, turma WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor AND calendario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND calendario.cod_turma = turma.cod_turma AND calendario.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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

     public function select_grid_calendario_unidade($cod_turma,$unidade) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_calendario, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM calendario, disciplina, professor, turma WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor AND calendario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND calendario.cod_turma = turma.cod_turma AND calendario.cod_professor = professor.cod_professor AND dia_numero = '$unidade' ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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


     public function select_grid_calendario_professor($cod_professor) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_calendario, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM calendario, disciplina, professor, turma WHERE professor.cod_professor = '$cod_professor' AND disciplina.cod_professor = professor.cod_professor AND calendario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND calendario.cod_turma = turma.cod_turma AND calendario.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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


     public function select_grid_calendario_professor2($cod_professor,$semestre) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_calendario, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM calendario, disciplina, professor, turma WHERE professor.cod_professor = '$cod_professor' AND semestre = '$semestre' AND disciplina.cod_professor = professor.cod_professor AND calendario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND calendario.cod_turma = turma.cod_turma AND calendario.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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

     public function select_grid_calendario_aluno($semestre) { // método para preenchimento da grid no form

         session_start();
     $cod_aluno = $_SESSION['id_aluno_professor'];

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_calendario, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM calendario, disciplina, professor, turma, aluno, item2 WHERE item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND item2.cod_aluno = '$cod_aluno' AND semestre = '$semestre' AND disciplina.cod_professor = professor.cod_professor AND calendario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND calendario.cod_turma = turma.cod_turma AND calendario.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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


     public function select_grid_calendario_aluno_unidade($unidade) { // método para preenchimento da grid no form

         session_start();
     $cod_aluno = $_SESSION['id_aluno_professor'];

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_calendario, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM calendario, disciplina, professor, turma, aluno, item2 WHERE item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND item2.cod_aluno = '$cod_aluno' AND dia_numero = '$unidade' AND disciplina.cod_professor = professor.cod_professor AND calendario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND calendario.cod_turma = turma.cod_turma AND calendario.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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


     public function select_grid_calendario_professor_logado($semestre) { // método para preenchimento da grid no form

         session_start();
     $cod_professor = $_SESSION['id_aluno_professor'];

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_calendario, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM calendario, disciplina, professor, turma WHERE professor.cod_professor = '$cod_professor' AND semestre = '$semestre' AND disciplina.cod_professor = professor.cod_professor AND calendario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND calendario.cod_turma = turma.cod_turma AND calendario.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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


     public function select_grid_calendario_professor_logado_unidade($unidade) { // método para preenchimento da grid no form

         session_start();
     $cod_professor = $_SESSION['id_aluno_professor'];

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_calendario, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM calendario, disciplina, professor, turma WHERE professor.cod_professor = '$cod_professor' AND dia_numero = '$unidade' AND disciplina.cod_professor = professor.cod_professor AND calendario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND calendario.cod_turma = turma.cod_turma AND calendario.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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


     
     public function select_calendario($codigo){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT cod_calendario, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.cod_disciplina, disciplina.nome, professor.cod_professor, professor.nome, turma.cod_turma, turma.nome, curso.cod_curso, curso.nome, dia_numero FROM calendario, disciplina, professor, turma, curso WHERE calendario.cod_curso = curso.cod_curso AND disciplina.cod_curso = curso.cod_curso AND turma.cod_curso = curso.cod_curso AND  calendario.cod_calendario = '$codigo' AND disciplina.cod_professor = professor.cod_professor AND calendario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND calendario.cod_turma = turma.cod_turma AND calendario.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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


     public function update_calendario($dia,$inicio,$termino,$cod_turma,$cod_disciplina,$cod_professor,$calendario,$dia_numero,$cod_curso,$codigo)
     {

         if(!empty($dia)){ // testando se foi passado algum valor para variável

                $dia = explode("/", $dia);
                $dia = $dia[2]."-".$dia[1]."-".$dia[0];

                } else {

                    $dia = '0000-00-00';
                }

       
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         
                     $query_insert = mysql_query("UPDATE calendario SET dia = '$dia', inicio = '$inicio', termino = '$termino', cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma', cod_disciplina = '$cod_disciplina', calendario = '$calendario', dia_numero = '$dia_numero' WHERE cod_calendario = '$codigo'") or die ("Erro update". mysql_errno());

                     $query_grid = mysql_query("SELECT cod_calendario, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM calendario, disciplina, professor, turma WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor AND calendario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND calendario.cod_turma = turma.cod_turma AND calendario.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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



     public function delete_calendario($codigo,$cod_turma)
     {


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");




                    $query_delete = mysql_query("DELETE FROM calendario WHERE cod_calendario = '$codigo'");

                     $query_grid = mysql_query("SELECT cod_calendario, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM calendario, disciplina, professor, turma WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor AND calendario.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND calendario.cod_turma = turma.cod_turma AND calendario.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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
