<?php

/**
 * classe para manipulação dos dados referente a instituicão
 *
 * @author Administrador
 */
class Class_colaborador
{

     public $cod_colaborador;
     public $nome;
     public $email;
     public $cod_cidade;
     public $cod_bairro;
     public $cod_rua;
     public $complemento;
     public $numero;
     public $cod_uf;
     public $telefone;
     public $celular;
     public $cod_status;
     public $resultado;
     public $cod_instituicao;
     public $cep;
     public $login;
     public $senha;
          
     public function insert_colaborador($nome,$email,$cod_cidade,$cod_bairro,$cod_rua,$complemento,$numero,$cod_uf,$telefone,$celular,$cod_status,$cod_instituicao,$cep)
     {

         session_start();

         $instituicao = $_SESSION['instituicao'];

         $pasta = $_SESSION['pasta'];

         $cod_instituicao = (int) $_SESSION['id_instituicao'];

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_colaborador FROM colaborador WHERE email = '$email'") or die ("Erro select ". mysql_errno());

         $query_select2 = mysql_query("SELECT cod_usuario FROM usuario WHERE email = '$email'") or die ("Erro select ". mysql_errno());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);
         $quant2 = mysql_num_rows($query_select2);

		// se retornou então envia a mensagem
            if ($quant > 0 or $quant2 > 0)
            {
                 $this->resultado = "NAO";
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO colaborador VALUE (NULL, '$nome','$email','$cod_cidade','$cod_bairro','$cod_rua','$complemento','$numero','$cod_uf','$telefone','$celular',$cod_status', '$cod_instituicao','$cep')") or die ("Erro insert ". mysql_errno());
                     
                     $query_grid = mysql_query("SELECT cod_professor, professor.nome, cidade_nome , telefone FROM professor, cidade WHERE professor.cod_cidade = cidade_id AND cod_instituicao = '$cod_instituicao' AND cod_status = 1 ORDER BY professor.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&cidade$i=$result[2]";
                            echo "&telefone$i=$result[3]";
                            $i++;

                        }

                        $query_consulta = mysql_query("SELECT cod_professor FROM professor WHERE cod_instituicao = '$cod_instituicao' ORDER BY  cod_professor DESC LIMIT 1",$conn) or die ("Error na consulta");
                        $resultado = mysql_fetch_array($query_consulta);
                        $senha =  md5($pasta."123");
                        $query_insert = mysql_query("INSERT INTO usuario VALUE (NULL, '$nome','$email','$senha',4,2,$resultado[0],'$cod_instituicao','$email')") or die ("Erro insert ". mysql_error());

                        // envio do email ---------------------------------------------------------------------------------------------------

				$para = $email;
                                $emailsender = "equipe@boletimflex.com";
                                $area = "Professores";


                                $str[0] = utf8_decode("Olá");
                                $str[1] = utf8_decode("Instituição");
                                $str[2] = utf8_decode("Área Restrita");
                                

				$assunto = "Cadastro Boletimflex!";

				$headers = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\n";
				$headers .= "From: boletimflex <equipe@boletimflex.com>\n";

				$headers .= "Return-Path: boletimflex <equipe@boletimflex.com>";

				$mensagem = "$str[0]!, $nome. <br /> <br />";
				$mensagem .= "Voce foi cadastrado pela $str[1] $instituicao no sistema boletimflex, abaixo segue seus dados de acesso! <br /> <br />";
				$mensagem .= "<a href=\"http://www.boletimflex.com/boletim/$pasta\">http://www.boletimflex.com/boletim/$pasta</a><br /> <br />";
				$mensagem .= "$str[2]: $area. <br />";
                                $mensagem .= "login: " .$email. "<br />";
                                $mensagem .= "senha: " .$pasta."123";

				/* Enviando a mensagem */

				mail($para, $assunto, $mensagem, $headers,"-r".$emailsender) or die ("ERRO ao enviar mensagem!");




                     $this->resultado = "ok";
                }
     }// fim do método

