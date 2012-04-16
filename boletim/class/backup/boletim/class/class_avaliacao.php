<?php

/**
 * classe para manipulação dos dados referente ao avaliacao
 *
 * @author Administrador
 */
class Class_avaliacao
{


     public $cod_avaliacao;
     public $nome;
     public $cod_professor; // session
     public $cod_curso;
     public $cod_turma;
     public $cod_disciplina;
     public $valor;
     public $minima;
     public $session;
     public $envia_email;
                   
     public function insert_avaliacao($nome,$cod_professor,$cod_curso,$cod_turma,$cod_disciplina,$valor,$session,$minima,$envia_email)
     {

        
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


         // verificando se o valor total da prova é igual ao valor dos pesos das questoes

         $query_grid = mysql_query("SELECT SUM(peso) FROM questao WHERE session = '$session'") or die ("Error na consulta" .mysql_error());

         $soma = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash
         
         echo "&soma=$soma[0]";

          $this->resultado = "nao confere";


         if ($valor == $soma[0])
         {
         


                            

         $query_select = mysql_query("SELECT cod_avaliacao FROM avaliacao WHERE nome = '$nome' AND cod_professor = '$cod_professor' AND cod_curso = '$cod_curso' AND cod_turma = '$cod_turma'") or die ("Erro select ". mysql_error());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 $this->resultado = "NAO"; 
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO avaliacao VALUE (NULL, '$nome','$cod_professor','$cod_curso','$cod_turma', '$cod_disciplina', '$valor', '$minima', '$session')") or die ("Erro insert1 ". mysql_erro());
                     
                    

                   
                   $query_avaliacao = mysql_query("SELECT cod_avaliacao FROM avaliacao WHERE cod_professor = '$cod_professor' ORDER BY cod_avaliacao DESC LIMIT 0,1");
                   $ultima_avaliacao = mysql_fetch_array($query_avaliacao);

                   $query_update = mysql_query("UPDATE questao SET session = 0, cod_avaliacao = '$ultima_avaliacao[0]'  WHERE session = '$session'") or die ("Erro update". mysql_errno());

                   $query_update = mysql_query("UPDATE resposta SET session = 0, cod_questao = '$ultima_avaliacao[0]'  WHERE session = '$session'") or die ("Erro update". mysql_errno());


                     $this->resultado = "ok";

                     if ($envia_email == "SIM")
                     {


				//ini_set("SMTP","NOTETRABALHO");
				//ini_set("smtp_port","25");
				//ini_set("sendmail_from","youraccount@yourserver.com");


				$query_grid = mysql_query("SELECT aluno.nome, aluno.email, disciplina.nome, instituicao.pasta  FROM aluno, disciplina, item2, instituicao WHERE aluno.cod_instituicao = instituicao.cod_instituicao AND item2.cod_aluno = aluno.cod_aluno AND item2.cod_disciplina = disciplina.cod_disciplina AND item2.cod_disciplina = '$cod_disciplina' ORDER BY aluno.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                   //$i = 0;

                        while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            $nome=$result[0];
                            $email=$result[1];
                            $disciplina=$result[2];
                            $pasta = $result[3];


                            $para2 = $email;
                            $assunto2 = "Avaliação 0n-line Boletim Flex";

				$headers2 = "MIME-Version: 1.1\r\n";
				$headers2 .= "Content-type: text/plain; charset=iso-8859-1\r\n";
				$headers2 .= "From: contato@inforcloud.com.br\r\n";
				$headers2 .= "Return-Path: contato@inforcloud.com.br\r\n";

				$mensagem = "olá " .$nome.", foi cadastrado no sistema Boletim Flex, uma nova avaliação para voce \r\n";
                                $mensagem .= "Disciplina: " .$disciplina. "\r\n";
                                $mensagem .= "Entre e confira agora mesmo  www.inforcloud.com.br/boletim/".$pasta."/ \r\n";
                                
							//$i++;
                             
				

				/* Enviando a mensagem */
				$envio = mail($para2, $assunto2, $mensagem, $headers2) or die ("ERRO ao enviar mensagem!");

                                if($envio){
				 echo "&mensagemenvio=OK";
                                echo $para2;
                                }
				else
				 echo "A mensagem não pode ser enviada";

                                


                                //echo $i;
                        }

                }

                }
         }
     }// fim do método


     public function update_avaliacao($nome,$cod_professor,$cod_curso,$cod_turma,$cod_disciplina,$valor,$session,$minima,$cod_avaliacao)
     {


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


         // verificando se o valor total da prova é igual ao valor dos pesos das questoes

         $query_grid = mysql_query("SELECT SUM(peso) FROM questao WHERE cod_avaliacao = '$cod_avaliacao'") or die ("Error na consulta" .mysql_error());

         $soma = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash

         echo "&soma=$soma[0]";

          $this->resultado = "nao confere";


         if ($valor == $soma[0])
         {


     
                 {
                     $query_insert = mysql_query("UPDATE avaliacao SET nome = '$nome', cod_professor = '$cod_professor', cod_curso = '$cod_curso', cod_turma = '$cod_turma', cod_disciplina =  '$cod_disciplina', valor =  '$valor', minima =  '$minima' WHERE cod_avaliacao = '$cod_avaliacao'") or die ("Erro update ". mysql_error());


                     $this->resultado = "ok";
                }
         }
     }// fim do método

     // referente ao aluno
     public function select_grid_avaliacao($session,$id_aluno_professor) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                    

                    // zerando contadores
                    $i = 0;

                   $query_grid = mysql_query("SELECT cod_avaliacao, curso.nome, avaliacao.nome, professor.nome, turma.nome, disciplina.nome FROM avaliacao, professor, curso, turma, disciplina, item2 WHERE avaliacao.cod_professor = professor.cod_professor AND avaliacao.cod_curso = curso.cod_curso AND turma.cod_turma = avaliacao.cod_turma AND avaliacao.cod_disciplina = disciplina.cod_disciplina and item2.cod_disciplina = disciplina.cod_disciplina AND cod_aluno = '$id_aluno_professor' ORDER BY avaliacao.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&avaliacao$i=$result[2]";
                            echo "&professor$i=$result[3]";
                            echo "&turma$i=$result[4]";
                            echo "&disciplina$i=$result[5]";



                            $i++;

                        }
                     $this->resultado = "ok";



     }

