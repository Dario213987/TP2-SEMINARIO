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
            $libro = new stdClass();
            $libro->titulo = $datosVerificados["titulo"];
            $libro->autor = $this->autoresModel->find($datosVerificados["autor"]);
            $libro->fecha_de_publicacion = $datosVerificados["fecha_de_publicacion"];
            $libro->editorial = $datosVerificados["editorial"];
            $libro->isbn = $datosVerificados["isbn"];
            $libro->idioma = $this->idiomasModel->find($datosVerificados["idioma"]);
            $libro->alto = $datosVerificados["alto"];
            $libro->ancho = $datosVerificados["ancho"];
            $libro->grosor = $datosVerificados["grosor"];
            $libro->peso = $datosVerificados["peso"];
            $libro->encuadernado = $datosVerificados["encuadernado"];
            $libro->sinopsis = $$datosVerificados["sinopsis"];
            move_uploaded_file($datosVerificados['portada']['tmp_name'], "/var/www/html/img/libros/".$libro->isbn.pathinfo($datosVerificados['portada']['name'], PATHINFO_EXTENSION));
            $this->model->create($libro);
        }else{
            $_SESSION["old_values"] = $requestHandler->all();
            $_SESSION["errors"] = $requestHandler->getErrorMessages();
            header("Location: /gestion/libros/crear");
            }
    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }

    private function isGestion(){
        return explode("/", $_SERVER['REQUEST_URI'])[1] === "gestion";
    }
}
?>