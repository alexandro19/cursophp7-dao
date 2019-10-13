<?php 

require_once("config.php");

//Tras somente 1 usuário
//$usuario = new usuario();
//$usuario->loadById(1);
//


//Carrega uma lista
//$usuario = Usuario::getList();
//echo json_encode($usuario);


//Carrega uma lista filtrando o login
//$lista = Usuario::search("ale");
//echo json_encode($lista);


//Validando usuario e senha logados
//$usuario = new Usuario();
//$usuario->login("ale", "123");
//echo $usuario;
 
$aluno = new Usuario("Alexandro","123456" );
$aluno->insert();

echo $aluno;
 ?>