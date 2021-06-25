<?php

class Conexao{
    public static function criar($type="sqlite"):PDO{
        switch ($type) {
            case 'mysql':
                $conexao = static::PDOMySQL();
                break;
            default:
                $conexao = static::PDOSQLite();
                break;
        }

        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexao;
    }

    public static function PDOSQLite():PDO {
        return new PDO("sqlite:db/livros.db");
    }

    public static function PDOMySQL():PDO {
        return new PDO("mysql:host=localhost;dbname=ensinateca", 'root', 'password');
    }
}