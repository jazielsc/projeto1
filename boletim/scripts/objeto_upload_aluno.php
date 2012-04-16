<?php



 require("../class/class_upload.php");
 include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");




 $dir = "../alunos/";

		 		
				$file = $_FILES["Filedata"];
				$nome_arquivo = $file['name'];
				$tamanho_arquivo = $file['size'];
				$arquivo_temporario = $file['tmp_name'];
			
//---------------------------    upload---------------------------------------------------------------------------


			$upload = new upload;

			if( ($nome_arquivo != "") or ($nome_arquivo != NULL) )
			{

				$query_arquivo = mysql_query("SELECT COUNT(cod_aluno) AS cont FROM aluno") or die ("Erro em consultar!");

				if (mysql_num_rows($query_arquivo)>0)
					 $indi_arquivo = mysql_result($query_arquivo,0,"cont");

				$upload->RemoveAcentos($nome_arquivo);
				$nome_arquivo = $upload->arq;
				$nome_arquivo = $indi_arquivo.$nome_arquivo;

                                

			}
			
		
                        
			$upload->upload_simples($nome_arquivo,$tamanho_arquivo,$arquivo_temporario,"nao","sim","nao",$dir,"614400");

			


?>