// referente ao professor
     public function select_grid_avaliacao2($session,$id_aluno_professor) { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash


                    // zerando contadores
                    $i = 0;

$query_grid = mysql_query("SELECT DISTINCT cod_avaliacao, curso.nome, avaliacao.nome, professor.nome, turma.nome, disciplina.nome FROM avaliacao, professor, curso, turma, disciplina, item2 WHERE avaliacao.cod_professor = professor.cod_professor AND avaliacao.cod_curso = curso.cod_curso AND turma.cod_turma = avaliacao.cod_turma AND avaliacao.cod_disciplina = disciplina.cod_disciplina and item2.cod_disciplina = disciplina.cod_disciplina AND disciplina.cod_professor = '$id_aluno_professor' AND disciplina.cod_turma = turma.cod_turma
AND disciplina.cod_curso = curso.cod_curso
AND disciplina.cod_professor = professor.cod_professor
AND turma.cod_curso = curso.cod_curso
ORDER BY avaliacao.nome",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&curso$i=$result[1]";
                            echo "&avaliacao$i=$result[2]";
                            echo "&professor$i=$result[3]";
                            echo "&turma$i=$result[4]";
                            echo "&disciplina$i=$result[5]";



                            $i++;

                        }
                     $this->resultado = "ok";



     }



     public function select_avaliacao($codigo,$cod_avaliacao){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT cod_questao, peso, pergunta, tipo FROM questao WHERE numero = '$codigo' AND cod_avaliacao = '$cod_avaliacao'",$conn) or die ("Error na consulta" .mysql_error());

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{	


                $result = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo=$result[0]";
                            echo "&peso=$result[1]";
                            echo "&pergunta=$result[2]";
                            echo "&tipo=$result[3]";
                                                 
                           
                          

                        
                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function consulta_avaliacao($cod_avaliacao){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_grid = mysql_query("SELECT avaliacao.cod_avaliacao, avaliacao.nome, curso.cod_curso, curso.nome, turma.cod_turma, turma.nome, disciplina.cod_disciplina, disciplina.nome, avaliacao.valor, minima, peso, pergunta, tipo, resposta FROM avaliacao, questao, curso, turma, disciplina WHERE avaliacao.cod_avaliacao = questao.cod_avaliacao AND curso.cod_curso AND avaliacao.cod_curso AND turma.cod_turma = avaliacao.cod_turma AND disciplina.cod_disciplina = avaliacao.cod_disciplina AND numero = 1 AND avaliacao.cod_avaliacao = '$cod_avaliacao'",$conn) or die ("Error na consulta" .mysql_error());

         $quant = mysql_num_rows($query_grid);

				// se retornou então preenche os dados
	if ($quant > 0)
	{


                $result = mysql_fetch_array($query_grid); // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo=$result[0]";
                            echo "&titulo=$result[1]";
                            echo "&cod_curso=$result[2]";
                            echo "&nome_curso=$result[3]";
                            echo "&cod_turma=$result[4]";
                            echo "&nome_turma=$result[5]";
                            echo "&cod_disciplina=$result[6]";
                            echo "&nome_disciplina=$result[7]";
                            echo "&valor_prova=$result[8]";
                            echo "&nota_minima=$result[9]";
                            echo "&peso=$result[10]";
                            echo "&pergunta=$result[11]";
                            echo "&tipo=$result[12]";
                            echo "&resposta=$result[13]";


                   $query_grid = mysql_query("SELECT cod_resposta, alternativa, resposta, comentario FROM resposta WHERE numero = 1 AND cod_questao = '$result[0]' ORDER BY alternativa",$conn) or die ("Error na consulta1");

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





                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }



     public function select_fazer_avaliacao($codigo){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         
          $query_contagem = mysql_query("SELECT COUNT(*) FROM questao WHERE cod_avaliacao = '$codigo'") or die ("errona na contagem de registros");
          $contagem = mysql_fetch_array($query_contagem);

          echo"&numero=$contagem[0]";

         $query_grid = mysql_query("SELECT cod_avaliacao, professor.nome, curso.nome,  turma.nome, avaliacao.nome, disciplina.nome, valor, minima FROM avaliacao, professor, curso, turma, disciplina WHERE avaliacao.cod_professor = professor.cod_professor AND avaliacao.cod_curso = curso.cod_curso AND avaliacao.cod_turma = turma.cod_turma AND avaliacao.cod_disciplina = disciplina.cod_disciplina AND cod_avaliacao = '$codigo' ORDER BY avaliacao.nome",$conn) or die ("Error na consulta" .mysql_error());

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




                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }





     public function select_resposta_avaliacao($numero,$cod_avaliacao) { // método para preenchimento da grid no form

         
                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");


                    // zerando contadores
                    $i = 0;

                   $query_grid = mysql_query("SELECT resposta FROM resposta WHERE numero = '$numero' AND cod_questao = '$cod_avaliacao' ORDER BY alternativa",$conn) or die ("Error na consulta1");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                           
                            echo "&resposta$i=$result[0]";
                           



                            $i++;

                        }
                     $this->resultado = "ok";



     }


     public function delete_avaliacao($cod_avaliacao) { // método para preenchimento da grid no form


                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

                     $delete = mysql_query("DELETE FROM avaliacao WHERE cod_avaliacao = '$cod_avaliacao'") or die ("Erro delete!" . mysql_error() );

                     $delete = mysql_query("DELETE FROM avaliacao WHERE cod_avaliacao = '$cod_avaliacao'") or die ("Erro delete!" . mysql_error() );
                     

                     $this->resultado = "ok";



     }

}
?>
