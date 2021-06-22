<?php

$bd = new SQLite3("./db/livros.db");

$sql = "ALTER TABLE livros ADD COLUMN favorito INT DEFAULT 0";

if ($bd->exec($sql))
    echo "\ntabela livros alterada com sucesso\n";
else
    echo "\nerro ao alterar tabela livros\n";
