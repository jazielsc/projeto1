<?php

session_start();

$nivel = $_SESSION["permissao"];

echo "&nivel=$nivel";

?>