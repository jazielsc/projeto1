<?php

/**
 * classe para manipulação dos dados referente ao aluno
 *
 * @author Administrador
 */
class Class_aluno
{


     public $cod_aluno;
     public $cod_turma;
     public $cod_curso;
     public $cod_status;


     public function insert_aluno($cod_aluno,$cod_turma)
     {


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_aluno FROM aluno WHERE cod_aluno = '$cod_aluno' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 $this->resultado = "NAO";
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO aluno VALUE (NULL, '$cod_turma','$data','$cod_instituicao','$cod_curso')") or die ("Erro insert ". mysql_erro());

                    $query_grid = mysql_query("SELECT cod_aluno, instituicao.nome, curso.nome, aluno.nome, date_format(data,'%d/%m/%Y') AS data FROM aluno, instituicao, curso WHERE aluno.cod_instituicao = instituicao.cod_instituicao AND aluno.cod_curso = curso.cod_curso ORDER BY aluno.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&instituicao$i=$result[1]";
                            echo "&curso$i=$result[2]";
                            echo "&aluno$i=$result[3]";
                            echo "&data_inicio$i=$result[4]";

                            $i++;

                        }


                     $this->resultado = "ok";
                }
     }// fim do método

     public function select_grid_aluno() { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                    $query_grid = mysql_query("SELECT cod_aluno, instituicao.nome, curso.nome, aluno.nome, date_format(data,'%d/%m/%Y') AS data FROM aluno, instituicao, curso WHERE aluno.cod_instituicao = instituicao.cod_instituicao AND aluno.cod_curso = curso.cod_curso ORDER BY aluno.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&instituicao$i=$result[1]";
                            echo "&curso$i=$result[2]";
                            echo "&aluno$i=$result[3]";
                            echo "&data_inicio$i=$result[4]";

                            $i++;

                        }

                     $this->resultado = "ok";



     }

     public function select_aluno($codigo){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT cod_aluno, instituicao.cod_instituicao, instituicao.nome, curso.cod_curso, curso.nome, aluno.nome, date_format(data,'%d/%m/%Y') AS data FROM aluno, instituicao, curso WHERE aluno.cod_instituicao = instituicao.cod_instituicao AND aluno.cod_curso = curso.cod_curso ORDER BY aluno.nome",$conn) or die ("Error na consulta" .mysql_error());

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



                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function update_aluno($nome,$data,$cod_instituicao,$cod_curso,$codigo)
     {


         if(!empty($data)){ // testando se foi passado algum valor para variável

                $data = explode("/", $data);
                $data = $data[2]."-".$data[1]."-".$data[0];

                } else {

                    $data = '0000-00-00';
                }

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


                     $query_insert = mysql_query("UPDATE aluno SET nome = '$nome',  data = '$data', cod_instituicao = '$cod_instituicao', cod_curso = '$cod_curso' WHERE cod_aluno = '$codigo'") or die ("Erro update". mysql_errno());

                     $query_grid = mysql_query("SELECT cod_aluno, instituicao.nome, curso.nome, aluno.nome, date_format(data,'%d/%m/%Y') AS data FROM aluno, instituicao, curso WHERE aluno.cod_instituicao = instituicao.cod_instituicao AND aluno.cod_curso = curso.cod_curso ORDER BY aluno.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&instituicao$i=$result[1]";
                            echo "&curso$i=$result[2]";
                            echo "&aluno$i=$result[3]";
                            echo "&data_inicio$i=$result[4]";

                            $i++;

                        }



                     $this->resultado = "ok";

     }// fim do método
}
?>
