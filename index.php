<?php 

require_once("config.php");

$usuario = new usuario();

$usuario->loadById(1);

echo $usuario;

 ?>