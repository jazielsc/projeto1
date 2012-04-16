<?php

require_once("class_mensalidade.php");
require_once("conecta.php");


if (isset($_POST['acao'])) 
{
	$action = $_POST['acao'];
	
	switch ($action)
	{
		case "pago":
			try
			{
				$mens_id = $_POST['mens_id'];
				Mensalidade::baixa($mens_id);
			}
			catch (Exception $e)
			{
				$e->getMessage();
				$e->getTraceAsString();
			}
			break;
		case "alt":
			try
			{   
			    
				$contrato = $_POST['contrato'];
				$valor = $_POST['valor'];
				$parcela = $_POST['parcela'];
				Mensalidade::alterValor($contrato, $valor, $parcela);
								
			}
			catch (Exception $e)
			{
				$e->getMessage();
				$e->getTraceAsString();
			}
			break;
		case "add":
			
			$contrato = $_POST['contrato'];
			$parcelas = $_POST['parcelas'];

			

			//========>>  final_add NÃO é NULO
			if ($contrato != "")
			{
				echo "&mensagem=OK"; // respostas para o flash

				//Pegando planos com vencimento entre inicio_dia e final_dia
				$sql = mysql_query("SELECT numcontrato, pag_mensal, pag_dtbase, pag_primpg FROM pagamento WHERE numcontrato = '$contrato'");
				
				

				//========>>  Para cada um, execute o seguinte...
				while ($linha = mysql_fetch_array($sql))
				{
								
					$numcontrato = $linha['numcontrato'];
					
					
					$contador = 1;
					$cont = 1;
					
					$numcontrato = $linha['numcontrato']; // respostas da consultas: número de contrato, database e data do primeiro pagamento
					$dia = $linha["pag_dtbase"];
					$dataprimpg = $linha['pag_primpg'];
					
								
								if ($dataprimpg == '0000-00-00'){ // se n tem primeiro pagamento faça
								$sqldata = mysql_query("SELECT plano_dataass FROM plano WHERE plano_ncontrato = '$numcontrato'");
								$data_inicio = mysql_result($sqldata,0,"plano_dataass");
								
								
								
								$aux = explode("-",$data_inicio);
			                    $soma_dia = $aux[2];
								
								// se o intervalo for maio que 30 faça
								$soma = (30 - $soma_dia) + $dia; 
								if ($soma < 30){
								$cont = 2;
								$contagem = 1;
								} else{
								$contagem = 0;
								}
								
								} else{
								$data_inicio = $dataprimpg;
								}
								
								$aux = explode("-",$dataprimpg);
			                    $soma_dia = $aux[2];
								
								
								$soma = (30 - $soma_dia) + $dia; 
								if ($soma < 30){
								$cont = 2;
								}
																				
										
					//========>>  Gerar numboleto, datavenc, valor
					for ($i = 0; $i < $parcelas; $i++)
					{
						$sqlcont = mysql_query("SELECT COUNT(mens_id) AS cont FROM mensalidade WHERE numcontrato = '$numcontrato'");
						$res = mysql_result($sqlcont,0,"cont");
	                    
						//========>>  Se é a primeira parcela
						if ($res == 0)
						{
						    $parcela = $contador;
							
	
								
								//========>>  Possui data de primeiro pagamento
								if (($dataprimpg != "NULL")&&($dataprimpg != "0000-00-00"))
								{
										
																														
										//Definindo a data do vencimento
										$datavenc = $dataprimpg;
										
												
	
										//Definindo o valor
										$valor = $linha['pag_mensal'];
	
										//Enviando pro BD atraves do metodo pre-definido
										Mensalidade::add($numcontrato,$parcela,$datavenc,$valor,$dataprimpg,1);
	
										$contador++;
								}
								
																
								else //========>>  Não possui data de primeiro pagamento
								{       
								        $sqldata = mysql_query("SELECT plano_dataass FROM plano WHERE plano_ncontrato = '$numcontrato'");
								        $data_inicio = mysql_result($sqldata,0,"plano_dataass");
										
										
										$sqlano = mysql_query("SELECT YEAR(DATE('$data_inicio') + INTERVAL '$contagem' MONTH) AS ano");
										$ano = mysql_result($sqlano,0,"ano");
										$ano = $ano[2] . $ano[3];

										$sqlmes = mysql_query("SELECT MONTH(DATE('$data_inicio') + INTERVAL '$contagem' MONTH) AS mes");
										$mes = mysql_result($sqlmes,0,"mes"); 
										
										$dia = $linha["pag_dtbase"];
	
										
										//Definindo a data do vencimento
								        $datavenc = $ano . "-" . $mes . "-" . $dia;
	
										//Definindo o valor
										$valor = $linha['pag_mensal'];
										
										$dataprimpg = '0000-00-00';
	
										//Enviando pro BD atraves do metodo pre-definido
										Mensalidade::add($numcontrato,$parcela,$datavenc,$valor,$dataprimpg,1);
	
										$contador++;
								}
							
							
						}
						else //========>>  Não é a primeira parcela
						{		
						
								$sqlano = mysql_query("SELECT YEAR(DATE('$data_inicio') + INTERVAL '$cont' MONTH) AS ano");
								$ano = mysql_result($sqlano,0,"ano");
								$ano = $ano[2] . $ano[3];

								$sqlmes = mysql_query("SELECT MONTH(DATE('$data_inicio') + INTERVAL '$cont' MONTH) AS mes");
								$mes = mysql_result($sqlmes,0,"mes");
								
								if (strlen($mes) == 1)
								$mes = "0" . $mes;
	
															
								$parcela = $contador;
	
								//Definindo a data do vencimento
								$datavenc = $ano . "-" . $mes . "-" . $dia;
	
								//Definindo o valor
								$valor = $linha['pag_mensal'];
	
								//Enviando pro BD atraves do metodo pre-definido
								Mensalidade::add($numcontrato,$parcela,$datavenc,$valor,0);
	                            
								$contador++;
								$cont++;
						}
	
					}
				}	
			}
			
			else { //========>>  final_add é NULO

			echo "&mensagem=NAO";
			     }
			break;
	}
}else{

echo "&mensagem=NULO";

}



?>