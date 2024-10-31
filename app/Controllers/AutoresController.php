<?php   
require_once "app/Models/AutoresModel.php";
require_once "app/Models/LibrosModel.php";
require_once "app/Views/AutoresView.php";
require_once "app/AutorMapper.php";
require_once "app/Requests/CreateAutorRequest.php";
class AutoresController{
    private $model;
    private $librosModel;
    private $view;

    function __construct(){
        $this->model = new AutoresModel();
        $this->view = new AutoresView();
        $this->librosModel = new LibrosModel();
        session_start();
    }

    public function index(){
        $this->limpiarErrores();
        $this->view->index($this->model->all(), $this->isGestion());
    }

    public function show($id){
        $this->limpiarErrores();
        $autor = $this->model->find($id);
        if($autor){
            $this->view->show($autor, $this->model->librosFromAutor($id), $this->isGestion());
        }else{
            if($this->isGestion()){
                header("Location: /gestion/autores");
                die();
            }
            header("Location: /autores");
            die();
        }
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
            die();
        }else{
            $_SESSION["old_values"] = $requestHandler->all();
            $_SESSION["errors"] = $requestHandler->getErrorMessages();
            header("Location: /gestion/autores/crear");
            die();
        }
    }

    public function edit($id){
        $errors = $_SESSION["errors"] ?? [];  
        $oldValues = $_SESSION["old_values"] ?? [];
        $autor = $this->model->find($id);
        if($autor){
            $this->view->edit($autor, $errors, $oldValues, $this->isGestion());
        }else{
            header("Location: /gestion/autores");
            die();
        } 
    }

    public function update(){
        unset($_SESSION["old_values"],$_SESSION["errors"]);
        $requestHandler = new CreateAutorRequest(["id", "nombre", "biografia"], ["foto"]);
        if(!$requestHandler->hasErrors()){
            $autor = AutorMapper::request2Autor($requestHandler);
            $this->model->update($autor);
            header("Location: /gestion/autores");
            die();
        }else{
            $_SESSION["old_values"] = $requestHandler->all();
            $_SESSION["errors"] = $requestHandler->getErrorMessages();
            header("Location: /gestion/autores/editar/".$_POST['id']);
            die();
        }
    }

    public function destroy($id){$this->limpiarErrores();
        $librosDeAutor = $this->model->librosFromAutor($id);
        foreach($librosDeAutor as $libro){
            $this->librosModel->delete($libro->isbn);
        }
        $this->model->delete($id);
        header("Location: /gestion/autores");
        die();
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