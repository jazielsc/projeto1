<?php


	if (isset($_POST['acao'])) 
{
	
	require($_SERVER['DOCUMENT_ROOT']."/boletim/scripts/seguranca.php");
	require($_SERVER['DOCUMENT_ROOT']."/boletim/class/class_mensagem.php");
        $mensagem = new Class_mensagem;
        $action = $_POST['acao'];
	
	switch ($action)
	{ 
		
		case "cad_mensagem":
		
			if(isset($_POST['tipo'])){
			$tipo = (int) $_POST['tipo'];
			}
			
			if(isset($_POST['assunto'])){
			$assunto = seguranca($_POST['assunto']);
			}			
			if(isset($_POST['mensagens'])){
			$mensagens = seguranca($_POST['mensagens']);
			}

                        if(isset($_POST['referencia'])){
			$referencia = seguranca($_POST['referencia']);
			}

                        if(isset($_POST['cod_usuario'])){
			$cod_usuario = seguranca($_POST['cod_usuario']);
			}

                        $prioridade = 1;
													
             
                        $mensagem->cad_mensagem($assunto,$mensagens,$tipo,$prioridade,$referencia,$cod_usuario);

                        echo"&resultado=$mensagem->resultado";
				
		break;

                case "consulta_grid_mensagem":

                    if(isset($_POST['filtro'])){
                    $filtro = seguranca($_POST['filtro']);
		    }

                    $mensagem->consulta_grid_mensagem($filtro);

                    echo"&resultado=$mensagem->resultado";

                    break;


                   case "ver_mensagem":

                    if(isset($_POST['filtro'])){
                    $filtro = seguranca($_POST['filtro']);
		    }

                    if(isset($_POST['codigo'])){

                        $codigo = (int) $_POST['codigo'];
                    }

                    $mensagem->ver_mensagem($codigo,$filtro);

                    echo"&resultado=$mensagem->resultado";

                    break;
		
		
		case "del_mensagem":
		
		
		
					
		if(isset($_POST['filtro'])){
                    $filtro = seguranca($_POST['filtro']);
		    }

                    if(isset($_POST['codigo'])){

                        $codigo = (int) $_POST['codigo'];
                    }
						
							
		$mensagem->del_mensagem($codigo,$filtro);

					
			
		
		
		break;
		
		
		case "del_mensagem_enviadas":
		
		
		$contar = $_SESSION['cont_mensagem'];
				$i = 0;
				while ($i <= $contar)
				{
					if(isset($_POST["cod_mensagem".$i]))
					{
						$cod_mensagem = (int) $_POST["cod_mensagem".$i];  
						
							
						mensagem::del_mensagem_enviadas($cod_mensagem);	
					
					}		
					$i++;		
    			}
				
				
				
				Header("Location: minha_conta_msgm_env.php");	
		
		break;
		
		
		
	}
	
	

}
else
echo "Erro ao Enviar Mensagem!"

?>







