<?php   
require_once "app/Models/AutoresModel.php";
require_once "app/Views/AutoresView.php";

class AutoresController{
    private $model;
    private $view;

    function __construct(){
        $this->model = new AutoresModel();
        $this->view = new AutoresView();
    }

    public function index(){
        $this->view->index($this->model->getAllRecords(), $this->isGestion());
    }

    public function show($id){
       // $this->view->show($this->model->getRecord($id), $this->isGestion());
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
        return explode("/", $_SERVER['REQUEST_URI'])[0] !== "gestion";
    }
}
?>