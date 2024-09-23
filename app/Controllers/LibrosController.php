<?php   
require_once "app/Models/LibrosModel.php";
require_once "app/Views/LibrosView.php";

class LibrosController{
    private $model;
    private $view;

    function __construct(){
        $this->model = new LibrosModel();
        $this->view = new LibrosView();
    }

    public function index(){
        $this->view->index($this->model->all(), $this->isGestion());
    }

    public function show($id){
        $this->view->show($this->model->find($id), $this->isGestion());
    }

    public function create(){

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