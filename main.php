<?php

require_once 'functions.php';
require_once 'validations.php';
require_once 'menu.php';
require_once 'file_save.php';


$usuarios = lerJson();
abrirMenu($usuarios);
salvarJson($usuarios);
