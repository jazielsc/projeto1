<?php

/**
 * classe para manipulação dos dados referente a instituicão
 *
 * @author Administrador
 */
class Class_aluno
{

     public $cod_aluno;
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
     public $responsavel;
     public $email_responsavel;
     public $cod_curso;
     public $identidade;
     public $datanasc;
     public $celular;
     public $foto;
     public $opcao;
          
     public function insert_aluno($nome,$email,$cod_cidade,$cod_bairro,$cod_rua,$complemento,$numero,$cod_uf,$telefone,$cod_status,$cod_instituicao,$matricula,$cep,$responsavel,$email_responsavel,$cod_curso,$identidade,$datanasc,$celular,$opcao)
     {
        session_start();
        $instituicao = $_SESSION['instituicao'];
        $foto = null;

        $emailLogin = explode(' ', $nome);
        $emailResponsavel = explode(' ', $responsavel);

        if($email == ""){
            
        $email = $emailLogin[0].$this->geraSenha().'@boletimflex.com.br';
        }

        if($email_responsavel == ""){

        $email_responsavel = $emailResponsavel[0].$this->geraSenha().'@boletimflex.com.br';
        }

        
        if($identidade == ""){
        $identidade = $this->geraSenha(8, false, true);
        }


         if(!empty($datanasc)){ // testando se foi passado algum valor para variável

                $datanasc = explode("/", $datanasc);
                $datanasc = $datanasc[2]."-".$datanasc[1]."-".$datanasc[0];

                } else {

                    $datanasc = '0000-00-00';
                }

         
         $pasta = $_SESSION['pasta'];
         

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         if($opcao == 1){

             $or = "OR email_responsavel = '$email_responsavel'";
         } else{

             $or = "";
         }




         $query_select = mysql_query("SELECT cod_aluno FROM aluno WHERE aluno.email = '$email' $or") or die ("Erro select ". mysql_error());
         $query_select2 = mysql_query("SELECT cod_usuario FROM usuario WHERE email = '$email'") or die ("Erro select ". mysql_error());

         $query_select3 = mysql_query("SELECT cod_aluno FROM aluno WHERE identidade = '$identidade' AND cod_instituicao = '$cod_instituicao'") or die ("Erro select ". mysql_error());


	 // verificando se a query retornou algum valor
	 $quant = mysql_num_rows($query_select);
         $quant2 = mysql_num_rows($query_select2);

         $quant3 = mysql_num_rows($query_select3);

         if ($quant3 > 0)
            {

             $this->resultado = "identidade";

            }
		// se retornou então envia a mensagem
            else if ($quant > 0 or $quant2 > 0)
            {
		
                 $this->resultado = "NAO";
            } else
                 {
                     $query_insert = mysql_query("INSERT INTO aluno VALUE (NULL, '$nome','$email','$cod_cidade','$cod_bairro','$cod_rua','$complemento','$numero','$cod_uf','$telefone','$cod_status', '$cod_instituicao','$matricula', '$cep','$responsavel','$email_responsavel', '$cod_curso','$identidade','$datanasc','$celular','$foto','$opcao')") or die ("Erro insert 0 ". mysql_errno());
                     
                     $query_grid = mysql_query("SELECT cod_aluno, aluno.nome, cidade_nome , telefone FROM aluno, cidade WHERE aluno.cod_cidade = cidade_id AND cod_instituicao = '$cod_instituicao' AND cod_status = 1 ORDER BY aluno.nome",$conn) or die ("Error na consulta");

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

                        $query_consulta = mysql_query("SELECT cod_aluno FROM aluno WHERE cod_instituicao = '$cod_instituicao' ORDER BY cod_aluno DESC LIMIT 1",$conn) or die ("Error na consulta");
                        $resultado = mysql_fetch_array($query_consulta);
                        $senha =  md5($identidade);
                        $query_insert = mysql_query("INSERT INTO usuario VALUE (NULL, '$nome','$email','$senha',3,1,'$resultado[0]','$cod_instituicao','$email')") or die ("Erro insert2 ". mysql_errno());

                        $query_insert2 = mysql_query("INSERT INTO aluno_curso VALUE ('$resultado[0]','$cod_curso')") or die ("Erro insert3 ". mysql_errno());

                        if($opcao == 1){

                        $query_insert2 = mysql_query("INSERT INTO usuario VALUE (NULL, '$responsavel','$email_responsavel','$senha',3,4,'$resultado[0]','$cod_instituicao','$email_responsavel')") or die ("Erro insert3 ". mysql_error());
                        }
                          
                                // envio do email ---------------------------------------------------------------------------------------------------
                               /*
				$para = $email;
                                $emailsender = "equipe@boletimflex.com";
                                $area = "Alunos";
                                                                
                                $str[0] = utf8_decode("Olá");
                                $str[1] = utf8_decode("Instituição");
                                $str[2] = utf8_decode("Área Restrita");
                                $str[3] = utf8_decode("Responsáveis");

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
                                $mensagem .= "senha: " .$identidade;

				// Enviando a mensagem

				mail($para, $assunto, $mensagem, $headers,"-r".$emailsender) or die ("ERRO ao enviar mensagem!");

                                if($opcao == 1){

                                $para2 = $email_responsavel;

                                $mensagem2 = "$str[0]!, $responsavel. <br /> <br />";
				$mensagem2 .= "Voce foi cadastrado pela $instituicao no sistema boletimflex, abaixo segue seus dados de acesso! <br /> <br />";
				$mensagem2 .= "<a href=\"http://www.boletimflex.com/boletim/$pasta\">http://www.boletimflex.com/boletim/$pasta</a><br /> <br />";
				$mensagem2 .= "$str[2]: $str[3]. <br />";
                                $mensagem2 .= "login: " .$email_responsavel. "<br />";
                                $mensagem2 .= "senha: " .$identidade;



                               mail($para2, $assunto, $mensagem2, $headers,"-r".$emailsender) or die ("ERRO ao enviar mensagem!");

                           }
                           
                      */
                     $this->cod_aluno = $resultado[0];

                     $this->resultado = "ok";
                }
     }// fim do método

