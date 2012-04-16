<?php

/**
 * classe para manipulação dos dados referente ao usuario
 *
 * @author Administrador
 */
class Class_usuario
{


     public $cod_usuario;
     public $nome;
     public $login;
     public $senha;
     public $atribuicao;
     public $referencia;
     public $cod_aluno_professor;
     public $cod_instituicao;
     
              
     public function insert_usuario($nome,$login,$senha,$atribuicao,$referencia,$cod_aluno_professor)
     {

         session_start();
         $cod_instituicao = (int) $_SESSION['id_instituicao'];

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_usuario FROM usuario WHERE cod_instituicao = '$cod_instituicao' AND usuario_login = '$login' ") or die ("Erro select ". mysql_errno());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 $this->resultado = "NAO";
            } else
                 {

                    $query_insert = mysql_query("INSERT INTO usuario VALUE (NULL, '$nome','$login','$senha','$atribuicao','$referencia','$cod_aluno_professor','$cod_instituicao')") or die ("Erro insert ". mysql_errno());
                     
                    $query_grid = mysql_query("SELECT cod_usuario, nome, usuario_login, usuario_atrib FROM usuario WHERE cod_instituicao = '$cod_instituicao' ORDER BY usuario.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&usuario$i=$result[2]";
                            echo "&nivel$i=$result[3]";
                            
                            $i++;

                        }


                     $this->resultado = "ok";
                }
     }// fim do método

     public function select_grid_usuario() { // método para preenchimento da grid no form

                     session_start();
                     $cod_instituicao = (int) $_SESSION['id_instituicao'];
                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                    $query_grid = mysql_query("SELECT nome, usuario_login FROM usuario WHERE cod_instituicao = '$cod_instituicao' ORDER BY usuario.nome",$conn) or die ("Error na consulta " .mysql_error());

                    // zerando contadores
                    $i = 0;
                    $contador = 1;
                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$contador";
                            echo "&nome$i=$result[0]";
                            echo "&usuario$i=$result[1]";
                            
                            $contador++;
                            $i++;

                        }


                     $this->resultado = "ok";
                
                     
                     
     }

      public function select_grid_usuario_2($cod_curso, $cod_turma) { // método para preenchimento da grid no form

                     session_start();
                     $cod_instituicao = (int) $_SESSION['id_instituicao'];


                     if($cod_turma != ""){
                     $where = "turma.cod_curso = curso.cod_curso AND turma.cod_turma = '$cod_turma' AND
                         disciplina.cod_disciplina = item2.cod_disciplina
                         AND item2.cod_aluno = aluno.cod_aluno AND disciplina.cod_turma = '$cod_turma' AND";
                     $tabela = ",turma, disciplina, item2";
                    
                     }else{
                     $tabela = "";
                     $where = "";
                     }
                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                    $query_grid = mysql_query("SELECT DISTINCT usuario.nome, usuario_login, aluno.identidade FROM usuario, curso, aluno $tabela
                            WHERE $where aluno.cod_curso = '$cod_curso' AND usuario.cod_instituicao = '$cod_instituicao' AND
                            curso.cod_curso = aluno.cod_curso AND referencia = 1 AND cod_aluno_professor = aluno.cod_aluno
 ORDER BY usuario.nome",$conn) or die ("Error na consulta " .mysql_error());

                    // zerando contadores
                    $i = 0;
                    $posicao = 1;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$posicao";
                            echo "&nome$i=$result[0]";
                            echo "&usuario$i=$result[1]";
                            echo "&identidade$i=$result[2]";
                            
                            $posicao++;
                            $i++;

                        }


                     $this->resultado = "ok";



     }


     public function select_usuario($codigo){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_aluno_professor, nome, usuario_login, referencia  FROM usuario WHERE usuario.cod_usuario = '$codigo'") or die (mysql_error(). "erro em select");

         $quant = mysql_num_rows($query_select);

				// se retornou então preenche os dados
	if ($quant > 0)
	{	


                $result = mysql_fetch_array($query_select); // retornando os valores da consulta em array e enviando para o flash


                            echo "&cod_usuario=$result[0]";
                            echo "&nome_usuario=$result[1]";
                            echo "&nick=$result[2]";
                            echo "&referencia=$result[3]";
                          

                        
                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function update_usuario($login,$senha,$atribuicao,$referencia,$cod_aluno_professor,$nome_usuario,$codigo)
     {
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         
                     $query_insert = mysql_query("UPDATE usuario SET nome = '$nome_usuario',  usuario_login = '$login', usuario_atrib = '$atribuicao', referencia = '$referencia', cod_aluno_professor = '$cod_aluno_professor' WHERE cod_usuario = '$codigo'") or die ("Erro update". mysql_errno());

                      $query_grid = mysql_query("SELECT cod_usuario, nome, usuario_login, usuario_atrib FROM usuario ORDER BY usuario.nome",$conn) or die ("Error na consulta");

                    // zerando contadores
                    $i = 0;

                    while ($result = mysql_fetch_array($query_grid))
                        { // retornando os valores da consulta em array e enviando para o flash


                            echo "&codigo$i=$result[0]";
                            echo "&nome$i=$result[1]";
                            echo "&usuario$i=$result[2]";
                            echo "&nivel$i=$result[3]";

                            $i++;

                        }



                     $this->resultado = "ok";
               
     }// fim do método


     public function esqueceu_senha($email)
		{

                       
                        include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

			$query_consulta = mysql_query("SELECT cod_usuario, usuario_login FROM usuario WHERE email = '$email'");

                         $quant = mysql_num_rows($query_consulta);

                        // se retornou então envia a mensagem
                        if ($quant > 0){


			$result = mysql_fetch_row($query_consulta);



			$nick = $result[1];

				//2-Pega nr. IP de quem mandou o email
				$ip_assinatura = $_SERVER['REMOTE_ADDR'];

				//4-Gera um valor unico de link
				$hash = bin2hex(crypt("esqueceu o teste", $email));

				$link = urlencode($hash);

				$data_assinatura = date("Y-m-d");


				$query_cad = mysql_query("INSERT esqueceu_senha VALUE('$ip_assinatura', '000.000.000', '$data_assinatura', '0000-00-00', '$hash', '$nick', '$result[0]')") or die ("erro esqueceu senha!");



				// envio do email ---------------------------------------------------------------------------------------------------

				$para = $email;
                                $emailsender = "equipe@boletimflex.com";
                                $str[0] = utf8_decode("Olá");

				$assunto = "Esqueceu senha!";

				$headers = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\n";
				$headers .= "From: boletimflex <equipe@boletimflex.com>\n";

				$headers .= "Return-Path: boletimflex <equipe@boletimflex.com>";

				$mensagem = "$str[0]!, $nick. <br /> <br />";
				$mensagem .= "Click no link abaixo para alterar sua senha para nova senha gerada pelo sistema e em seguida entre em sua conta e altere sua senha para uma de sua preferencia! <br /> <br />";
				$mensagem .= "<a href=\"http://www.boletimflex.com/boletim/alterar_senha.php?hash=$link\">http://www.boletimflex.com/boletim/alterar_senha.php?hash=$link</a><br /> <br />";
				$mensagem .= "Nova senha: " .$nick."13277";

				/* Enviando a mensagem */

				mail($para, $assunto, $mensagem, $headers,"-r".$emailsender) or die ("ERRO ao enviar mensagem!");
				
                                $this->resultado = "OK";
                                } else {

                                    $this->resultado = "NAO";
                                }


			}
}
?>
