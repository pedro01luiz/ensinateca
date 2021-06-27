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
                $uploadVideo = $this->saveVideo($_FILES);

                if(gettype($upload)=="string"){
                        $livro->capa = $upload;
                }

                if(gettype($uploadArquivo)=="string"){
                        $livro->arquivo = $uploadArquivo;
                }

                if(gettype($uploadVideo)=="string"){
                        $livro->video = $uploadVideo;
                }



                
                if ($livrosRepository->salvar($livro))
                        $_SESSION["msg"] = "Livro cadastrado com sucesso";
                else
                        $_SESSION["msg"] = "Erro ao cadastrar livro";
                
                header("Location: /");
                
        }

        private function saveCapa($file){
                $capaDir = "imagens/capas/";
                $capaPath = $capaDir . basename($file["capa_file"]["name"]);
                $capaTmp = $file["capa_file"]["tmp_name"];
                if (move_uploaded_file($capaTmp, $capaPath)){
                        return $capaPath;
                }else{
                        return false;
                };
        }

        private function saveArquivo($file){
                $arquivoDir = "arquivos/livros/";
                $arquivoPath = $arquivoDir . basename($file["arquivo_pdf"]["name"]);
                $arquivoTmp = $file["arquivo_pdf"]["tmp_name"];
                if (move_uploaded_file($arquivoTmp, $arquivoPath)){
                        return $arquivoPath;
                }else{
                        return false;
                };
        }

        private function saveVideo($file){
                $videoDir = "arquivos/videos/";
                $videoPath = $videoDir . basename($file["video_file"]["name"]);
                $videoTmp = $file["video_file"]["tmp_name"];
                if (move_uploaded_file($videoTmp, $videoPath)){
                        return $videoPath;
                }else{
                        return false;
                };
        }

        public function delete(int $id){
                $livrosRepository = new LivrosRepositoryPDO();
                $result = ['success' => $livrosRepository->delete($id)];
                header('Content-type: application/json');
                echo json_encode($result);
        }

}

