<?php   
require_once "app/Models/AutoresModel.php";
require_once "app/Views/AutoresView.php";
require_once "app/AutorMapper.php";
require_once "app/Requests/CreateAutorRequest.php";
class AutoresController{
    private $model;
    private $view;

    function __construct(){
        $this->model = new AutoresModel();
        $this->view = new AutoresView();
        session_start();
    }

    public function index(){
        $this->limpiarErrores();
        $this->view->index($this->model->all(), $this->isGestion());
    }

    public function show($id){
        $this->limpiarErrores();
       $this->view->show($this->model->find($id), $this->model->librosFromAutor($id), $this->isGestion());
    }

    public function create(){
        $errors = $_SESSION["errors"] ?? [];  
        $oldValues = $_SESSION["old_values"] ?? [];  
        $this->view->create($errors, $oldValues,$this->isGestion());
    }

    public function store(){
        unset($_SESSION["old_values"],$_SESSION["errors"]);
        $requestHandler = new CreateAutorRequest(["nombre", "biografia"], ["foto"]);
        if(!$requestHandler->hasErrors()){
            $autor = AutorMapper::request2Autor($requestHandler);
            $this->model->create($autor);
            header("Location: /gestion/autores");
        }else{
            $_SESSION["old_values"] = $requestHandler->all();
            $_SESSION["errors"] = $requestHandler->getErrorMessages();
            header("Location: /gestion/autores/crear");
        }
    }

    public function edit($id){
        $errors = $_SESSION["errors"] ?? [];  
        $oldValues = $_SESSION["old_values"] ?? [];  
        $this->view->edit($this->model->find($id), $errors, $oldValues, $this->isGestion());
    }

    public function update(){
        unset($_SESSION["old_values"],$_SESSION["errors"]);
        $requestHandler = new CreateAutorRequest(["id", "nombre", "biografia"], ["foto"]);
        if(!$requestHandler->hasErrors()){
            $autor = AutorMapper::request2Autor($requestHandler);
            $this->model->update($autor);
            header("Location: /gestion/autores");
        }else{
            $_SESSION["old_values"] = $requestHandler->all();
            $_SESSION["errors"] = $requestHandler->getErrorMessages();
            header("Location: /gestion/autores/editar/".$_POST['id']);
        }
    }

    public function destroy($id){$this->limpiarErrores();
        $this->model->delete($id);
        header("Location: /gestion/autores");
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