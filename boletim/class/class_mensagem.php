<?php

// classe referente a manipulação da mensagens e prioridade no sistema
// Autor: Leonardo Marinho Capistrano
// Bacharel em Sistemas de Informação - Desenvolvedor WEB


class Class_mensagem
{


    public $cod_instituicao;
    public $id;
    public $cod_des;
    public $data;
    public $hora;
    public $prioridade; // verifica se é normal, urgente ou se é um comunicado. urgente = 3, comunicado = 2, normal = 1
    public $assunto;
    public $nick;
    public $mensagens;
    public $nlidas;
    public $status; // se status = 1 mensagem lida se staus = 2 n lida. 3 lixeira
    public $tipo; // verifica se a mensagem é individual ou é para o grupo se tipo = 1 individual se = 2 grupo
    public $referencia;
    public $mensagem;
    public $resultado;


	public function __construct() // pegando o número de mensagens não lidas
	{

                session_start();
                include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

		if  (isset($_SESSION['id_usuario']))
		{
			$id = $_SESSION['id_usuario'];

			$query_mensagem = mysql_query("SELECT COUNT(cod_mensagem) AS cont FROM mensagem WHERE  status = 2 AND id_des = '$id'") or die ("Erro em consultar            mensagem");

			if (mysql_num_rows($query_mensagem)>0)
			{
				$n_lidas = mysql_result($query_mensagem,0,"cont");
                                echo "&n_lidas=$n_lidas";

			} else {

              $n_lidas = 0;

             echo "&n_lidas=$n_lidas";

            }
		}

    }

	public function cad_mensagem($assunto,$mensagens,$tipo,$prioridade,$referencia,$cod_usuario)
	{

        
        $status = 2;
	$id = $_SESSION['id_usuario'];
        $nick = $_SESSION['NomeUsuario'];
	$data = date("Y-m-d");
        $hora = date("H:i:s");


        if ($tipo == 2) {

        $select_grupo = mysql_query("SELECT cod_usuario FROM usuario WHERE referencia = '$referencia'") or die ("deu erro...");
        $i=0;
        while ($cod_des = mysql_fetch_array($select_grupo))
		{

           $query_insert = mysql_query("INSERT INTO mensagem VALUE(NULL, '$assunto', '$mensagens', '$data', '$id', '$cod_des[0]', '$prioridade', '$status', '$hora')")or die ("eroo1".mysql_error());
           $query_insert_2 = mysql_query("INSERT INTO mensagem_enviadas VALUE(NULL, '$assunto', '$mensagens', '$data', '$id', '$cod_des[0]', '$prioridade', '$status', '$hora')")or die ("eroo2".mysql_error());

           $i++;
        }

        $this->resultado = "ok";

        } else {


		$query_select = mysql_query("SELECT cod_usuario, usuario_login, nome FROM usuario WHERE cod_aluno_professor = '$cod_usuario' AND referencia = '$referencia'");

		$quant = mysql_num_rows($query_select);

		// se retornou então preenche os dados
		if ($quant > 0)
		{

			$result = mysql_fetch_array($query_select);
			$cod_des = $result[0];
			$status = 2;
			$id = $_SESSION['id_usuario'];
			$data = date("Y-m-d");
			$hora = date("H:i:s");

			$query_insert = mysql_query("INSERT INTO mensagem VALUE(NULL, '$assunto', '$mensagens', '$data', '$id', '$cod_des', '$prioridade', '$status','$hora')") or die ("eroo1".mysql_error());
			$query_insert_2 = mysql_query("INSERT INTO mensagem_enviadas VALUE(NULL, '$assunto', '$mensagens', '$data', '$id', '$cod_des', '$prioridade', '$status', '$hora')") or die ("eroo2".mysql_error());

                         /*
			$query_enviar = mysql_query("SELECT usuario_login, nome FROM usuario WHERE cod_usuario = '$id'");

			$resultado = mysql_fetch_array($query_enviar);

			$email = $resultado[0];
			$nickk = $resultado[1];

                               
				$para = $result[1];
				$assuntos = "Mensagem recebida no sistema e-rdez";

				$headers = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\n";

				$headers .= "From: Sistema e-rdez <gerencia@we-export.com.br>\n";

				$headers .= "Return-Path: Sistema e-rdez <gerencia@we-export.com.br>";

				$mensagem = "Olá, $nick! <br />";
				$mensagem .= "Você recebeu uma nova mensagem do usuário $nickk no sitemea e-rdez <br />";
				$mensagem .= "www.we-export.com.br";


				// Enviando a mensagem

				mail($para, $assuntos, $mensagem, $headers) or die ("ERRO ao enviar mensagem!");
                                */

				$this->resultado = "ok";
				//echo "<script language='javascript'>javascript:history.go(-1);</script>";
        
                                
        }


		else
		$this->resultado = "erro";
        }

	}	// fim método






