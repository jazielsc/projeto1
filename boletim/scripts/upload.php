<?php
	//diret�rio destino das imagens dentro da pasta da aplica��o...
	//deve ter permiss�o para escrita chmod(777)...
	$dir = "../fotos/";
	//recebendo o arquivo multipart vindo do flash...
	$file = $_FILES["Filedata"];
	//finalizando o upload e criando apartir do arquivo temp, multipart, um novo arquivo
	// em nossa pasta de destino. O echo serve para dizer ao flash se deu certo ou n�o...
	echo move_uploaded_file($file["tmp_name"], $dir . "/" . $file["name"]);
?>