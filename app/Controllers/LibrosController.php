<?php   
require_once "app/Models/LibrosModel.php";
require_once "app/Models/IdiomasModel.php";
require_once "app/Models/AutoresModel.php";
require_once "app/Views/LibrosView.php";
require_once "app/Requests/CreateLibroRequest.php";
require_once "app/LibroMapper.php";

class LibrosController{
    private $model;
    private $idiomasModel;
    private $autoresModel;
    private $view;

    function __construct(){
        $this->model = new LibrosModel();
        $this->idiomasModel = new idiomasModel();
        $this->autoresModel = new AutoresModel();
        $this->view = new LibrosView();
        session_start();
    }

    public function index(){
        $this->limpiarErrores();
        $this->view->index($this->model->all(), $this->isGestion());
    }

    public function show($id){
        $this->limpiarErrores();
        $libro = $this->model->find($id);
        if($libro){
            $this->view->show($libro, $this->isGestion());
        }else{
            if($this->isGestion()){
                header("Location: /gestion/libros");
                die();
            }
            header("Location: /libros");
            die();
        }
    }

    public function create(){
        $errors = $_SESSION["errors"] ?? [];  
        $oldValues = $_SESSION["old_values"] ?? [];
        $this->view->create($this->autoresModel->all(), $this->idiomasModel->all(), $errors, $oldValues, $this->isGestion());
    }

    public function store(){
        $this->limpiarErrores();
        $requestHandler = new CreateLibroRequest([
            'titulo',                
            'autor',                 
            'fecha_de_publicacion',   
            'editorial',             
            'isbn',                  
            'idioma',                
            'alto',                  
            'ancho',                
            'grosor',                
            'peso',                  
            'encuadernado',         
            'sinopsis'               
        ], ["portada"]);
        if(!$requestHandler->hasErrors()){
            $libro = LibroMapper::request2Libro($requestHandler);
            $this->model->create($libro);
            header("Location: /gestion/libros");
            die();
        }else{
            $_SESSION["old_values"] = $requestHandler->all();
            $_SESSION["errors"] = $requestHandler->getErrorMessages();
            header("Location: /gestion/libros/crear");
            die();
        }

    }

    public function edit($id){
        $errors = $_SESSION["errors"] ?? [];  
        $oldValues = $_SESSION["old_values"] ?? [];
        $libro = $this->model->find($id);
        if($libro){
            $this->view->edit($libro,$this->autoresModel->all(), $this->idiomasModel->all(), $errors, $oldValues, $this->isGestion());
        }else{
            if($this->isGestion()){
                header("Location: /gestion/libros");
                die();
            }
            header("Location: /libros");
            die();
        }
    }

    public function update(){
        $this->limpiarErrores();
        $requestHandler = new CreateLibroRequest([
            'titulo',                
            'autor',                 
            'fecha_de_publicacion',   
            'editorial',             
            'isbn',                  
            'idioma',                
            'alto',                  
            'ancho',                
            'grosor',                
            'peso',                  
            'encuadernado',         
            'sinopsis',
            'old_isbn'               
        ], ["portada"]);
        if(!$requestHandler->hasErrors()){
            $libro = LibroMapper::request2Libro($requestHandler);
            $this->model->update($libro);
            header("Location: /gestion/libros");
            die();
        }else{
            $_SESSION["old_values"] = $requestHandler->all();
            $_SESSION["errors"] = $requestHandler->getErrorMessages();
            header("Location: /gestion/libros/editar/".$_POST["old_isbn"]);
            die();
        }
    }

    public function destroy($id){
        $this->model->delete($id);
        header("Location: /gestion/libros");
        die();
    }

    private function isGestion(){
        return explode("/", $_SERVER['REQUEST_URI'])[1] === "gestion";
    }

    private function limpiarErrores(){
        unset($_SESSION["old_values"],$_SESSION["errors"]);
    }
}
?>