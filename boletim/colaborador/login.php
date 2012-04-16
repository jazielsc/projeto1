<?php
session_start();


$_SESSION['id_instituicao'] = 0;

?>

<script language="javascript" type="text/javascript">

function GetXMLHttp() 
{    
	var xmlHttp;    

	try 
	{       
 		xmlHttp = new XMLHttpRequest();   

  	}    
  		catch(ee) 
		{       
   			try 
			{            
				xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");      
     		}       
	  			catch(e) 
				{            
	  				try 
					{                
	  					xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");           
	   				}          
	     				catch(e) 
						{              
		   					xmlHttp = false;           
		    			}        
				}  
	  }    
			  return xmlHttp;
}

var xmlRequest = GetXMLHttp();


function abrirPag()
{   
	   
	xmlRequest.open("GET",'esqueceu_senha.html',true);   
	
	xmlRequest.send(null);     
	
	xmlRequest.onreadystatechange = function()
	 {   
		if (xmlRequest.readyState == 4) 
		{            
			
			document.getElementById('esqueceu_senha').style.visibility='visible'
			document.getElementById("esqueceu_senha").innerHTML = xmlRequest.responseText;      
			
		}		
			
	}
}

function fecharPag()
{   
	   
	xmlRequest.open("GET",'esqueceu_senha.html',true);   
	
	xmlRequest.send(null);     
	
	xmlRequest.onreadystatechange = function()
	 {   
		if (xmlRequest.readyState == 4) 
		{            
			
			      
			//document.getElementById("esqueceu_senha").style.display = 'none';  
			document.getElementById('esqueceu_senha').style.visibility='hidden'
		}		
			
	}
}

</script>

<html>


	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<title>&gt;&gt;&gt; &gt;&gt;&gt; boletim  2010 - Login ADM &lt;&lt;&lt; &lt;&lt;&lt;</title>
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	left:419px;
	top:377px;
	width:419px;
	height:35px;
	z-index:1;
	background-color: #FFFFFF;
}
.style2 {font-size: 14px}
.style3 {
	font-size: 14px;
	color: #000000;
	font-weight: bold;
}
#esqueceu_senha {
	position:absolute;
	left:237px;
	top:47px;
	width:369px;
	height:160px;
	z-index:0;
}
-->
</style>
<body bgcolor="#EAEAEA">

<div id="esqueceu_senha"></div>
<form name="form1" method="post" action="sistema.php">
<table align="center" bgcolor="#ADD0E9"  valign="middle" border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
  <tr>
      <td width="100%" height="100%" align="center" valign="middle" bgcolor="#E0E0E0"> 
        <table width="418" height="156" border="0" bordercolor="#ADD0E9" background="imagens/login.jpg" bgcolor="#ADD0E9">
          <tr>
          <td width="168">&nbsp;</td>
          <td width="240">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td> <table width="99%" border="0">
              <tr>
                <td width="26%"><strong><font color="#000000">Login</font><font color="#FFFFFF"><font color="#000000">:</font></font></strong></td>
                <td width="74%">
                  <strong>
                  <input type="text" name="usuario" tabindex="1" maxlength="15"/>
                  </strong></td>
              </tr>
              <tr>
                <td><strong><font color="#000000">Senha:</font></strong></td>
                <td><strong>
                  <input type="password" name="senha" tabindex="2" maxlength="14"/>
                </strong></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><strong>
                  <input type="submit" name="Submit" value="Entrar" tabindex="3"/>
                  </strong><span class="style2"><a href="#">e</a></span><a href="#" onClick="abrirPag();"><span class="style2">squeceu a senha</span></a> </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
            <td> <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000" size="2"><strong> 
              <?php 
			  	if (isset($mensagem))
				echo	$mensagem;
			?>
            </strong></font> </div></td>
        </tr>
      </table> 
        <table width="418" border="0">
          <tr>
            <td width="56">&nbsp;</td>
            <td width="352"><span class="style3">Caso n&atilde;o esteja cadastrado contate o administrador </span></td>
          </tr>
        </table></td>
  </tr>

</table></form>
</body>
</html>