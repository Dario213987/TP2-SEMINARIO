<?php   
require_once "app/Models/LibrosModel.php";
require_once "app/Models/IdiomasModel.php";
require_once "app/Models/AutoresModel.php";
require_once "app/Views/LibrosView.php";
require_once "app/Requests/CreateLibroRequest.php";

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
    }

    public function index(){
        $this->view->index($this->model->all(), $this->isGestion());
    }

    public function show($id){
        $this->view->show($this->model->find($id), $this->isGestion());
    }

    public function create(){
        $errors = (!empty($_SESSION["errors"])) ? $_SESSION["errors"] : [];  
        $oldValues = (!empty($_SESSION["old_values"])) ? $_SESSION["old_values"] : [];  
        $this->view->create($this->autoresModel->all(), $this->idiomasModel->all(), $errors, $oldValues);
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
            $datosVerificados = $requestHandler->all();
            $this->model->create(LibroMapper::form2Libro($datosVerificados));
            move_uploaded_file($datosVerificados['portada']['tmp_name'], "/var/www/html/img/libros/".$datosVerificados['isbn'].pathinfo($datosVerificados['portada']['name'], PATHINFO_EXTENSION));
        }else{
            $_SESSION["old_values"] = $requestHandler->all();
            $_SESSION["errors"] = $requestHandler->getErrorMessages();
            header("Location: /gestion/libros/crear");
        }
    }

    public function edit($id){
        $errors = (!empty($_SESSION["errors"])) ? $_SESSION["errors"] : [];  
        $oldValues = (!empty($_SESSION["old_values"])) ? $_SESSION["old_values"] : [];  
        $this->view->edit($this->model->find($id) ,$this->autoresModel->all(), $this->idiomasModel->all(), $errors, $oldValues);
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
            'sinopsis'               
        ], ["portada"]);
        if(!$requestHandler->hasErrors()){
            $datosVerificados = $requestHandler->all();
            $this->model->update(LibroMapper::form2Libro($datosVerificados));
            if($datosVerificados['portada']['tmp_name']){
                move_uploaded_file($datosVerificados['portada']['tmp_name'], "/var/www/html/img/libros/".$datosVerificados['isbn'].pathinfo($datosVerificados['portada']['name'], PATHINFO_EXTENSION));
            }
        }else{
            $_SESSION["old_values"] = $requestHandler->all();
            $_SESSION["errors"] = $requestHandler->getErrorMessages();
            header("Location: /gestion/libros/crear");
        }
    }

    public function destroy($id){
        $this->model->delete($id);
        header("Location: /gestion/libros");
    }

    private function isGestion(){
        return explode("/", $_SERVER['REQUEST_URI'])[1] === "gestion";
    }
}
?>