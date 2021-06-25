<?php include "cabecalho.php" ?>

<body>
    <nav class="nav-extended amber darken-1">
        <div class="nav-wrapper">
            <ul id="nav-mobile" class="right">
                <li><a href="/">Biblioteca</a></li>
                <li class="active"><a href="/novo">Cadastrar</a></li>
            </ul>
        </div>
        <div class="nav-header center">
            <h1>ENSINATECA</h1>
        </div>
        <div class="nav-content">
            <ul class="tabs tabs-transparent amber darken-4">
                <li class="tab"><a class="active" href="#test1">Todos</a></li>
                <li class="tab"><a href="#test3">Favoritos</a></li>
            </ul>
        </div>
    </nav>

    <div class="row">
        <form method="POST" enctype="multipart/form-data">
            <div class="col s6 offset-s3">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Cadastrar Livro</span>
                        <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>

                        <!-- input titulo -->
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="titulo" type="text" class="validate" name="titulo" required>
                                <label for="titulo">Título do Livro</label>
                            </div>
                        </div>

                        <!-- input descrição -->
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea name="descricao" id="descricao" class="materialize-textarea"></textarea>
                                <label for="descricao">Descrição</label>
                            </div>
                        </div>

                        <!-- input nota -->
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="nota" name="nota" type="number" step=".1" min="0" max="10" class="validate" required>
                                <label for="nota">Nota</label>
                            </div>
                        </div>

                        <!-- input capa -->
                        <div class="file-field input-field">
                            <div class="btn amber darken-2">
                                <span>Capa</span>
                                <input type="file" name="capa_file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" name="capa">
                            </div>
                        </div>

                        <!-- input arquivo -->
                        <div class="file-field input-field">
                            <div class="btn amber darken-2">
                                <span>Livro</span>
                                <input type="file" name="arquivo_pdf">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" name="arquivo">
                            </div>
                        </div>

                    </div>
                    <div class="card-action">
                        <a class="btn waves-effect waves-light grey" href="/">Cancelar</a>
                        <button type="submit" class="waves-effect waves-light btn amber darken-4">Confirmar</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</body>