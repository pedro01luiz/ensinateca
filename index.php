<?php

require "./NotifyException.php";

/**
 * Se der algum erro ou se algo não funcionar direito,
 * descomente essas três linhas abaixo, 
 * elas fazem com que mostrem todos os erros e avisos silenciosos na página.
 * - Mago
 */

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

/**
 * Coloquei todo o código dentro de um try/catch
 * Porque se der erro no template ou no processamento das páginas dentro
 * do contexto atual, vai mostrar na página qual erro é, em vez de ficar vazia.
 * - Mago
 */

try {
    //code...
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

} catch (\Throwable $th) {
    $processUser = posix_getpwuid(posix_geteuid());
    echo NotifyException::render($th);
}