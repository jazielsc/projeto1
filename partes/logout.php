<?php 
/**PAGINA LOGOUT**/
session_start();

session_destroy();
header('location: ../index.php');

?>