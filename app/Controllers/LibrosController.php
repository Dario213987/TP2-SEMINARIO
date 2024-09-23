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