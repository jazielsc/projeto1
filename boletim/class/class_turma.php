<?php

/**
 * classe para manipulação dos dados referente ao turma
 *
 * @author Administrador
 */
class Class_turma
{


     public $cod_turma;
     public $nome;
     public $data;
     public $cod_instituicao;
     public $cod_curso;
     public $turno;
     public $semestre;
     public $data_final;

                   
     public function insert_turma($nome,$data,$cod_instituicao,$cod_curso,$turno,$semestre,$data_final)
     {


         if(!empty($data)){ // testando se foi passado algum valor para variável

                $data = explode("/", $data);
                $data = $data[2]."-".$data[1]."-".$data[0];

                } else {

                    $data = '0000-00-00';
                }

                if(!empty($data_final)){ // testando se foi passado algum valor para variável

                $data_final = explode("/", $data_final);
                $data_final = $data_final[2]."-".$data_final[1]."-".$data_final[0];

                } else {

                    $data_final = '0000-00-00';
                }

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_turma FROM turma WHERE nome = '$nome' AND cod_instituicao = '$cod_instituicao' AND cod_curso = '$cod_curso'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 $this->resultado = "NAO"; 
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO turma VALUE (NULL, '$nome','$data','$cod_instituicao','$cod_curso','$turno','$semestre','$data_final')") or die ("Erro insert ". mysql_erro());
                     
                    $query_grid = mysql_query("SELECT cod_turma, instituicao.nome, curso.nome, turma.nome, date_format(data,'%d/%m/%Y') AS data FROM turma, instituicao, curso WHERE turma.cod_instituicao = instituicao.cod_instituicao AND turma.cod_curso = curso.cod_curso AND curso.cod_instituicao = '$cod_instituicao' ORDER BY turma.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&instituicao$i=$result[1]";
                            echo "&curso$i=$result[2]";
                            echo "&turma$i=$result[3]";
                            echo "&data_inicio$i=$result[4]";
                            
                            $i++;

                        }


                     $this->resultado = "ok";
                }
     }// fim do método

     public function select_grid_turma() { // método para preenchimento da grid no form


         session_start();
         $cod_instituicao = (int) $_SESSION['id_instituicao'];

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                    $query_grid = mysql_query("SELECT cod_turma, instituicao.nome, curso.nome, turma.nome, date_format(data,'%d/%m/%Y') AS data FROM turma, instituicao, curso WHERE turma.cod_instituicao = instituicao.cod_instituicao AND turma.cod_curso = curso.cod_curso AND curso.cod_instituicao = '$cod_instituicao' ORDER BY turma.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&instituicao$i=$result[1]";
                            echo "&curso$i=$result[2]";
                            echo "&turma$i=$result[3]";
                            echo "&data_inicio$i=$result[4]";

                            $i++;

                        }

                     $this->resultado = "ok";
                
                     
                     
     }



     public function select_turma($codigo){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT cod_turma, instituicao.cod_instituicao, instituicao.nome, curso.cod_curso, curso.nome, turma.nome, date_format(data,'%d/%m/%Y') AS data, turno, semestre, turma.nome, date_format(data_final,'%d/%m/%Y') AS data_final FROM turma, instituicao, curso WHERE turma.cod_instituicao = instituicao.cod_instituicao AND turma.cod_curso = curso.cod_curso AND cod_turma = '$codigo' ORDER BY turma.nome",$conn) or die ("Error na consulta" .mysql_error());

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{	


                $result = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo=$result[0]";
                            echo "&cod_instituicao=$result[1]";
                            echo "&nome_instituicao=$result[2]";
                            echo "&cod_curso=$result[3]";
                            echo "&nome_curso=$result[4]";
                            echo "&nome=$result[5]";
                            echo "&data_inicial=$result[6]";
                            echo "&turno=$result[7]";
                            echo "&semestre=$result[8]";
                            echo "&data_final=$result[10]";
                          

                        
                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function update_turma($nome,$data,$cod_instituicao,$cod_curso,$codigo,$turno,$semestre,$data_final)
     {


         session_start();
         $cod_instituicao = (int) $_SESSION['id_instituicao'];

         if(!empty($data)){ // testando se foi passado algum valor para variável

                $data = explode("/", $data);
                $data = $data[2]."-".$data[1]."-".$data[0];

                } else {

                    $data = '0000-00-00';
                }

                if(!empty($data_final)){ // testando se foi passado algum valor para variável

                $data_final = explode("/", $data_final);
                $data_final = $data_final[2]."-".$data_final[1]."-".$data_final[0];

                } else {

                    $data_final = '0000-00-00';
                }

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         
                     $query_insert = mysql_query("UPDATE turma SET nome = '$nome',  data = '$data', cod_instituicao = '$cod_instituicao', cod_curso = '$cod_curso', turno = '$turno', semestre = '$semestre', data_final = '$data_final' WHERE cod_turma = '$codigo'") or die ("Erro update". mysql_errno());

                    $query_grid = mysql_query("SELECT cod_turma, instituicao.nome, curso.nome, turma.nome, date_format(data,'%d/%m/%Y') AS data FROM turma, instituicao, curso WHERE turma.cod_instituicao = instituicao.cod_instituicao AND turma.cod_curso = curso.cod_curso AND curso.cod_instituicao = '$cod_instituicao' ORDER BY turma.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&instituicao$i=$result[1]";
                            echo "&curso$i=$result[2]";
                            echo "&turma$i=$result[3]";
                            echo "&data_inicio$i=$result[4]";

                            $i++;

                        }



                     $this->resultado = "OK";
               
     }// fim do método

     public function select_grid_disciplina($cod_turma) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_disciplina, curso.nome, disciplina.nome, professor.nome, turma.nome FROM disciplina, professor, curso, turma WHERE disciplina.cod_professor = professor.cod_professor AND disciplina.cod_curso = curso.cod_curso AND turma.cod_turma = disciplina.cod_turma AND turma.cod_turma = '$cod_turma' ORDER BY disciplina.nome",$conn) or die ("Error na consulta1");

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

     public function select_grid_aluno($cod_turma) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT DISTINCT matricula, aluno.nome, curso.nome
FROM aluno, disciplina, item2, curso
WHERE disciplina.cod_turma = '$cod_turma'
AND disciplina.cod_disciplina = item2.cod_disciplina
AND item2.cod_aluno = aluno.cod_aluno AND curso.cod_curso = aluno.cod_curso
ORDER BY aluno.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&aluno$i=$result[1]";
                            echo "&curso$i=$result[2]";
                            



                            $i++;

                        }
                     $this->resultado = "ok";



     }

     public function delete_turma($codigo)
     {

         session_start();
         $cod_instituicao = (int) $_SESSION['id_instituicao'];
         
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


         $query = mysql_query("SELECT cod_turma FROM disciplina WHERE cod_turma = '$codigo'") or die (mysql_error());

         $quant = mysql_num_rows($query);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {

                 $this->resultado = "NAO";
            } else
                 {


                    $query_delete = mysql_query("DELETE FROM turma WHERE cod_turma = '$codigo'");

                    $query_grid = mysql_query("SELECT cod_turma, instituicao.nome, curso.nome, turma.nome, date_format(data,'%d/%m/%Y') AS data FROM turma, instituicao, curso WHERE turma.cod_instituicao = instituicao.cod_instituicao AND turma.cod_curso = curso.cod_curso AND curso.cod_instituicao = '$cod_instituicao' ORDER BY turma.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&instituicao$i=$result[1]";
                            echo "&curso$i=$result[2]";
                            echo "&turma$i=$result[3]";
                            echo "&data_inicio$i=$result[4]";

                            $i++;

                        }



                     $this->resultado = "ok";

                 }

     }// fim do método

}
?>
