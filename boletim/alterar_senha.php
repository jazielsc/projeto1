 
  <?php
    
	include($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/conecta.php");

    //2-Pega nr. IP de quem mandou o email
    $ip_confirmacao = $_SERVER['REMOTE_ADDR'] ;
    
    //3-Pega O hash
    $hash = $_REQUEST['hash'];
	
	
	$data_confirmacao = date("Y-m-d");
        
    
    //7-Inclui os dados no banco
    $query_update = mysql_query("UPDATE esqueceu_senha SET ip_confirmacao = '$ip_confirmacao', data_confirmacao = '$data_confirmacao' WHERE hash = '$hash'") or die("erro no update!");
	
	
	$query_select = mysql_query("SELECT cod_usuario, nick FROM esqueceu_senha WHERE hash = '$hash'") or die ("Erro no select!");
	
	$result = mysql_fetch_array($query_select);
	
	$senha =  md5($result[1]."13277");
		
	$query_user = mysql_query("UPDATE usuario SET usuario_pass = '$senha' WHERE cod_usuario = '$result[0]'") or die ("Erro usu�rio");
        
       
	  echo "<script language='javascript'>alert('Senha alterada com sucesso!');</script>";
	  Header("Location: /index.htm");
	   
	   
        
    ?>
  
  
  