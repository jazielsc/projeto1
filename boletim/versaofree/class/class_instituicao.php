<?php


/**
 * classe para manipulação dos dados referente a instituicão
 *
 * @author Administrador Leonardo Capistrano
 */
class Class_instituicao
{

     public $cod_instituicao;
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
     public $cep;
     public $responsavel;
     public $mensalidade;
     public $contrato;
     public $data_ass;
     public $dia_base;
     public $pagamento;
     public $parcelas;
     public $pasta;
     public $cod_tipo;
     public $ranking;
     public $media;
     public $paraela;

          
     public function insert_instituicao($nome,$email,$cod_cidade,$cod_bairro,$cod_rua,$complemento,$numero,$cod_uf,$telefone,$cod_status,$cep,$responsavel,$mensalidade, $contrato, $data_ass, $dia_base, $pagamento, $parcelas, $adesao, $pasta, $file, $tipo)
     {


           

         if(!empty($data_ass)){ // testando se foi passado algum valor para variável

                $data_ass = explode("/", $data_ass);
                $data_ass = $data_ass[2]."-".$data_ass[1]."-".$data_ass[0];

                } else {

                    $data_ass = date("Y-m-d");
                }


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT cod_instituicao FROM instituicao WHERE nome = '$nome' or email = '$email'") or die ("Erro select ". mysql_errno());
         $query_select2 = mysql_query("SELECT cod_usuario FROM usuario WHERE email = '$email'") or die ("Erro select ". mysql_errno());

	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);
         $quant2 = mysql_num_rows($query_select2);

		// se retornou então envia a mensagem
            if ($quant > 0)
            {
                 $this->resultado = "NAO";

            }else if($quant2 > 0) {

                $this->resultado = "email_usuario";
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO instituicao VALUE (NULL, '$nome','$email','$cod_cidade','$cod_bairro','$cod_rua','$complemento','$numero','$cod_uf','$telefone','$cod_status', '$cep', '$responsavel','$mensalidade', '$contrato', '$data_ass', '$dia_base', '$pagamento', '$parcelas', '$adesao','$pasta', '$file', '$tipo')") or die ("Erro insert ". mysql_errno());
                     $query_consulta = mysql_query("SELECT cod_instituicao FROM instituicao ORDER BY cod_instituicao DESC LIMIT 1",$conn) or die ("Error na consulta");
                     $resultado = mysql_fetch_array($query_consulta);

                     
                     

                    // cria uma pasta
                     mkdir ("/home/storage/7/23/a7/boletimflex/public_html/boletim/$pasta", 0755 );
                    // mkdir ("/home/storage/7/23/a7/boletimflex/public_html/boletim/$pasta/fotos", 0755 );
                     // Abre ou cria o arquivo 
                    // "a" representa que o arquivo é aberto para ser escrito
                    $fp = fopen("/home/storage/7/23/a7/boletimflex/public_html/boletim/$pasta/index.php", "a");

                    // Escreve "exemplo de escrita" no config.php

                        $conteudo = '$_'."SESSION['id_instituicao'] = $resultado[0];";

                        $escreve = fwrite($fp, "<?php
                        session_start();
                        $conteudo
                        Header('Location: ../index.php');

                        ?>");

                   
                    $senha =  md5($pasta."123");
                    $query_insert = mysql_query("INSERT INTO usuario VALUE (NULL, '$responsavel','$email','$senha',1,0,0,'$resultado[0]','$email')") or die ("Erro insert ". mysql_errno());
					
$query_insert = mysql_query("INSERT INTO config VALUE (7,2,30,'$resultado[0]',1)") or die ("Erro insert ". mysql_errno());

                    // Fecha o arquivo
                    fclose($fp);


	

                     $query_grid = mysql_query("SELECT cod_instituicao, instituicao.nome, cidade_nome , telefone FROM instituicao, cidade WHERE instituicao.cod_cidade = cidade_id ORDER BY instituicao.nome",$conn) or die ("Error na consulta");

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


                        // envio do email ---------------------------------------------------------------------------------------------------

				$para = $email;
                                $emailsender = "equipe@boletimflex.com";

                                $str[0] = utf8_decode("Olá");
                                $str[1] = utf8_decode("Instituição");
                                $str[2] = utf8_decode("Área Restrita");
                                $str[3] = utf8_decode("Direção");

				$assunto = "Cadastro Boletimflex!";

				$headers = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\n";
				$headers .= "From: boletimflex <equipe@boletimflex.com>\n";

				$headers .= "Return-Path: boletimflex <equipe@boletimflex.com>";

				$mensagem = "$str[0]!, $responsavel. <br /> <br />";
				$mensagem .= "Voce foi cadastrado pela $str[1] $nome no sistema boletimflex, abaixo segue seus dados de acesso! <br /> <br />";
				$mensagem .= "<a href=\"http://www.boletimflex.com.br/boletim/$pasta\">http://www.boletimflex.com.br/boletim/$pasta</a><br /> <br />";
				$mensagem .= "$str[2]: $str[3]. <br />";
                                $mensagem .= "login: " .$email. "<br />";
                                $mensagem .= "senha: " .$pasta."123";

				/* Enviando a mensagem */

				mail($para, $assunto, $mensagem, $headers,"-r".$emailsender) or die ("ERRO ao enviar mensagem!");



                     $this->resultado = "ok";
                     $this->cod_instituicao = $resultado[0];
                     
                }
     }// fim do método

