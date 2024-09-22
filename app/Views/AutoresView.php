<?php
require_once "libs/Smarty.class.php";
class AutoresView{
    private $smarty;

    function __construct(){
        $this->smarty = new Smarty;
        $this->smarty->registerPlugin('modifier', 'file_exists', 'file_exists');
        $this->smarty->assign('document_root', $_SERVER['DOCUMENT_ROOT']);
    }

    function index($autores, $gestion){
        $this->smarty->assign("autores", $autores);
        $this->smarty->assign("gestion", value: $gestion);
        $this->smarty->display("autores/autores.tpl");
    }

    function show($autor, $gestion){
        $this->smarty->assign(tpl_var: "autor", value: $autor);
        $this->smarty->assign("gestion", $gestion);
        $this->smarty->display("libros/libro.tpl");
    }
}
?>