     public function select_grid_aluno() { // método para preenchimento da grid no form
                      session_start();
                      $cod_instituicao = (int) $_SESSION['id_instituicao'];
                     include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
                     // consulta para atualizar o grid no flash
                    $query_grid = mysql_query("SELECT cod_aluno, aluno.nome, cidade_nome , telefone FROM aluno, cidade WHERE aluno.cod_cidade = cidade_id AND cod_instituicao = '$cod_instituicao' AND cod_status = 1 ORDER BY aluno.nome",$conn) or die ("Error na consulta");

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

     public function select_aluno($cod_aluno){

         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

         $query_select = mysql_query("SELECT aluno.nome, aluno.email, aluno.cod_cidade, cidade_nome, aluno.cod_bairro, bairro_nome, aluno.cod_rua, rua_nome, aluno.complemento, aluno.numero, aluno.cod_uf, uf_sigla, aluno.telefone, aluno.cod_status, status2.nome, aluno.cod_instituicao, instituicao.nome, matricula, aluno.cep, aluno.responsavel, email_responsavel, curso.cod_curso, curso.nome, aluno.cod_aluno, aluno.identidade, date_format(aluno.datanasc,'%d/%m/%Y') AS data, celular, aluno.foto, aluno.opcao FROM aluno, cidade, bairro, rua, uf, status2, instituicao, curso WHERE aluno.cod_curso = curso.cod_curso AND curso.cod_instituicao = instituicao.cod_instituicao AND aluno.cod_cidade = cidade.cidade_id AND aluno.cod_bairro = bairro.bairro_id AND aluno.cod_rua = rua_id AND aluno.cod_status = status2.cod_status AND aluno.cod_uf = uf_id AND aluno.cod_instituicao = instituicao.cod_instituicao AND cod_aluno = '$cod_aluno'") or die (mysql_error(). "erro em select");

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
                            echo "&matricula=$result[17]";
                            echo "&cep=$result[18]";
                            echo "&responsavel=$result[19]";
                            echo "&email_responsavel=$result[20]";
                            echo "&cod_curso=$result[21]";
                            echo "&nome_curso=$result[22]";
                            echo "&codigo=$result[23]";
                            echo "&identidade=$result[24]";
                            echo "&datanasc=$result[25]";
                            echo "&celular=$result[26]";
                            echo "&foto=$result[27]";
                            echo "&opcao=$result[28]";
                            

                        
                $this->resultado = "OK";
        } else {

          $this->resultado = "nao";
        }
     }