	public function consulta_grid_mensagem($filtro)
	{


            $cod_usuario = $_SESSION['id_usuario']; // pegando o código do usuário depois do mesmo logar no site

            if ($filtro == 1){
            $tabela = "mensagem";
            $where = "cod_usuario = id_des AND id_des = '$cod_usuario'";
            }
            else if ($filtro == 2){
            $tabela = "mensagem_enviadas";
            $where = "cod_usuario = id_des AND id_rem = '$cod_usuario'";
            }
            else{
            $tabela = "mensagem_lixeira";
            $where = "cod_usuario = id_des AND id_des = '$cod_usuario'";
            }

            
                $query_select = mysql_query("SELECT cod_mensagem, assunto, DATE_FORMAT(data, '%d/%m/%Y') AS DATAS, nome, status FROM $tabela, usuario WHERE $where ORDER BY cod_mensagem DESC");

		$quant = mysql_num_rows($query_select);

		// se retornou então preenche os dados
		if ($quant > 0)
		{
			$i = 0;

			while ($result = mysql_fetch_array($query_select))
			{


                
				
                                echo"&codigo$i=$result[0]"; // esse código vai ser usado no link
                                echo"&assunto$i=$result[1]";
				echo"&datas$i=$result[2]";
				echo"&nome$i=$result[3]";
				echo"&status$i=$result[4]"; // testa se foi lida ou n


				$cont_mensagem = $i; // contador


			$i++;
			} // fim do primerio while
			$this->registros_men = $i;

		}else
		$this->cont_mensagem = -1;
	}


    public function consulta_mensagem2() // faz a consulta da tela inicial
	{



		$cod_usuario = $_SESSION['id']; // pegando o código do usuário depois do mesmo logar no site

        $query = mysql_query("SELECT prioridade FROM mensagem, colaborador WHERE status = 2 AND colaborador.id = id_rem AND id_des = '$cod_usuario' ORDER BY prioridade DESC, cod_mensagem DESC LIMIT 0,1");
        $resultado = mysql_fetch_array($query);

        $quantidade = mysql_num_rows($query);

        if ($quantidade > 0){

         // urgente = 3, comunicado = 2, normal = 1

        if ( $resultado[0] == 3){

               echo '<script> $("#alerta_msg").removeClass("alerta_inativo");</script>';
               echo '<script> $("#alerta_msg").removeClass("alerta_normal");</script>';
               echo '<script> $("#alerta_msg").addClass("alerta_alerta");</script>';

         } else if ($resultado[0] == 2 or $resultado[0] == 1){


               echo '<script> $("#alerta_msg").removeClass("alerta_inativo");</script>';
               echo '<script> $("#alerta_msg").removeClass("alerta_alerta");</script>';
               echo '<script> $("#alerta_msg").addClass("alerta_normal");</script>';

         }

        } else {


              echo '<script> $("#alerta_msg").removeClass("alerta_normal");</script>';
               echo '<script> $("#alerta_msg").removeClass("alerta_alerta");</script>';
               echo '<script> $("#alerta_msg").addClass("alerta_inativo");</script>';

        }

		$query_select = mysql_query("SELECT assunto, SUBSTRING( mensagem, 1, 30), DATE_FORMAT(data, '%d/%m/%Y') AS DATAS, hora, cod_mensagem, prioridade FROM mensagem, colaborador WHERE status = 2 AND colaborador.id = id_rem AND id_des = '$cod_usuario' ORDER BY prioridade DESC, cod_mensagem DESC LIMIT 0,3");

		$quant = mysql_num_rows($query_select);




		// se retornou então preenche os dados
		if ($quant > 0)
		{
			$i = 0;

			while ($result = mysql_fetch_array($query_select))
			{

        $datas = explode("/", $result[2]);
        $datas = $datas[0]."/".$datas[1];

        $horas = explode(":", $result[3]);
        $horas = $horas[0].":".$horas[1];


                $this->assunto[$i] = $result[0];
				$this->mensagem[$i]= $result[1];
				$this->datas[$i]= $datas;
				$this->hora[$i]= $horas;
				$this->cod_mensagem[$i]= $result[4];






				$this->cont_mensagem = $i; // contador


			$i++;
			} // fim do primerio while
			$this->registros_men = $i;

		}else
		$this->cont_mensagem = -1;
	}


    public function consulta_comunicados() // faz a consulta da tela inicial
	{



		$cod_usuario = $_SESSION['id']; // pegando o código do usuário depois do mesmo logar no site

		$query_select = mysql_query("SELECT assunto, mensagem, DATE_FORMAT(data, '%d/%m/%Y') AS DATAS, hora FROM mensagem WHERE id_des = '$cod_usuario' AND status != 3 AND prioridade = 2 ORDER BY cod_mensagem DESC");

		$quant = mysql_num_rows($query_select);


		// se retornou então preenche os dados
		if ($quant > 0)
		{
			$i = 0;

			while ($result = mysql_fetch_array($query_select))
			{

        $datas = explode("/", $result[2]);
        $datas = $datas[0]."/".$datas[1];

        $horas = explode(":", $result[3]);
        $horas = $horas[0].":".$horas[1];


                $this->assunto[$i] = $result[0];
				$this->mensagem[$i]= $result[1];
				$this->datas[$i]= $datas;
				$this->hora[$i]= $horas;


				$this->cont_mensagem = $i; // contador


			$i++;
			} // fim do primerio while
			$this->registros_men = $i;

		}else
		$this->cont_mensagem = -1;
	}