     public function select_grid_instituicao() { // método para preenchimento da grid no form

                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                    $query_grid = mysql_query("SELECT cod_instituicao, instituicao.nome, cidade_nome , telefone FROM instituicao, cidade, colaborador_instituicao WHERE colaborador_instituicao.cod_instituicao = instituicao.cod_instituicao AND colaborador_instituicao.cod_colaborador = '$cod_colaborador' AND instituicao.cod_cidade = cidade_id ORDER BY instituicao.nome",$conn) or die ("Error na consulta");

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

     public function select_instituicao($cod_instituicao){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT instituicao.nome, email, cod_cidade, cidade_nome, cod_bairro, bairro_nome, cod_rua, rua_nome, complemento, numero, cod_uf, uf_sigla, telefone, instituicao.cod_status, status.nome, instituicao.cep, responsavel, mensalidade, contrato, date_format(data_ass,'%d/%m/%Y') AS data_ass, dia_base, cod_pagamento, forma_pagamento.nome, parcelas, adesao, pasta FROM instituicao, cidade, bairro, rua, uf, status, forma_pagamento WHERE cod_pagamento = pagamento AND cod_cidade = cidade.cidade_id AND cod_bairro = bairro.bairro_id AND cod_rua = rua_id AND instituicao.cod_status = status.cod_status AND cod_uf = uf_id AND cod_instituicao = '$cod_instituicao'") or die (mysql_error(). "erro em select");

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
                            echo "&cep=$result[15]";
                            echo "&responsavel=$result[16]";
                            echo "&mensalidade=$result[17]";
                            echo "&contrato=$result[18]";
                            echo "&data_ass=$result[19]";
                            echo "&dia_base=$result[20]";
                            echo "&cod_pagamento=$result[21]";
                            echo "&pagamento=$result[22]";
                            echo "&parcelas=$result[23]";
                            echo "&adesao=$result[24]";
                            echo "&pasta=$result[25]";

                        
                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function update_instituicao($nome,$email,$cod_cidade,$cod_bairro,$cod_rua,$complemento,$numero,$cod_uf,$telefone,$cod_status,$cod_instituicao,$cep,$responsavel,$mensalidade, $contrato, $data_ass, $dia_base, $pagamento, $parcelas, $adesao, $pasta)
     {
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         if(!empty($data_ass)){ // testando se foi passado algum valor para variável

                $data_ass = explode("/", $data_ass);
                $data_ass = $data_ass[2]."-".$data_ass[1]."-".$data_ass[0];

                } else {

                    $data_ass = '0000-00-00';
                }

         
                     $query_insert = mysql_query("UPDATE instituicao SET nome = '$nome', email = '$email', cod_cidade = '$cod_cidade', cod_bairro = '$cod_bairro', cod_rua = '$cod_rua', complemento = '$complemento', numero = '$numero', cod_uf = '$cod_uf', telefone = '$telefone', cod_status = '$cod_status', cep = '$cep', responsavel = '$responsavel', mensalidade = '$mensalidade', contrato = '$contrato', data_ass = '$data_ass', dia_base = '$dia_base', pagamento = '$pagamento', parcelas = '$parcelas', adesao = '$adesao' WHERE cod_instituicao = '$cod_instituicao'") or die ("Erro insert ". mysql_errno());

                     $query_grid = mysql_query("SELECT cod_instituicao, instituicao.nome, cidade_nome , telefone FROM instituicao, cidade WHERE instituicao.cod_cidade = cidade_id ORDER BY instituicao.nome",$conn) or die ("Error na consulta");

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

     public function update_config($media,$cod_tipo,$ranking,$cod_paralela)
     {


         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
         session_start();
         $cod_instituicao = (int) $_SESSION['id_instituicao'];
         

                     $query_insert = mysql_query("UPDATE config SET media = '$media', cod_tipo = '$cod_tipo', ranking = '$ranking', cod_paralela = '$cod_paralela' WHERE cod_instituicao = '$cod_instituicao'") or die ("Erro insert ". mysql_error());

                    

                     $this->resultado = "ok";

                     echo"&resultado=ok";

     }// fim do método
}
?>
