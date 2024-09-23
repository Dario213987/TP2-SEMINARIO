<?php
require_once "libs/Smarty.class.php";
class LibrosView{
    private $smarty;

    function __construct(){
        $this->smarty = new Smarty;
        $this->smarty->registerPlugin('modifier', 'file_exists', 'file_exists');
        $this->smarty->assign('document_root', $_SERVER['DOCUMENT_ROOT']);
        $this->smarty->debugging = true;
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

    function create($autores, $idiomas){
        $this->smarty->assign("autores", $autores);
        $this->smarty->assign("idiomas", $idiomas);
        $this->smarty->display("libros/formLibroCrear.tpl");
    }
}
?>