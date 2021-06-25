<?php

session_start();

require "./repository/LivrosRepositoryPDO.php";
require "./model/Livro.php";

class LivrosController{

        public function index(){
                $livrosRepository = new LivrosRepositoryPDO();
                return $livrosRepository->listarTodos();
        }

        public function save($request){

                $livrosRepository = new LivrosRepositoryPDO();          
                $livro = (object) $request;

                $upload = $this->saveCapa($_FILES);
                $uploadArquivo = $this->saveArquivo($_FILES);

                if(gettype($upload)=="string"){
                        $livro->capa = $upload;
                }

                if(gettype($uploadArquivo)=="string"){
                        $livro->arquivo = $uploadArquivo;
                }



                
                if ($livrosRepository->salvar($livro))
                        $_SESSION["msg"] = "Livro cadastrado com sucesso";
                else
                        $_SESSION["msg"] = "Erro ao cadastrar livro";
                
                header("Location: /");
                
        }

        private function saveCapa($file){

                $destination_path = getcwd() . DIRECTORY_SEPARATOR . "imagens/capas";
                $target_path = $destination_path . '/' . basename( $file["capa_file"]["name"]);
                $moved = move_uploaded_file($file['capa_file']['tmp_name'], $target_path);

                if ($moved) {
                        return "/imagens/capas/" . $file["capa_file"]["name"];
                } else {
                        throw new Exception("Erro ao salvar o arquivo, verifique se você tem as permissões para a pasta.");
                }
                
        }

        private function saveArquivo($file){
                $arquivoDir = "arquivos/";
                $arquivoPath = $arquivoDir . basename($file["arquivo_pdf"]["name"]);
                $arquivoTmp = $file["arquivo_pdf"]["tmp_name"];
                if (move_uploaded_file($arquivoTmp, $arquivoPath)){
                        return $arquivoPath;
                }else{
                        return false;
                };
        }

        public function favorite(int $id){
                $livrosRepository = new LivrosRepositoryPDO();
                $result = ['success' => $livrosRepository->favoritar($id)];
                header('Content-type: application/json');
                echo json_encode($result);
        }

        public function delete(int $id){
                $livrosRepository = new LivrosRepositoryPDO();
                $result = ['success' => $livrosRepository->delete($id)];
                header('Content-type: application/json');
                echo json_encode($result);
        }

}

