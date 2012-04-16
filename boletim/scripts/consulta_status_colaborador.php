<?php

// evita que arquivo fique no cache 
	
    header("Content-type: text/html; charset=iso-8859-1");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");


        $codigo = $_POST['codigo'];

// arquivo de consulta do combo bairro no flash referente ao cadastro de contratos

include("conecta.php"); // arquivo de conexao

	
$query_autor = mysql_query("SELECT status4.cod_status, status4.nome FROM status4, colaborador WHERE colaborador.cod_status =status4.cod_status AND colaborador.cod_colaborador = '$codigo' ORDER BY status4.cod_status",$conn);

        // verificando se a query retornou algum valor
        $quant = mysql_num_rows($query_autor);

        // se retornou ent�o preenche os dados no flash

        if ($quant > 0)
            {

                
                $result_autor = mysql_fetch_array($query_autor);
                

                    echo "&cod=$result_autor[0]";
                    echo "&nome=$result_autor[1]";

                    
                

           echo "&resultado=OK";
        } else
          echo "&resultado=nao";


mysql_close();
	
	

?>