	public function ver_mensagem($cod_mensagem,$filtro)
	{

		
            if ($filtro == 1){
            $tabela = "mensagem";
            
            }
            else if ($filtro == 2){
            $tabela = "mensagem_enviadas";
            
            }
            else{
            $tabela = "mensagem_lixeira";
            
            }

		$query_update = mysql_query("UPDATE $tabela SET status = 1 WHERE cod_mensagem = '$cod_mensagem'") or die ("&mensagem=ERRO");


		$query_select = mysql_query("SELECT mensagem FROM $tabela WHERE cod_mensagem = '$cod_mensagem'");

		$quant = mysql_num_rows($query_select);

		// se retornou então preenche os dados
		if ($quant > 0)
		{


			    $result = mysql_fetch_array($query_select);

				
				echo"&mensagem=$result[0]";
				

				


				echo"&resultado=ok";

                                $this->resultado = "ok";
		}else
		$this->resultado = "erro";

	}


	public static function del_mensagem($cod_mensagem,$filtro)
	{

                        if ($filtro == 1){
            $tabela = "mensagem";

            }
            else if ($filtro == 2){
            $tabela = "mensagem_enviadas";

            }
            else{
            $tabela = "mensagem_lixeira";

            }
			$query_delete = mysql_query("DELETE FROM $tabela WHERE cod_mensagem = '$cod_mensagem'") or die ("&mensagem=ERRO");
                        $this->resultado = "ok";
	}

	public function consulta_mensagem_enviadas()
	{



		$cod_usuario = $_SESSION['id']; // pegando o código do usuário depois do mesmo logar no site

		$query_select = mysql_query("SELECT assunto, mensagem, DATE_FORMAT(data, '%d/%m/%Y') AS DATAS, nick, prioridade, cod_mensagem, status FROM mensagem_enviadas, usuario WHERE id.colaborador = id_des AND id_rem = '$cod_usuario' ORDER BY cod_mensagem DESC");

		$quant = mysql_num_rows($query_select);

		// se retornou então preenche os dados
		if ($quant > 0)
		{
			$i = 0;

			while ($result = mysql_fetch_array($query_select))
			{
				$this->assunto[$i] = "$result[0]";
				$this->mensagem[$i]= "$result[1]";
				$this->datas[$i]= "$result[2]";
				$this->nomes[$i]= "$result[3]";
				$this->prioridade[$i]= "$result[4]";
				$this->cod_mensagem[$i]= "$result[5]"; // esse código vai ser usado no link
				$this->status[$i] = "$result[6]"; // testa se foi lida ou n


				$this->cont_mensagem = $i; // contador


			$i++;
			} // fim do primerio while
			$this->registros_men = $i;

		}else
		$this->cont_mensagem = -1;
	}


	public function ver_mensagem_enviadas($cod_mensagem)
	{

		 // carregando arquivo de conexao com o banco de dados

		$cod_usuario = $_SESSION['id']; // pegando o código do usuário depois do mesmo logar no site


		$query_select = mysql_query("SELECT assunto, mensagem, DATE_FORMAT(data, '%d/%m/%Y') AS DATAS, nick, prioridade, cod_mensagem, status, id_des FROM mensagem_enviadas, colaborador WHERE id.colaborador = id_des AND id_rem = '$cod_usuario' AND cod_mensagem = '$cod_mensagem'");

		$quant = mysql_num_rows($query_select);

		// se retornou então preenche os dados
		if ($quant > 0)
		{


			    $result = mysql_fetch_array($query_select);

				$this->assunto_ver = "$result[0]";
				$this->mensagem_ver = "$result[1]";
				$this->datas_ver = "$result[2]";
				$this->nome = "$result[3]";
				$this->prioridade = "$result[4]";
				$this->codigo_ver = "$result[5]"; // esse código vai ser usado no link
				$this->status_ver = "$result[6]"; // testa se foi lida ou n
				$this->cod_rem = "$result[7]"; // testa se foi lida ou n

				$this->contagem = $i; // contador


				$this->registros = "Registros Encontrados: " . $i;

		}else
		$this->contagem = -1;
	}

	public static function del_mensagem_enviadas($cod_mensagem)
	{

			 // carregando arquivo de conexao com o banco de dados
			$query_delete = mysql_query("DELETE FROM mensagem_enviadas WHERE cod_mensagem = '$cod_mensagem'") or die ("&mensagem=ERRO");

	}

} // fim classes



?>

