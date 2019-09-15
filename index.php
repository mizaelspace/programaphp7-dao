<?php

require_once("config.php");

//Carrega um usuário
/*
$root = new Usuario();
$root->loadById(13); //Chamando o select pelo id
echo $root;
*/

//Carrega uma lista de usuários
/*
$lista = Usuario::getList();
echo json_encode($lista);
*/

//Carrega uma lista de usuários buscando pelo login
/*
$search = usuario::search("Maria");
echo json_encode($search);
*/

//Carrega um usuário usando o login e a senha
/*
$usuario = new Usuario();
$usuario->login("joao","qwerty");
echo $usuario;
*/

//Criando um novo usuário
/*
$aluno = new Usuario("aluno","@lun0");
$aluno->insert();
echo $aluno;
*/

$usuario = new Usuario;

$usuario->loadById(15);

$usuario->update("professor","!@#$%");

echo $usuario;

?>