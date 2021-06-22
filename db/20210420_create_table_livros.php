<?php

$bd = new SQLite3("livros.db");

$sql = "DROP TABLE IF EXISTS livros";

if ($bd->exec($sql))
    echo "\ntabela livros apagada\n";

$sql = "CREATE TABLE livros (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        titulo VARCHAR(200) NOT NULL,
        capa VARCHAR(200),
        descricao TEXT,
        nota DECIMAL(2,1)
    )
";

if ($bd->exec($sql))
    echo "\ntabela livros criada\n";
else
    echo "\nerro ao criar tabela livros\n";

$sql = "INSERT INTO livros(id, titulo, capa, descricao, nota) VALUES (
        0,
        'Livro Aluno 1',
        'https://cache.skoob.com.br/local/images//9eXjySqSYflFB9nzTUMXKTrQJ98=/300x0/center/top/filters:format(jpeg)/https://skoob.s3.amazonaws.com/livros/11868666/AS_GUERREIRAS_DA_MARE_161771764511868666SK-V11617717646B.jpg',
        'Fionn Boyle tinha se tornado Guardião da Tempestade da ilha de Arranmore havia menos de seis meses quando milhares de aterrorizantes caçadores de almas apareceram. Os seguidores de olhos vazios da temida feiticeira Morrigan chegaram para erguer sua líder novamente e Fionn se vê impotente diante da situação. A magia do ',
        9.7
    )";

if ($bd->exec($sql))
    echo "\nlivros inseridos com sucesso\n";
else
    echo "\nerro ao inserir filmes\n";

$sql = "INSERT INTO livros(id, titulo, capa, descricao, nota) VALUES (
        1,
        'Livro Aluno 2',
        'https://cache.skoob.com.br/local/images//buzKFXPPJNTWOV-umqGY4QLogSY=/300x0/center/top/filters:format(jpeg)/https://skoob.s3.amazonaws.com/livros/11868755/VIVA_PARA_CONTAR_A_HISTORIA_161772774811868755SK-V11617727749B.jpg',
        'I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.',
        8.7
    )";

if ($bd->exec($sql))
    echo "\nlivros inseridos com sucesso\n";
else
    echo "\nerro ao inserir filmes\n";

?>