     public function update_aluno($nome,$email,$cod_cidade,$cod_bairro,$cod_rua,$complemento,$numero,$cod_uf,$telefone,$cod_status,$cod_aluno,$cod_instituicao,$matricula,$cep,$responsavel,$email_responsavel,$cod_curso,$identidade,$datanasc,$celular,$opcao)
     {
         include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");



         if($cod_status > 1){

             $query_update = mysql_query("UPDATE usuario SET usuario_atrib = 6 WHERE cod_aluno_professor = '$cod_aluno' AND referencia = 1") or die("ERRO!");
			 $query_update = mysql_query("UPDATE usuario SET usuario_atrib = 6 WHERE cod_aluno_professor = '$cod_aluno' AND referencia = 4") or die("ERRO!");
			 
			 
         } else if($cod_status == 1){
             
              $query_update = mysql_query("UPDATE usuario SET usuario_atrib = 3 WHERE cod_aluno_professor = '$cod_aluno' AND referencia = 1") or die("ERRO!");
			  
			  $query_update = mysql_query("UPDATE usuario SET usuario_atrib = 3 WHERE cod_aluno_professor = '$cod_aluno' AND referencia = 4") or die("ERRO!");
         }


         if(!empty($datanasc)){ // testando se foi passado algum valor para variável

                $datanasc = explode("/", $datanasc);
                $datanasc = $datanasc[2]."-".$datanasc[1]."-".$datanasc[0];

                } else {

                    $datanasc = '0000-00-00';
                }

         
                     $query_insert = mysql_query("UPDATE aluno SET nome = '$nome', email = '$email', cod_cidade = '$cod_cidade', cod_bairro = '$cod_bairro', cod_rua = '$cod_rua', complemento = '$complemento', numero = '$numero', cod_uf = '$cod_uf', telefone = '$telefone', cod_status = '$cod_status', cod_instituicao = '$cod_instituicao', matricula = '$matricula', cep = '$cep', cod_curso = '$cod_curso', identidade = '$identidade', datanasc = '$datanasc', responsavel = '$responsavel', email_responsavel = '$email_responsavel', celular = '$celular', opcao = '$opcao' WHERE cod_aluno = '$cod_aluno'") or die ("Erro insert ". mysql_errno());

                     $query_grid = mysql_query("SELECT cod_aluno, aluno.nome, cidade_nome , telefone FROM aluno, cidade WHERE aluno.cod_cidade = cidade_id AND cod_status = 1 AND cod_instituicao = '$cod_instituicao' ORDER BY aluno.nome",$conn) or die ("Error na consulta");

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

     public function select_grid_plano_aula_aluno($semestre,$datas,$disciplina) { // método para preenchimento da grid no form

         session_start();
     $cod_aluno = $_SESSION['id_aluno_professor'];

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

                   $query_grid = mysql_query("SELECT cod_plano_aula, date_format(dia,'%d/%m/%Y') AS data, inicio, termino, calendario, disciplina.nome, professor.nome, turma.nome FROM plano_aula, disciplina, professor, turma, aluno, item2 WHERE item2.cod_disciplina = disciplina.cod_disciplina AND disciplina.cod_disciplina = '$disciplina' AND item2.cod_aluno = aluno.cod_aluno AND item2.cod_aluno = '$cod_aluno' AND semestre = '$semestre' AND disciplina.cod_professor = professor.cod_professor AND plano_aula.cod_disciplina = disciplina.cod_disciplina AND turma.cod_turma = disciplina.cod_turma AND plano_aula.cod_turma = turma.cod_turma AND plano_aula.cod_professor = professor.cod_professor $where ORDER BY  dia_numero, calendario, inicio",$conn) or die ("Error na consulta1");

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
