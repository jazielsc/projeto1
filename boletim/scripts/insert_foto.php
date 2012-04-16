<?php

$nome_arquivo = $_POST['arquivo'];
$codigo_instituicao = $_POST['cod_instituicao'];
 
 include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");
  require("../class/class_upload.php");

 $upload = new upload;
			
				$query_arquivo = mysql_query("SELECT COUNT(cod_instituicao) AS cont FROM instituicao") or die ("Erro em consultar!");

				if (mysql_num_rows($query_arquivo)>0)
					 $indi_arquivo = mysql_result($query_arquivo,0,"cont");

				$upload->RemoveAcentos($nome_arquivo);
				$nome_arquivo = $upload->arq;
				$nome_arquivo = $indi_arquivo.$nome_arquivo;

                                $query_update = mysql_query("UPDATE instituicao set foto = '$nome_arquivo' where cod_instituicao = '$codigo_instituicao'") or die ("Erro em consultar!");

			
			


?>