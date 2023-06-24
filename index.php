<?php
//création de la variable _ROOTPATH_
define('_ROOTPATH_', __DIR__);

//se charge de faire les include
spl_autoload_register();

//dépendance, on utilise le Controller qui se trouve dans le namespace App\Controller
use App\Controller\Controller;

//on crée un nouvelle instance de Controller
$controller = new Controller();

//on appelle la fonction route()
$controller->route();
