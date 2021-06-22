<?php

$rota = $_SERVER["REQUEST_URI"];
$metodo = $_SERVER["REQUEST_METHOD"];

require "./controller/LivrosController.php";

if ($rota === "/"){
    require "view/biblioteca.php";
    exit();
}

if ($rota === "/novo"){
    if($metodo == "GET") require "view/cadastrar.php";
    if($metodo == "POST") {
            $controller = new LivrosController();
            $controller->save($_REQUEST);
    };
    exit();
}

if (substr($rota, 0, strlen("/favoritar")) === "/favoritar"){
    $controller = new LivrosController();
    $controller->favorite(basename($rota));
    exit();
}

if (substr($rota, 0, strlen("/livros")) === "/livros"){
    if($metodo == "GET") require "view/biblioteca.php";
    if($metodo == "DELETE"){
        $controller = new LivrosController();
        $controller->delete(basename($rota));
    }
    exit();
}

require "view/404.php";