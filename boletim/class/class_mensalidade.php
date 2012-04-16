<?php	
	/**
	 * Classe que detalha o objeto do tipo "Mensalidade" que neste caso especifico uma mensalidade (parcela) de 
	 * honorario de serviço a ser paga com um boleto bancario.
	 *
	 * @author Eduardo Levenfeld, <eduardo_levenfeld@yahoo.com.br>
	 * @name Class Mensalidade
	 * @version 0.1
	 */
	class Mensalidade 
	{
		//Declarando os atributos...
		
		public $mens_id;
		public $numcontrato;
		public $parcela;
		public $mens_datavenc;
		public $mens_valor;
		public $mens_pago;
		
		
		//Declarando metodo construtor...
		
		public function __construct($mens_id) 
		{
			$sql = mysql_query("SELECT * FROM mensalidade WHERE mens_id = '$mens_id'");
			
			if ($sql)
			{
			    
				$this->mens_id = $mens_id;
				$this->numcontrato = mysql_result($sql,0,"numcontrato");
				$this->parcela = mysql_result($sql,0,"parcela");
				$this->mens_datavenc = mysql_result($sql,0,"mens_datavenc");
				$this->mens_valor = mysql_result($sql,0,"mens_valor");
				$this->mens_pago = mysql_result($sql,0,"mens_pago");
			}
			else 
			{
				throw new Exception("Erro na execução da consulta SQL que constroi o objeto Mensalidade($mens_id)");
			}
		}
		
		
		//Declarando os metodos...
		
		public static function add($numcontrato,$parcela,$venc,$valor,$dataprimpg,$prim = 0)
		{
			switch ($prim) 
			{
				case 0:
					$sqlparc = mysql_query("SELECT COUNT(mens_id) AS parcelas_registradas FROM mensalidade WHERE numcontrato = '$numcontrato'");
					$parcelas_registradas = mysql_result($sqlparc,0,"parcelas_registradas");
					
					$sqlparc = mysql_query("SELECT pag_nparcelas FROM pagamento WHERE numcontrato = '$numcontrato'");
					$parcelas_limite = mysql_result($sqlparc,0,"pag_nparcelas");
					
					if ($parcelas_registradas < $parcelas_limite)
					{ 
					
					    
						$sql = mysql_query("INSERT INTO mensalidade VALUES(NULL,'$numcontrato','$parcela','$venc','$valor','0000-00-00')");
						 
						if (!($sql))
							throw new Exception("Erro na SQL consulta que insere a Mensalidade");
					}		
				break;
				case 1: // se é a primeira parcela
					$sqlparc = mysql_query("SELECT COUNT(mens_id) AS parcelas_registradas FROM mensalidade WHERE numcontrato = '$numcontrato'");
					$parcelas_registradas = mysql_result($sqlparc,0,"parcelas_registradas");
					
					$sqlparc = mysql_query("SELECT pag_nparcelas FROM pagamento WHERE numcontrato = '$numcontrato'");
					$parcelas_limite = mysql_result($sqlparc,0,"pag_nparcelas");
					
					if ($parcelas_registradas < $parcelas_limite)
					{
					
					    
						$sql = mysql_query("INSERT INTO mensalidade VALUES(NULL,'$numcontrato','$parcela','$venc','$valor','$dataprimpg')");
						
						if (!($sql))
							throw new Exception("Erro na SQL consulta que insere a Mensalidade");
					}		
				break;	
			}
		}
		
		public static function baixa($mens_id) 
		{
			$sqldata = mysql_query("SELECT DATE(NOW()) AS hoje");
			$data_hoje = mysql_result($sqldata,0,"hoje");
			
			$sql = mysql_query("UPDATE mensalidade SET mens_pago = '$data_hoje' WHERE mens_id = '$mens_id' ");
			if (!($sql))
				throw new Exception("Erro na SQL consulta que realiza baixa na Mensalidade - baixa(...)");
				echo "&mensagem=OK"; // respostas para o flash
		}
		
		public static function emitir($numboleto) 
		{
			$sqldata = mysql_query("SELECT DATE(NOW()) AS hoje");
			$data_hoje = mysql_result($sqldata,0,"hoje");
			
			$sql = mysql_query("UPDATE mensalidade SET mens_emitido = '$data_hoje' WHERE mens_numboleto = '$numboleto' OR 
			mens_primnumero = '$numboleto'");
			if (!($sql))
				throw new Exception("Erro na SQL consulta que realiza emissão na Mensalidade - emitir(...)");
				
		}
		
		public static function alterVenc($contrato, $parcela) 
		{
			$sql = mysql_query("UPDATE mensalidade SET parcela = '$parcela' WHERE numcontrato = '$contrato' AND 
			parcela >= '$parcela'");
			if (!($sql))
				throw new Exception("Erro na SQL consulta que realiza emissão na Mensalidade - emitir(...)");
		}
		
		public static function alterValor($contrato, $valor, $parcela ) 
		{
			$sql = mysql_query("UPDATE mensalidade SET mens_valor = '$valor' WHERE numcontrato = '$contrato' AND 
			parcela >= '$parcela'");
			if (!($sql))
				throw new Exception("Erro na SQL consulta que realiza emissão na Mensalidade - emitir(...)");
				echo "&mensagem=OK"; // respostas para o flash
		}
		
		public static function deleta($numboleto) 
		{
			$sql = mysql_query("DELETE FROM mensalidade WHERE mens_numboleto = '$numboleto' OR 
			mens_primnumero = '$numboleto'");
			if (!($sql))
				throw new Exception("Erro na SQL consulta que deleta a Mensalidade - deleta(...)");
		}
	}
?>