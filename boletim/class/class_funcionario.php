<?php

/**
 * classe para manipulação dos dados referente a instituicão
 *
 * @author Administrador
 */
class Class_funcionario
{

     public $cod_funcionario;
     public $nome;
     public $email;
     public $cod_cidade;
     public $cod_bairro;
     public $cod_rua;
     public $complemento;
     public $numero;
     public $cod_uf;
     public $telefone;
     public $cod_status;
     public $resultado;
     public $cod_instituicao;
     public $cep;
     public $cargo;
     public $identidade;
          
     public function insert_funcionario($nome,$email,$cod_cidade,$cod_bairro,$cod_rua,$complemento,$numero,$cod_uf,$telefone,$cod_status,$cod_instituicao,$cep,$cargo,$cod_cargo,$identidade)
     {

         session_start();

         $instituicao = $_SESSION['instituicao'];

         $pasta = $_SESSION['pasta'];

         $cod_instituicao = (int) $_SESSION['id_instituicao'];

          $emailLogin = explode(' ', $nome);

        if($email == ""){

        $email = $emailLogin[0].$this->geraSenha().'@boletimfex.com.br';
        }


        if($identidade == ""){
        $identidade = $this->geraSenha(8, false, true);
        }


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_funcionario FROM funcionario WHERE email = '$email'") or die ("Erro select ". mysql_error());
         $query_select2 = mysql_query("SELECT cod_usuario FROM usuario WHERE email = '$email'") or die ("Erro select ". mysql_errno());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);
         $quant2 = mysql_num_rows($query_select2);

