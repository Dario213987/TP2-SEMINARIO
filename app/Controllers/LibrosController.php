<?php   
require_once "app/Models/LibrosModel.php";
require_once "app/Models/IdiomasModel.php";
require_once "app/Models/AutoresModel.php";
require_once "app/Views/LibrosView.php";

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
        $this->view->create($this->autoresModel->all(), $this->idiomasModel->all());
    }

    public function store(){
        $libro = new stdClass();
        $libro->titulo = $_POST["titulo"];
        $libro->autor = $this->autoresModel->find($_POST["autor"]);
        $libro->fecha_de_publicacion = $_POST["fecha_de_publicacion"];
        $libro->editorial = $_POST["editorial"];
        $libro->isbn = $_POST["isbn"];
        $libro->idioma = $this->idiomasModel->find($_POST["idioma"]);
        $libro->alto = $_POST["alto"];
        $libro->ancho = $_POST["ancho"];
        $libro->grosor = $_POST["grosor"];
        $libro->peso = $_POST["peso"];
        $libro->encuadernado = $_POST["encuadernado"];
        $libro->sinopsis = $_POST["sinopsis"];
        move_uploaded_file($_FILES['portada']['tmp_name'], "/var/www/html/img/libros/".$libro->isbn.".png");
        $this->model->create($libro);
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