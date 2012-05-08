<?php

	class Class_mensagem{
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

		public function __construct(){
			session_start();
			include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
			if  (isset($_SESSION['id_usuario'])){
				$id = $_SESSION['id_usuario'];
				$query_mensagem = mysql_query("SELECT COUNT(cod_mensagem) AS cont FROM mensagem WHERE  status = 2 AND id_des = '$id'") or die ("Erro em consultar            mensagem");
				if (mysql_num_rows($query_mensagem)>0){
					$n_lidas = mysql_result($query_mensagem,0,"cont");
					echo "&n_lidas=$n_lidas";
				}
				else{
					$n_lidas = 0;
					echo "&n_lidas=$n_lidas";
				}
			}
		}
		
		public function cad_mensagem($assunto,$mensagens,$tipo,$prioridade,$referencia,$cod_usuario){
			$status = 2;
			$id = $_SESSION['id_usuario'];
			$nick = $_SESSION['NomeUsuario'];
			$data = date("Y-m-d");
			$hora = date("H:i:s");
			if ($tipo == 2){
				$select_grupo = mysql_query("SELECT cod_usuario FROM usuario WHERE referencia = '$referencia'") or die ("deu erro...");
				$i=0;
				while ($cod_des = mysql_fetch_array($select_grupo)){
					$query_insert = mysql_query("INSERT INTO mensagem VALUE(NULL, '$assunto', '$mensagens', '$data', '$id', '$cod_des[0]', '$prioridade', '$status', '$hora')")or die ("eroo1".mysql_error());
					$query_insert_2 = mysql_query("INSERT INTO mensagem_enviadas VALUE(NULL, '$assunto', '$mensagens', '$data', '$id', '$cod_des[0]', '$prioridade', '$status', '$hora')")or die ("eroo2".mysql_error());
					$i++;
				}
				$this->resultado = "ok";
			}
			else{
				$query_select = mysql_query("SELECT cod_usuario, usuario_login, nome FROM usuario WHERE cod_aluno_professor = '$cod_usuario' AND referencia = '$referencia'");
				$quant = mysql_num_rows($query_select);
				if ($quant > 0){
					$result = mysql_fetch_array($query_select);
					$cod_des = $result[0];
					$status = 2;
					$id = $_SESSION['id_usuario'];
					$data = date("Y-m-d");
					$hora = date("H:i:s");
					$query_insert = mysql_query("INSERT INTO mensagem VALUE(NULL, '$assunto', '$mensagens', '$data', '$id', '$cod_des', '$prioridade', '$status','$hora')") or die ("eroo1".mysql_error());
					$query_insert_2 = mysql_query("INSERT INTO mensagem_enviadas VALUE(NULL, '$assunto', '$mensagens', '$data', '$id', '$cod_des', '$prioridade', '$status', '$hora')") or die ("eroo2".mysql_error());
					$this->resultado = "ok";
				}
				else {
					$this->resultado = "erro";
				}
			}
		}
		
		public static function del_mensagem($cod_mensagem,$filtro){
			if ($filtro == 1){
				$tabela = "mensagem";
			}
			elseif ($filtro == 2){
				$tabela = "mensagem_enviadas";
			}
			else{
				$tabela = "mensagem_lixeira";
			}
			$query_delete = mysql_query("DELETE FROM $tabela WHERE cod_mensagem = '$cod_mensagem'") or die ("&mensagem=ERRO");
			$this->resultado = "ok";
		}
	
	}



?>

