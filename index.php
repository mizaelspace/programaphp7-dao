<?php

require_once("config.php");

$root = new Usuario();

$root->loadById(13);

echo $root;

?>