		// se retornou então envia a mensagem
            if ($quant > 0 or $quant2 > 0)
            {
            // verificando se a query retornou algum valor
	    
                 $this->resultado = "NAO";
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO funcionario VALUE (NULL, '$nome','$email','$cod_cidade','$cod_bairro','$cod_rua','$complemento','$numero','$cod_uf','$telefone','$cod_status', '$cod_instituicao','$cep','$cargo','$identidade')") or die ("Erro insert ". mysql_erro());
                     
                     $query_grid = mysql_query("SELECT cod_funcionario, funcionario.nome, cidade_nome , telefone FROM funcionario, cidade WHERE funcionario.cod_cidade = cidade_id AND cod_instituicao = '$cod_instituicao' AND cod_status = 1 ORDER BY funcionario.nome",$conn) or die ("Error na consulta ". mysql_error());

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

                        $query_consulta = mysql_query("SELECT cod_funcionario FROM funcionario WHERE cod_instituicao = '$cod_instituicao' ORDER BY cod_funcionario DESC LIMIT 1",$conn) or die ("Error na consulta ". mysql_error());
                        $resultado = mysql_fetch_array($query_consulta);
                        $senha =  md5($identidade);
                        $query_insert = mysql_query("INSERT INTO usuario VALUE (NULL, '$nome','$email','$senha',$cod_cargo,3,$resultado[0],'$cod_instituicao','$email')") or die ("Erro insert ". mysql_error());


                        // envio do email ---------------------------------------------------------------------------------------------------

				$para = $email;
                                $emailsender = "equipe@boletimflex.com";
                                

                                $str[0] = utf8_decode("Olá");
                                $str[1] = utf8_decode("Instituição");
                                $str[2] = utf8_decode("Área Restrita");
                                $str[3] = utf8_decode($cargo);

                                $assunto = "Cadastro Boletimflex!";

				$headers = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\n";
				$headers .= "From: boletimflex <equipe@boletimflex.com>\n";

				$headers .= "Return-Path: boletimflex <equipe@boletimflex.com>";

				$mensagem = "$str[0]!, $nome. <br /> <br />";
				$mensagem .= "Voce foi cadastrado pela $str[1] $instituicao no sistema boletimflex, abaixo segue seus dados de acesso! <br /> <br />";
				$mensagem .= "<a href=\"http://www.boletimflex.com/boletim/$pasta\">http://www.boletimflex.com/boletim/$pasta</a><br /> <br />";
				$mensagem .= "$str[2]: $str[3]. <br />";
                                $mensagem .= "login: " .$email. "<br />";
                                $mensagem .= "senha: " .$pasta."123";

				/* Enviando a mensagem */

				mail($para, $assunto, $mensagem, $headers,"-r".$emailsender) or die ("ERRO ao enviar mensagem!");




                     $this->resultado = "ok";
                }
     }// fim do método

     public function select_grid_funcionario() { // método para preenchimento da grid no form


         session_start();


         $cod_instituicao = (int) $_SESSION['id_instituicao'];


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                    $query_grid = mysql_query("SELECT cod_funcionario, funcionario.nome, cidade_nome , telefone FROM funcionario, cidade WHERE funcionario.cod_cidade = cidade_id AND cod_instituicao = '$cod_instituicao' AND cod_status = 1 ORDER BY funcionario.nome",$conn) or die ("Error na consulta");

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
                     
                     
     }

     public function select_funcionario($cod_funcionario){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT funcionario.nome, funcionario.email, funcionario.cod_cidade, cidade_nome, funcionario.cod_bairro, bairro_nome, funcionario.cod_rua, rua_nome, funcionario.complemento, funcionario.numero, funcionario.cod_uf, uf_sigla, funcionario.telefone, funcionario.cod_status, status.nome, funcionario.cod_instituicao, instituicao.nome, funcionario.cep, funcionario.cod_funcionario, cargo, identidade FROM funcionario, cidade, bairro, rua, uf, status, instituicao WHERE funcionario.cod_cidade = cidade.cidade_id AND funcionario.cod_bairro = bairro.bairro_id AND funcionario.cod_rua = rua_id AND funcionario.cod_status = status.cod_status AND funcionario.cod_uf = uf_id AND funcionario.cod_instituicao = instituicao.cod_instituicao AND cod_funcionario = '$cod_funcionario'") or die (mysql_error(). "erro em select");

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
			    echo "&cargo=$result[19]";
                            echo "&identidade=$result[20]";
                            

                        
                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function update_funcionario($nome,$email,$cod_cidade,$cod_bairro,$cod_rua,$complemento,$numero,$cod_uf,$telefone,$cod_status,$cod_funcionario,$cod_instituicao,$cep,$cargo,$cod_cargo,$identidade)
     {

         session_start();

         $instituicao = $_SESSION['instituicao'];

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
         
                     $query_insert = mysql_query("UPDATE funcionario SET nome = '$nome', email = '$email', cod_cidade = '$cod_cidade', cod_bairro = '$cod_bairro', cod_rua = '$cod_rua', complemento = '$complemento', numero = '$numero', cod_uf = '$cod_uf', telefone = '$telefone', cod_status = '$cod_status', cod_instituicao = '$cod_instituicao', cep = '$cep', cargo = '$cargo', identidade = '$identidade' WHERE cod_funcionario = '$cod_funcionario'") or die ("Erro insert ". mysql_error());
					
		     $query_insert = mysql_query("UPDATE usuario SET usuario_atrib = '$cod_cargo' WHERE referencia = 3 AND cod_aluno_professor = '$cod_funcionario' AND cod_instituicao = '$cod_instituicao'") or die ("Erro insert ". mysql_errno());

         if($cod_status > 1){

             $query_update = mysql_query("UPDATE usuario SET usuario_atrib = 6 WHERE cod_aluno_professor = '$cod_funcionario' AND referencia = 3") or die("ERRO!");
         } else if($cod_status == 1){

              $query_update = mysql_query("UPDATE usuario SET usuario_atrib = '$cod_cargo' WHERE cod_aluno_professor = '$cod_funcionario' AND referencia = 3") or die("ERRO!");
         }
					
                     $query_grid = mysql_query("SELECT cod_funcionario, funcionario.nome, cidade_nome , telefone FROM funcionario, cidade WHERE funcionario.cod_cidade = cidade_id AND cod_instituicao = '$cod_instituicao' AND cod_status = 1 ORDER BY funcionario.nome",$conn) or die ("Error na consulta");

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

     public function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false, $minusculas = false)

 {

 // Caracteres de cada tipo

 $lmin = 'abcdefghijklmnopqrstuvwxyz';

 $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

 $num = '1234567890';

 $simb = '!@#$%*-';



 // Variáveis internas

 $retorno = '';

 $caracteres = '';



 // Agrupamos todos os caracteres que poderão ser utilizados

 if ($minusculas) $caracteres .= $lmin;

 if ($maiusculas) $caracteres .= $lmai;

 if ($numeros) $caracteres .= $num;

 if ($simbolos) $caracteres .= $simb;



 // Calculamos o total de caracteres possíveis

 $len = strlen($caracteres);



 for ($n = 1; $n <= $tamanho; $n++) {

 // Criamos um número aleatório de 1 até $len para pegar um dos caracteres

 $rand = mt_rand(1, $len);

 // Concatenamos um dos caracteres na variável $retorno

 $retorno .= $caracteres[$rand-1];

 }



return $this->senha = $retorno;

 }


}
?>
