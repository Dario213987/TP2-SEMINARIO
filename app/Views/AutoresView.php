<?php
require_once "libs/Smarty.class.php";
class AutoresView{
    private $smarty;

    function __construct(){
        $this->smarty = new Smarty;
        $this->smarty->registerPlugin('modifier', 'file_exists', 'file_exists');
        //$this->smarty->debugging = true;
    }

    function index($autores, $gestion){
        $this->smarty->assign("autores", $autores);
        $this->smarty->assign("gestion", value: $gestion);
        $this->smarty->display("autores/autores.tpl");
    }

    function show($autor, $libros, $gestion){
        $this->smarty->assign("autor", $autor);
        $this->smarty->assign("libros", $libros);
        $this->smarty->assign("gestion", $gestion);
        $this->smarty->display("autores/autor.tpl");
    }
    //TODO:Cambiar el parametro de si es gestion o no
    function create($errors, $oldValues, $gestion){
        $this->smarty->assign("errors", $errors);
        $this->smarty->assign("oldValues", $oldValues);
        $this->smarty->assign("gestion", $gestion);
        $this->smarty->display("autores/formAutorCrear.tpl");
    }

    function edit($autor, $errors, $oldValues, $gestion){
        $this->smarty->assign("autor", $autor);
        $this->smarty->assign("errors", $errors);
        $this->smarty->assign("oldValues", $oldValues);
        $this->smarty->assign("gestion", $gestion);
        $this->smarty->display("autores/formAutorEditar.tpl");
    }
}
?>