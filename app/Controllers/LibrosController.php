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
        $this->view->show($this->model->find($id), $this->isGestion());
    }

    public function create(){
        $errors = $_SESSION["errors"] ?? [];  
        $oldValues = $_SESSION["old_values"] ?? [];  
        $this->view->create($this->autoresModel->all(), $this->idiomasModel->all(), $errors, $oldValues, $this->isGestion());
    }

    public function store(){
        unset($_SESSION["old_values"],$_SESSION["errors"]);
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
        }else{
            $_SESSION["old_values"] = $requestHandler->all();
            $_SESSION["errors"] = $requestHandler->getErrorMessages();
            header("Location: /gestion/libros/crear");
        }

    }

    public function edit($id){
        $errors = $_SESSION["errors"] ?? [];  
        $oldValues = $_SESSION["old_values"] ?? [];  
        $this->view->edit($this->model->find($id) ,$this->autoresModel->all(), $this->idiomasModel->all(), $errors, $oldValues, $this->isGestion());
    }

    public function update(){
        unset($_SESSION["old_values"],$_SESSION["errors"]);
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
        }else{
            $_SESSION["old_values"] = $requestHandler->all();
            $_SESSION["errors"] = $requestHandler->getErrorMessages();
            header("Location: /gestion/libros/editar/".$_POST["old_isbn"]);
        }
    }

    public function destroy($id){
        $this->model->delete($id);
        header("Location: /gestion/libros");
    }

    private function isGestion(){
        return explode("/", $_SERVER['REQUEST_URI'])[1] === "gestion";
    }

    private function limpiarErrores(){
        $_SESSION["old_values"] = [];
        $_SESSION["errors"] = [];
    }
}
?>