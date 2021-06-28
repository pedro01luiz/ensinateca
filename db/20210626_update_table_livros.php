<?php

$bd = new SQLite3("db/livros.db");

$sql = "ALTER TABLE livros ADD COLUMN video VARCHAR(200)";

if ($bd->exec($sql))
    echo "\ntabela livros alterada com sucesso\n";
else
    echo "\nerro ao alterar tabela livros\n";