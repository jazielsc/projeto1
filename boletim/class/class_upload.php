<?php

	class upload{

		public $nome_arquivo;
		public $tamanho_arquivo;
		public $arquivo_temporario;
		public $sobrescrever;
		public $limitar_tamanho;
		public $limitar_ext;
		public $caminho_absoluto;	  			   
		public $tamanho_bytes;
		public $tamanho_fixo;    // S ou N
		public $largura_fixa;    // usado somente com tamanho_fixo=S
		public $altura_fixa;     // usado somente com tamanho_fixo=S
		public $percentual;       // usado somente com tamanho_fixo=N
		public $link_pagina;
		public $link_confirm;
		public $arq = "";

		public function upload_simples($nome_arquivo,$tamanho_arquivo,$arquivo_temporario,$sobrescrever,$limitar_tamanho,$limitar_ext,$caminho_absoluto,$tamanho_bytes){
			// elimina o limite de tempo de execu��o
			set_time_limit (0);
			$extensoes_validas = array(".gif",".jpg",".jpeg",".png",".JPG",".JPEG",".PNG",".GIF");
			$validar = array("IMAGETYPE_GIF","IMAGETYPE_JPEG","IMAGETYPE_PNG");
			if ( ($nome_arquivo != "") or ($nome_arquivo != NULL) ){
				if ($sobrescrever == "nao" && file_exists("$caminho_absoluto/$nome_arquivo")){
					echo '<script> alert("Arquivo já existe.");</script>';
				}			
				if (($limitar_tamanho == "sim") && ($tamanho_arquivo > $tamanho_bytes)){
					echo '<script> alert("Arquivo deve ter no máximo $tamanho_bytes bytes.");</script>';
				}
				$ext = strrchr($nome_arquivo,'.');
				if(move_uploaded_file($arquivo_temporario, $caminho_absoluto . "/" . $nome_arquivo)){
					echo '<script> alert("OK");</script>';
					$this->confirma = 1;
				}
				else{
					echo '<script> alert("ERRO.");</script>';
				}
			}
			else{
				echo '<script> alert("ERRO.");</script>';
				$this->confirma = 1;
			}
		}

public function miniatura($imagem,$tamanho_fixo,$largura_fixa,$altura_fixa,$percentual) // m�todo referente a gera��o de miniaturas
{



if(!file_exists($imagem))
{
echo "Arquivo da imagem n�o encontrado!";
exit;
}
if($tamanho_fixo=="N" && ($percentual<1 || $percentual>100))
{
echo "O percentual deve ser um n�mero entre 1 e 100!";
exit;
}

$tipo = pathinfo($imagem);

// monta o nome do arquivo resultante
$arquivo_miniatura = explode('.'.$tipo["extension"], $imagem);
$arquivo_miniatura = $arquivo_miniatura[0].".".$tipo["extension"];

// l� a imagem de origem e obt�m suas dimens�es
$types = array("jpg" => array("imagecreatefromjpeg", "�magemjpeg"),
"gif" => array("imagecreatefromgif", "�magemgif"),
"JPG" => array("imagecreatefromjpeg", "�magemjpeg"),
"JPEG" => array("imagecreatefromjpeg", "�magemjpeg"),
"jpeg" => array("imagecreatefromjpeg", "�magemjpeg"),
"png" => array("imagecreatefrompng", "�magempng"),
"PNG" => array("imagecreatefromjpeg", "�magempng"),
"GIF" => array("imagecreatefrompng", "�magemgif")
);

$func = $types[$tipo["extension"]][0];
$img_origem = $func($imagem);


$origem_x = ImagesX($img_origem);
$origem_y = ImagesY($img_origem);

// se n�o for tamanho fixo, calcula as dimens�es da miniatura
if($tamanho_fixo=="S")
{
$x = $largura_fixa;
$fator = ($origem_x / $largura_fixa); 
$y =  $altura_fixa;//($origem_y / $fator);
}
else
{
$x = intval ($origem_x * $percentual/100);
$y = intval ($origem_y * $percentual/100);
}

if (($origem_x <= $x) and ($origem_y <= $y)){
$img_final = ImageCreateTrueColor($origem_x,$origem_y);
}else{
//cria a imagem final, que ir� conter a miniatura
$img_final = ImageCreateTrueColor($x,$y);
}


// copia a imagem original redimensionada para dentro da imagem final
ImageCopyResampled($img_final, $img_origem, 0, 0, 0, 0, $x+1, $y+1, $origem_x , $origem_y);

// salva o arquivo
Imagejpeg($img_final, $arquivo_miniatura);

// libera a mem�ria alocada para as duas imagens
ImageDestroy($img_origem);
ImageDestroy($img_final);

} // fim do m�todo


public function miniatura_vitrine($imagem,$tamanho_fixo,$largura_fixa_vitrine,$altura_fixa_vitrine,$percentual) // m�todo referente a gera��o de miniaturas
{


if(!file_exists($imagem))
{
echo "Arquivo da imagem n�o encontrado!";
exit;
}
if($tamanho_fixo=="N" && ($percentual<1 || $percentual>100))
{
echo "O percentual deve ser um n�mero entre 1 e 100!";
exit;
}

$tipo = pathinfo($imagem);

// monta o nome do arquivo resultante
$arquivo_miniatura = explode('.'.$tipo["extension"], $imagem);
$arquivo_miniatura = $arquivo_miniatura[0]."_mini_vitrine.".$tipo["extension"];

// l� a imagem de origem e obt�m suas dimens�es
$types = array("jpg" => array("imagecreatefromjpeg", "�magemjpeg"),
"gif" => array("imagecreatefromgif", "�magemgif"),
"JPG" => array("imagecreatefromjpeg", "�magemjpeg"),
"JPEG" => array("imagecreatefromjpeg", "�magemjpeg"),
"jpeg" => array("imagecreatefromjpeg", "�magemjpeg"),
"png" => array("imagecreatefrompng", "�magempng"),
"PNG" => array("imagecreatefromjpeg", "�magempng"),
"GIF" => array("imagecreatefrompng", "�magemgif")
);

$func = $types[$tipo["extension"]][0];
$img_origem = $func($imagem);


$origem_x = ImagesX($img_origem);
$origem_y = ImagesY($img_origem);

// se n�o for tamanho fixo, calcula as dimens�es da miniatura
if($tamanho_fixo=="S")
{
$x = $largura_fixa_vitrine;
$fator = ($origem_x / $largura_fixa_vitrine); 
$y =  ($origem_y / $fator);
}
else
{
$x = intval ($origem_x * $percentual/100);
$y = intval ($origem_y * $percentual/100);
}

//if (($origem_x <= $x) and ($origem_y <= $y)){
//$img_final = ImageCreateTrueColor($origem_x,$origem_y);
//}else{
// cria a imagem final, que ir� conter a miniatura
$img_final = ImageCreateTrueColor($x,$y);
//}


// copia a imagem original redimensionada para dentro da imagem final
ImageCopyResampled($img_final, $img_origem, 0, 0, 0, 0, $x+1, $y+1, $origem_x , $origem_y);

// salva o arquivo
Imagejpeg($img_final, $arquivo_miniatura);

// libera a mem�ria alocada para as duas imagens
ImageDestroy($img_origem);
ImageDestroy($img_final);

} // fim do m�todo



public function RemoveAcentos($str, $enc = 'UTF-8')
{
$acentos = array(
'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
'C' => '/&Ccedil;/',
'c' => '/&ccedil;/',
'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
'N' => '/&Ntilde;/',
'n' => '/&ntilde;/',
'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
'Y' => '/&Yacute;/',
'y' => '/&yacute;|&yuml;/',
'a.' => '/&ordf;/',
'o.' => '/&ordm;/'
);

$this->arq = preg_replace($acentos, array_keys($acentos), htmlentities($str,ENT_NOQUOTES, $enc));
}






} // fim da classe


?>