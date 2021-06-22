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

                if(gettype($upload)=="string"){
                        $livro->capa = $upload;
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

