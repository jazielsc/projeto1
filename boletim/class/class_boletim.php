<?php
header("Content-Type:text/html; charset=ISO-8859-1",true);

/**
 * classe para manipulação dos dados referente ao boletim
 *
 * @author Administrador
 */
class Class_boletim
{


     public $cod_boletim;
     public $nota_1;
	 public $nota_2;
	 public $nota_3;
	 public $nota_4;
	 public $nota_5;
	 public $nota_6;
	 public $media;
	 public $faltas;
     public $cod_curso;
     public $cod_turma;
	 public $cod_disciplina;
	 public $cod_professor;	
     public $cod_aluno;
     public $unidade;
     
	 public function insert_notas($nota_1,$nota_2,$nota_3,$nota_4,$nota_5,$nota_6,$numero_avaliacoes,$faltas,$cod_aluno,$cod_professor,$cod_curso,$cod_turma,$cod_disciplina,$unidade,$select=1)
     {


         $media = 0;

         $media = ($nota_1 + $nota_2 + $nota_3 + $nota_4 + $nota_5 + $nota_6) / $numero_avaliacoes;

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

     session_start();
     $cod_instituicao = (int) $_SESSION['id_instituicao'];

     $query = mysql_query("SELECT media FROM config WHERE cod_instituicao = '$cod_instituicao'") or die (mysql_error());
     $resultado = mysql_fetch_array($query);

     echo "&media_curso=$resultado[0]";


         $query_select = mysql_query("SELECT cod_boletim FROM boletim WHERE cod_aluno = '$cod_aluno' AND cod_professor = '$cod_professor' AND cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' AND unidade = '$unidade'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 $this->resultado = "NAO"; 
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO boletim VALUE (NULL, '$nota_1', '$nota_2', '$nota_3', '$nota_4', '$nota_5', '$nota_6', '$numero_avaliacoes', '$faltas', '$media', '$cod_curso', '$cod_turma', '$cod_disciplina', '$cod_professor', '$cod_aluno','$unidade')") or die ("Erro insert1 ". mysql_erro());
                     
                  
                     if($select == 1){

                     $query_grid = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' ORDER BY aluno.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&nota_01$i=$result[2]";
                            echo "&nota_02$i=$result[3]";
                            echo "&nota_03$i=$result[4]";
                            echo "&nota_04$i=$result[5]";
                            echo "&nota_05$i=$result[6]";
                            echo "&nota_06$i=$result[7]";
                            echo "&media$i=$result[8]";
                            echo "&faltas$i=$result[9]";
                            echo "&unidade$i=$result[10]";

                                                   
                            
                            $i++;

                        }

                     } else{


                         $query_grid = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' AND boletim.cod_aluno = '$cod_aluno' ORDER BY aluno.nome",$conn) or die (mysql_error(). " Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&nota_01$i=$result[2]";
                            echo "&nota_02$i=$result[3]";
                            echo "&nota_03$i=$result[4]";
                            echo "&nota_04$i=$result[5]";
                            echo "&nota_05$i=$result[6]";
                            echo "&nota_06$i=$result[7]";
                            echo "&media$i=$result[8]";
                            echo "&faltas$i=$result[9]";
                            echo "&unidade$i=$result[10]";



                            $i++;

                        }


                     }
                   

