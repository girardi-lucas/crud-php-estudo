<?php
require_once 'functions.php';



$usuarios = lerJson();
abrirMenu($usuarios);
salvarJson($usuarios);
