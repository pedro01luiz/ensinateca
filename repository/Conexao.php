<?php

class Conexao{
    public static function criar():PDO{
        $env = parse_ini_file('.env');
        $databaseType = $env["databaseType"];
        $database = $env["database"];
        $server = $env["server"];
        $pass = $env["pass"];
        $user = $env["user"];

        if($databaseType === "mysql"){
            $database = "host=$server;dbname=$database";
        }

        return new PDO("$databaseType:$database", $user, $pass);
    }
}