<?php

session_start();

$nome = $_SESSION['NomeUsuario'];
$instituicao = $_SESSION['instituicao'];
$area_login = $_SESSION['area_login'];

echo "&nome=$nome";
echo "&instituicao=$instituicao";
echo "&area_login=$area_login";

?>