                     $this->resultado = "ok";
                }
     }// fim do método


     public function update_notas($nota_1,$nota_2,$nota_3,$nota_4,$nota_5,$nota_6,$numero_avaliacoes,$faltas,$cod_aluno,$cod_professor,$cod_curso,$cod_turma,$cod_disciplina,$codigo,$unidade,$select)
     {


         $media = 0;

         $media = ($nota_1 + $nota_2 + $nota_3 + $nota_4 + $nota_5 + $nota_6) / $numero_avaliacoes;

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

     session_start();
     $cod_instituicao = (int) $_SESSION['id_instituicao'];

     $query = mysql_query("SELECT media FROM config WHERE cod_instituicao = '$cod_instituicao'") or die (mysql_error());
     $resultado = mysql_fetch_array($query);

     echo "&media_curso=$resultado[0]";


         $query_select = mysql_query("SELECT cod_boletim FROM boletim WHERE cod_aluno = '$cod_aluno' AND cod_professor = '$cod_professor' AND cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 
                    $query_update = mysql_query("UPDATE boletim SET nota_01 = '$nota_1', nota_02 = '$nota_2', nota_03 = '$nota_3', nota_04 = '$nota_4', nota_05 = '$nota_5', nota_06 = '$nota_6', n_avaliacoes  = '$numero_avaliacoes', faltas = '$faltas', media = '$media', unidade = '$unidade' WHERE cod_boletim = '$codigo'") or die ("Erro insert1 ". mysql_erro());

                    if($select == 1){

                    $query_grid = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' ORDER BY aluno.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&nota_01$i=$result[2]";
                            echo "&nota_02$i=$result[3]";
                            echo "&nota_03$i=$result[4]";
                            echo "&nota_04$i=$result[5]";
                            echo "&nota_05$i=$result[6]";
                            echo "&nota_06$i=$result[7]";
                            echo "&media$i=$result[8]";
                            echo "&faltas$i=$result[9]";
                            echo "&unidade$i=$result[10]";



                            $i++;

                        }

                    }else{


                         $query_grid = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' AND boletim.cod_aluno = '$cod_aluno' ORDER BY aluno.nome",$conn) or die (mysql_error(). " Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&nota_01$i=$result[2]";
                            echo "&nota_02$i=$result[3]";
                            echo "&nota_03$i=$result[4]";
                            echo "&nota_04$i=$result[5]";
                            echo "&nota_05$i=$result[6]";
                            echo "&nota_06$i=$result[7]";
                            echo "&media$i=$result[8]";
                            echo "&faltas$i=$result[9]";
                            echo "&unidade$i=$result[10]";



                            $i++;

                        }


                     }



                     $this->resultado = "ok";
                }
     }// fim do método

     public function select_grid_boletim($cod_curso,$cod_turma,$semestre){

     if($semestre != ""){
    $where = "AND semestre = '$semestre' AND disciplina.cod_turma = turma.cod_turma AND boletim.cod_turma = turma.cod_turma AND turma.cod_curso = boletim.cod_curso AND turma.cod_curso = disciplina.cod_curso";
    $tabela = ",turma";
    } else{
    $where = "";
    $tabela = "";
    }


     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
     session_start();
     $cod_aluno = $_SESSION['id_aluno_professor'];
     $cod_instituicao = (int) $_SESSION['id_instituicao'];

     $query = mysql_query("SELECT media FROM config WHERE cod_instituicao = '$cod_instituicao'") or die (mysql_error());
     $resultado = mysql_fetch_array($query);

     echo "&media_curso=$resultado[0]";


      $query_grid = mysql_query("SELECT cod_boletim, disciplina.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM disciplina, boletim $tabela WHERE disciplina.cod_disciplina = boletim.cod_disciplina AND boletim.cod_curso = disciplina.cod_curso AND boletim.cod_turma = disciplina.cod_turma AND boletim.cod_curso = '$cod_curso' AND boletim.cod_turma = '$cod_turma' AND boletim.cod_aluno = '$cod_aluno' $where",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&nota_01$i=$result[2]";
                            echo "&nota_02$i=$result[3]";
                            echo "&nota_03$i=$result[4]";
                            echo "&nota_04$i=$result[5]";
                            echo "&nota_05$i=$result[6]";
                            echo "&nota_06$i=$result[7]";
                            echo "&media$i=$result[8]";
                            echo "&faltas$i=$result[9]";
                            echo "&unidade$i=$result[10]";



                            $i++;

                        }




                     $this->resultado = "ok";
                } // fim do método



     public function select_grid_notas($cod_professor,$cod_curso,$cod_turma,$cod_disciplina){

     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

     session_start();
     $cod_instituicao = (int) $_SESSION['id_instituicao'];

     $query = mysql_query("SELECT media FROM config WHERE cod_instituicao = '$cod_instituicao'") or die (mysql_error());
     $resultado = mysql_fetch_array($query);

     echo "&media_curso=$resultado[0]";


      $query_grid = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' ORDER BY aluno.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&nota_01$i=$result[2]";
                            echo "&nota_02$i=$result[3]";
                            echo "&nota_03$i=$result[4]";
                            echo "&nota_04$i=$result[5]";
                            echo "&nota_05$i=$result[6]";
                            echo "&nota_06$i=$result[7]";
                            echo "&media$i=$result[8]";
                            echo "&faltas$i=$result[9]";
                            echo "&unidade$i=$result[10]";



                            $i++;

                        }




                     $this->resultado = "ok";
                } // fim do método



                public function select_grid_notas_aluno($cod_professor,$cod_curso,$cod_turma,$cod_disciplina,$cod_aluno){

     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

     session_start();
     $cod_instituicao = (int) $_SESSION['id_instituicao'];

     $query = mysql_query("SELECT media FROM config WHERE cod_instituicao = '$cod_instituicao'") or die (mysql_error());
     $resultado = mysql_fetch_array($query);

     echo "&media_curso=$resultado[0]";


      $query_grid = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' AND boletim.cod_aluno = '$cod_aluno' ORDER BY aluno.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&nota_01$i=$result[2]";
                            echo "&nota_02$i=$result[3]";
                            echo "&nota_03$i=$result[4]";
                            echo "&nota_04$i=$result[5]";
                            echo "&nota_05$i=$result[6]";
                            echo "&nota_06$i=$result[7]";
                            echo "&media$i=$result[8]";
                            echo "&faltas$i=$result[9]";
                            echo "&unidade$i=$result[10]";



                            $i++;

                        }




                     $this->resultado = "ok";
                } // fim do método



                public function select_notas($cod_boletim){

     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

      $query_grid = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, matricula, n_avaliacoes, unidade, aluno.cod_aluno FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_boletim = '$cod_boletim'",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    $result = mysql_fetch_array($query_grid);
                         // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo=$result[0]";
                            echo "&nome=$result[1]";
                            echo "&nota_01=$result[2]";
                            echo "&nota_02=$result[3]";
                            echo "&nota_03=$result[4]";
                            echo "&nota_04=$result[5]";
                            echo "&nota_05=$result[6]";
                            echo "&nota_06=$result[7]";
                            echo "&media=$result[8]";
                            echo "&faltas=$result[9]";
                            echo "&matricula=$result[10]";
                            echo "&n_avaliacoes=$result[11]";
                             echo "&unidade=$result[12]";
                             echo "&cod_aluno=$result[13]";



                     $this->resultado = "ok";
                } // fim do método


     public function select_grid_alunos($cod_disciplina,$cod_professor) { // método para preenchimento da grid no form

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT aluno.cod_aluno, aluno.nome, disciplina.nome FROM item2, disciplina, aluno WHERE item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND item2.cod_disciplina = '$cod_disciplina' AND cod_professor = '$cod_professor' AND item2.cod_status = 1 ORDER BY aluno.nome",$conn) or die ("Error na consulta");

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



     }

     public function select_grid_disciplina_professor($cod_curso,$cod_turma,$cod_aluno) { // método para preenchimento da grid no form

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT disciplina.cod_disciplina, disciplina.nome, professor.cod_professor, professor.nome FROM curso, turma, item2, professor, aluno, disciplina WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor  AND curso.cod_curso = turma.cod_curso AND curso.cod_curso = disciplina.cod_curso AND item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_aluno = aluno.cod_aluno AND item2.cod_aluno = '$cod_aluno' AND curso.cod_curso = '$cod_curso' AND item2.cod_status = 1 ORDER BY disciplina.nome",$conn) or die (mysql_error(). " Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&cod_disciplina$i=$result[0]";
                            echo "&disciplina$i=$result[1]";
                            echo "&cod_professor$i=$result[2]";
                            echo "&professor$i=$result[3]";


                            $i++;

                        }


                     $this->resultado = "ok";



     }


     public function select_disciplina($codigo){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT cod_disciplina, professor.cod_professor, professor.nome, curso.cod_curso, curso.nome, turma.cod_turma, turma.nome, disciplina.nome FROM disciplina, professor, curso, turma WHERE disciplina.cod_professor = professor.cod_professor AND disciplina.cod_curso = curso.cod_curso AND disciplina.cod_turma = turma.cod_turma AND cod_disciplina = '$codigo' ORDER BY disciplina.nome",$conn) or die ("Error na consulta" .mysql_error());

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
                           
                          

                        
                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function update_disciplina($nome,$cod_professor,$cod_curso,$cod_turma,$codigo)
     {

       
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         
                     $query_insert = mysql_query("UPDATE disciplina SET nome = '$nome',  cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma' WHERE cod_disciplina = '$codigo'") or die ("Erro update". mysql_errno());

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


     public function delete_notas($codigo,$cod_professor,$cod_curso,$cod_turma,$cod_disciplina,$select){
        
          include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

          session_start();
     $cod_instituicao = (int) $_SESSION['id_instituicao'];

     $query = mysql_query("SELECT media FROM config WHERE cod_instituicao = '$cod_instituicao'") or die (mysql_error());
     $resultado = mysql_fetch_array($query);

     echo "&media_curso=$resultado[0]";

          
          $query_delete = mysql_query("DELETE FROM boletim WHERE cod_boletim = '$codigo'");

         $query_grid = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' ORDER BY aluno.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    if ($select == 1){

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&nota_01$i=$result[2]";
                            echo "&nota_02$i=$result[3]";
                            echo "&nota_03$i=$result[4]";
                            echo "&nota_04$i=$result[5]";
                            echo "&nota_05$i=$result[6]";
                            echo "&nota_06$i=$result[7]";
                            echo "&media$i=$result[8]";
                            echo "&faltas$i=$result[9]";
                            echo "&unidade$i=$result[10]";



                            $i++;

                        }
                    }else{


                         $query_grid = mysql_query("SELECT cod_boletim, aluno.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM aluno, boletim WHERE  aluno.cod_aluno = boletim.cod_aluno AND cod_professor = '$cod_professor' AND boletim.cod_curso = '$cod_curso' AND cod_turma = '$cod_turma' AND cod_disciplina = '$cod_disciplina' AND boletim.cod_aluno = '$cod_aluno' ORDER BY aluno.nome",$conn) or die (mysql_error(). " Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&nota_01$i=$result[2]";
                            echo "&nota_02$i=$result[3]";
                            echo "&nota_03$i=$result[4]";
                            echo "&nota_04$i=$result[5]";
                            echo "&nota_05$i=$result[6]";
                            echo "&nota_06$i=$result[7]";
                            echo "&media$i=$result[8]";
                            echo "&faltas$i=$result[9]";
                             echo "&unidade$i=$result[10]";



                            $i++;

                        }


                     }

          $this->resultado = "ok";

     }

     public function ranking($cod_curso,$cod_turma) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash


                     if ($cod_turma != ""){
                     $where = "AND boletim.cod_turma = '$cod_turma'";
                     }
                     else{
                     $where = "";
                     }


                    $query_grid = mysql_query("SELECT aluno.nome, curso.nome, turma.nome, disciplina.nome, TRUNCATE( AVG( media ) , 2) AS media_geral, max(media) AS nota
FROM aluno, curso, turma, disciplina, boletim
WHERE aluno.cod_status = 1 AND boletim.cod_aluno = aluno.cod_aluno
AND boletim.cod_curso = curso.cod_curso
AND turma.cod_turma = boletim.cod_turma
AND boletim.cod_disciplina = disciplina.cod_disciplina
AND boletim.cod_professor = disciplina.cod_professor
AND boletim.cod_curso = '$cod_curso' $where GROUP BY aluno.nome
ORDER BY media_geral DESC, nota DESC, aluno.nome",$conn) or die ("Error na consulta1" . mysql_error());

                    // zerando contadores
                    $i = 0;
                    $colocacao = 1;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash




                            echo "&colocacao$i=$colocacao";
                            echo "&aluno$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&turma$i=$result[2]";
                            echo "&disciplina$i=$result[3]";
                            echo "&media$i=$result[4]";
                            echo "&nota$i=$result[5]";

                            $i++;
                            $colocacao ++;

                        }
                     $this->resultado = "ok";



     }


     public function ranking_media($cod_curso,$cod_turma) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash


                     if ($cod_turma != ""){
                     $where = "AND boletim.cod_turma = '$cod_turma'";
                     }
                     else{
                     $where = "";
                     }


                    $query_grid = mysql_query("SELECT aluno.nome, curso.nome, turma.nome, disciplina.nome, media FROM aluno, curso, turma, disciplina, boletim WHERE boletim.cod_aluno = aluno.cod_aluno AND boletim.cod_curso = curso.cod_curso AND turma.cod_turma = boletim.cod_turma AND boletim.cod_disciplina = disciplina.cod_disciplina and boletim.cod_professor = disciplina.cod_professor AND boletim.cod_curso = '$cod_curso' $where ORDER BY media DESC",$conn) or die ("Error na consulta1" . mysql_error());

                    // zerando contadores
                    $i = 0;
                    $colocacao = 1;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash




                            echo "&colocacao$i=$colocacao";
                            echo "&aluno$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&turma$i=$result[2]";
                            echo "&disciplina$i=$result[3]";
                            echo "&media$i=$result[4]";

                            $i++;
                            $colocacao ++;

                        }
                     $this->resultado = "ok";



     }

