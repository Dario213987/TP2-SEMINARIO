<?php
require_once "libs/Smarty.class.php";
class LibrosView{
    private $smarty;

    function __construct(){
        $this->smarty = new Smarty;
        $this->smarty->registerPlugin('modifier', 'file_exists', 'file_exists');
        //$this->smarty->debugging = true;
    }

    function index($libros, $gestion){
        $this->smarty->assign("libros", $libros);
        $this->smarty->assign("gestion", $gestion);
        $this->smarty->display("libros/libros.tpl");
    }

    function show($libro, $gestion){
        $this->smarty->assign("libro", $libro);
        $this->smarty->assign("gestion", $gestion);
        $this->smarty->display("libros/libro.tpl");
    }

    function create($autores, $idiomas, $errors, $oldValues, $gestion){
        $this->smarty->assign("autores", $autores);
        $this->smarty->assign("idiomas", $idiomas);
        $this->smarty->assign("errors", $errors);
        $this->smarty->assign("oldValues", $oldValues);
        $this->smarty->assign("gestion", $gestion);
        $this->smarty->display("libros/formLibroCrear.tpl");
    }

    function edit($libro, $autores, $idiomas, $errors, $oldValues, $gestion){
        $this->smarty->assign("libro", $libro);
        $this->smarty->assign("autores", $autores);
        $this->smarty->assign("idiomas", $idiomas);
        $this->smarty->assign("errors", $errors);
        $this->smarty->assign("oldValues", $oldValues);
        $this->smarty->assign("gestion", $gestion);
        $this->smarty->display("libros/formLibroEditar.tpl");
    }
}
?>