     public function select_grid_colaborador() { // método para preenchimento da grid no form


                    

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                    $query_grid = mysql_query("SELECT cod_colaborador, colaborador.nome, colaborador.email, colaborador.celular, uf_sigla FROM colaborador, uf WHERE colaborador.cod_uf  = uf_id",$conn) or die ("Error na consulta");

                    // zerando contadores
                   $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&email$i=$result[2]";
                            echo "&telefone$i=$result[3]";
                            echo "&uf$i=$result[4]";
                            $i++;

                        }
                     
                     
     }

     public function select_professor($cod_professor){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT professor.nome, professor.email, professor.cod_cidade, cidade_nome, professor.cod_bairro, bairro_nome, professor.cod_rua, rua_nome, professor.complemento, professor.numero, professor.cod_uf, uf_sigla, professor.telefone, professor.cod_status, status3.nome, professor.cod_instituicao, instituicao.nome, professor.cep, professor.cod_professor FROM professor, cidade, bairro, rua, uf, status3, instituicao WHERE professor.cod_cidade = cidade.cidade_id AND professor.cod_bairro = bairro.bairro_id AND professor.cod_rua = rua_id AND professor.cod_status = status3.cod_status AND professor.cod_uf = uf_id AND professor.cod_instituicao = instituicao.cod_instituicao AND cod_professor = '$cod_professor'") or die (mysql_error(). "erro em select");

         $quant = mysql_num_rows($query_select);

				// se retornou então preenche os dados
	if ($quant > 0)
	{	


                $result = mysql_fetch_array($query_select); // retornando os valores da consulta em array e enviando para o flash


                            echo "&nome=$result[0]";
                            echo "&email=$result[1]";
                            echo "&cod_cidade=$result[2]";
                            echo "&nome_cidade=$result[3]";
                            echo "&cod_bairro=$result[4]";
                            echo "&nome_bairro=$result[5]";
                            echo "&cod_rua=$result[6]";
                            echo "&nome_rua=$result[7]";
                            echo "&complemento=$result[8]";
                            echo "&numero=$result[9]";
                            echo "&cod_uf=$result[10]";
                            echo "&nome_uf=$result[11]";
                            echo "&telefone=$result[12]";
                            echo "&cod_status=$result[13]";
                            echo "&nome_status=$result[14]";
                            echo "&cod_instituicao=$result[15]";
                            echo "&nome_instituicao=$result[16]";
                            echo "&cep=$result[17]";
                            echo "&codigo=$result[18]";
                            

                        
                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function update_professor($nome,$email,$cod_cidade,$cod_bairro,$cod_rua,$complemento,$numero,$cod_uf,$telefone,$cod_status,$cod_professor,$cod_instituicao,$cep)
     {
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


         if($cod_status > 1){

             $query_update = mysql_query("UPDATE usuario SET usuario_atrib = 6 WHERE cod_aluno_professor = '$cod_professor' AND referencia = 2") or die("ERRO!");
         } else if($cod_status == 1){

              $query_update = mysql_query("UPDATE usuario SET usuario_atrib = 4 WHERE cod_aluno_professor = '$cod_professor' AND referencia = 2") or die("ERRO!");
         }

         
                     $query_insert = mysql_query("UPDATE professor SET nome = '$nome', email = '$email', cod_cidade = '$cod_cidade', cod_bairro = '$cod_bairro', cod_rua = '$cod_rua', complemento = '$complemento', numero = '$numero', cod_uf = '$cod_uf', telefone = '$telefone', cod_status = '$cod_status', cod_instituicao = '$cod_instituicao', cep = '$cep' WHERE cod_professor = '$cod_professor'") or die ("Erro insert ". mysql_errno());

                     $query_grid = mysql_query("SELECT cod_professor, professor.nome, cidade_nome , telefone FROM professor, cidade WHERE professor.cod_cidade = cidade_id AND cod_status = 1 ORDER BY professor.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&cidade$i=$result[2]";
                            echo "&telefone$i=$result[3]";
                            $i++;

                        }


                     $this->resultado = "ok";
               
     }// fim do método

      public function select_grid_disciplina($cod_professor) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_disciplina, curso.nome, disciplina.nome, professor.nome, turma.nome FROM disciplina, professor, curso, turma WHERE disciplina.cod_professor = professor.cod_professor AND disciplina.cod_curso = curso.cod_curso AND turma.cod_turma = disciplina.cod_turma AND professor.cod_professor = '$cod_professor' ORDER BY disciplina.nome",$conn) or die ("Error na consulta1");

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

     public function insert_plano_aula($dia,$inicio,$termino,$cod_turma,$cod_disciplina,$cod_professor,$calendario,$dia_numero,$cod_curso,$plano_aula,$atividades)
     {


         if(!empty($dia)){ // testando se foi passado algum valor para variável

                $dia = explode("/", $dia);
                $dia = $dia[2]."-".$dia[1]."-".$dia[0];

                } else {

                    $dia = '0000-00-00';
                }


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_plano_aula FROM plano_aula WHERE calendario = '$calendario' AND dia = '$dia' AND cod_professor = '$cod_professor' AND cod_disciplina = '$cod_disciplina' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 $this->resultado = "NAO";
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO plano_aula VALUE (NULL, '$dia','$inicio','$termino','$cod_turma', '$cod_disciplina', '$cod_professor', '$calendario', '$dia_numero', '$cod_curso','$plano_aula', '$atividades')") or die ("Erro insert1 ". mysql_erro());

                    $query_grid = mysql_query("SELECT cod_plano_aula, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM plano_aula, disciplina, professor, turma WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor AND plano_aula.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND plano_aula.cod_turma = turma.cod_turma AND plano_aula.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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


     public function select_plano_aula($codigo){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT cod_plano_aula, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.cod_disciplina, disciplina.nome, professor.cod_professor, professor.nome, turma.cod_turma, turma.nome, curso.cod_curso, curso.nome, dia_numero, plano_aula, atividades FROM plano_aula, disciplina, professor, turma, curso WHERE plano_aula.cod_curso = curso.cod_curso AND disciplina.cod_curso = curso.cod_curso AND turma.cod_curso = curso.cod_curso AND  plano_aula.cod_plano_aula = '$codigo' AND disciplina.cod_professor = professor.cod_professor AND plano_aula.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND plano_aula.cod_turma = turma.cod_turma AND plano_aula.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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
                            echo "&plano_aula=$result[14]";
                            echo "&atividades=$result[15]";

                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }

     public function select_grid_plano_aula($cod_turma) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_plano_aula, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM plano_aula, disciplina, professor, turma WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor AND plano_aula.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND plano_aula.cod_turma = turma.cod_turma AND plano_aula.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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

     public function update_plano_aula($dia,$inicio,$termino,$cod_turma,$cod_disciplina,$cod_professor,$calendario,$dia_numero,$cod_curso,$codigo,$plano_aula,$atividades)
     {

         if(!empty($dia)){ // testando se foi passado algum valor para variável

                $dia = explode("/", $dia);
                $dia = $dia[2]."-".$dia[1]."-".$dia[0];

                } else {

                    $dia = '0000-00-00';
                }


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


                     $query_insert = mysql_query("UPDATE plano_aula SET dia = '$dia', inicio = '$inicio', termino = '$termino', cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma', cod_disciplina = '$cod_disciplina', calendario = '$calendario', dia_numero = '$dia_numero', plano_aula = '$plano_aula', atividades = '$atividades' WHERE cod_plano_aula = '$codigo'") or die ("Erro update". mysql_errno());

                     $query_grid = mysql_query("SELECT cod_plano_aula, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM plano_aula, disciplina, professor, turma WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor AND plano_aula.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND plano_aula.cod_turma = turma.cod_turma AND plano_aula.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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


     public function delete_plano_aula($codigo,$cod_turma)
     {


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");




                    $query_delete = mysql_query("DELETE FROM plano_aula WHERE cod_plano_aula = '$codigo'");

                    $query_grid = mysql_query("SELECT cod_plano_aula, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM plano_aula, disciplina, professor, turma WHERE turma.cod_turma = '$cod_turma' AND disciplina.cod_professor = professor.cod_professor AND plano_aula.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND plano_aula.cod_turma = turma.cod_turma AND plano_aula.cod_professor = professor.cod_professor ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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

      public function select_grid_plano_aula_professor($semestre,$datas,$disciplina) { // método para preenchimento da grid no form

         session_start();
     $cod_professor = $_SESSION['id_aluno_professor'];

     if(!empty($datas)){ // testando se foi passado algum valor para variável

                $datas = explode("/", $datas);
                $datas = $datas[2]."-".$datas[1]."-".$datas[0];

                $where = "AND dia = '$datas'";

                } else {

                    $where = "";
                    $datas = '0000-00-00';
                }

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_plano_aula, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM plano_aula, disciplina, professor, turma WHERE disciplina.cod_disciplina = '$disciplina' AND semestre = '$semestre' AND disciplina.cod_professor = professor.cod_professor AND professor.cod_professor = '$cod_professor' AND plano_aula.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND plano_aula.cod_turma = turma.cod_turma AND plano_aula.cod_professor = professor.cod_professor $where ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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


     public function consulta_plano_aula($semestre,$datas,$disciplina,$cod_professor) { // método para preenchimento da grid no form

         
     if(!empty($datas)){ // testando se foi passado algum valor para variável

                $datas = explode("/", $datas);
                $datas = $datas[2]."-".$datas[1]."-".$datas[0];

                $where = "AND dia = '$datas'";

                } else {

                    $where = "";
                    $datas = '0000-00-00';
                }

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash

                   $query_grid = mysql_query("SELECT cod_plano_aula, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM plano_aula, disciplina, professor, turma WHERE disciplina.cod_disciplina = '$disciplina' AND semestre = '$semestre' AND disciplina.cod_professor = professor.cod_professor AND professor.cod_professor = '$cod_professor' AND plano_aula.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND plano_aula.cod_turma = turma.cod_turma AND plano_aula.cod_professor = professor.cod_professor $where ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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



}
?>