public function select_grid_boletim_aluno($cod_aluno,$semestre,$ano){


    
     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
     session_start();
     $cod_instituicao = (int) $_SESSION['id_instituicao'];

     $query = mysql_query("SELECT media, cod_tipo FROM config WHERE cod_instituicao = '$cod_instituicao'") or die (mysql_error());
     $resultado = mysql_fetch_array($query);

     echo "&media_curso=$resultado[0]";

     $tipo = $resultado[0];





     if($tipo == 1){

    if($semestre != "" and $ano != ""){
    $where = "AND semestre = '$semestre' AND disciplina.cod_turma = turma.cod_turma AND boletim.cod_turma = turma.cod_turma AND turma.cod_curso = boletim.cod_curso AND turma.cod_curso = disciplina.cod_curso AND YEAR(turma.data) = '$ano'";
    $tabela = ",turma";

    }else if($ano != ""){

    $where = "AND disciplina.cod_turma = turma.cod_turma AND boletim.cod_turma = turma.cod_turma AND turma.cod_curso = boletim.cod_curso AND turma.cod_curso = disciplina.cod_curso AND YEAR(turma.data) = '$ano'";
    $tabela = ",turma";

    } else{
    $where = "";
    $tabela = "";
    }

     } else{


    if($semestre != "" and $ano != ""){
    $where = "AND unidade = '$semestre' AND disciplina.cod_turma = turma.cod_turma AND boletim.cod_turma = turma.cod_turma AND turma.cod_curso = boletim.cod_curso AND turma.cod_curso = disciplina.cod_curso AND YEAR(turma.data) = '$ano'";
    $tabela = ",turma";
    
    }else if($ano != ""){

    $where = "AND disciplina.cod_turma = turma.cod_turma AND boletim.cod_turma = turma.cod_turma AND turma.cod_curso = boletim.cod_curso AND turma.cod_curso = disciplina.cod_curso AND YEAR(turma.data) = '$ano'";
    $tabela = ",turma";
    
    } else{
    
    $where = "";
    $tabela = "";
    }

     }


      $query_grid = mysql_query("SELECT cod_boletim, disciplina.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM disciplina, boletim $tabela WHERE disciplina.cod_disciplina = boletim.cod_disciplina AND boletim.cod_curso = disciplina.cod_curso AND boletim.cod_turma = disciplina.cod_turma AND boletim.cod_aluno = '$cod_aluno' $where",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&nota_01$i=$result[2]";
                            echo "&nota_02$i=$result[3]";
                            echo "&nota_03$i=$result[4]";
                            echo "&nota_04$i=$result[5]";
                            echo "&nota_05$i=$result[6]";
                            echo "&nota_06$i=$result[7]";
                            echo "&media$i=$result[8]";
                            echo "&faltas$i=$result[9]";
                            echo "&unidade$i=$result[10]";



                            $i++;

                        }




                     $this->resultado = "ok";
                } // fim do método


                public function select_grid_turma_paralela($cod_aluno,$semestre){



     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
     session_start();
     $cod_instituicao = (int) $_SESSION['id_instituicao'];

     $query = mysql_query("SELECT media, cod_tipo, cod_paralela FROM config WHERE cod_instituicao = '$cod_instituicao'") or die (mysql_error());
     $resultado = mysql_fetch_array($query);

     echo "&media_curso=$resultado[0]";

     $tipo = $resultado[0];

     if($tipo == 1){

     if($semestre != ""){
    $where = "AND semestre = '$semestre' AND disciplina.cod_turma = turma.cod_turma AND boletim.cod_turma = turma.cod_turma AND turma.cod_curso = boletim.cod_curso AND turma.cod_curso = disciplina.cod_curso";
    $tabela = ",turma";
    } else{
    $where = "";
    $tabela = "";
    }

     } else{


    if($semestre != ""){
    $where = "AND unidade = '$semestre' AND disciplina.cod_turma = turma.cod_turma AND boletim.cod_turma = turma.cod_turma AND turma.cod_curso = boletim.cod_curso AND turma.cod_curso = disciplina.cod_curso";
    $tabela = ",turma";
    } else{
    $where = "";
    $tabela = "";
    }

     }


      $query_grid = mysql_query("SELECT cod_boletim, disciplina.nome, nota_01, nota_02, nota_03, nota_04, nota_05, nota_06, media, faltas, unidade FROM disciplina, boletim $tabela WHERE disciplina.cod_disciplina = boletim.cod_disciplina AND boletim.cod_curso = disciplina.cod_curso AND boletim.cod_turma = disciplina.cod_turma AND boletim.cod_aluno = '$cod_aluno' $where",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&nota_01$i=$result[2]";
                            echo "&nota_02$i=$result[3]";
                            echo "&nota_03$i=$result[4]";
                            echo "&nota_04$i=$result[5]";
                            echo "&nota_05$i=$result[6]";
                            echo "&nota_06$i=$result[7]";
                            echo "&media$i=$result[8]";
                            echo "&faltas$i=$result[9]";
                            echo "&unidade$i=$result[10]";



                            $i++;

                        }




                     $this->resultado = "ok";
                } // fim do método


}
?>
