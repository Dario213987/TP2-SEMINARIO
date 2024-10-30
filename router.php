<?php
    require_once "app/Controllers/LibrosController.php";
    require_once "app/Controllers/AutoresController.php";

    define("BASE_URL", "//".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]));
    $action = $_GET['action'];
    if($action != ""){
        $parameters = explode('/',$action);
        switch($parameters[0]){
            case "inicio":
                $librosController = new LibrosController();
                $librosController->index();
                break;
            case "libros":
                $librosController = new LibrosController();
                if(!empty($parameters[1])){
                    $librosController->show($parameters[1]);
                }else{
                    $librosController->index();
                }
                break;
            case "autores":
                $autoresController = new AutoresController();
                if(!empty($parameters[1])){
                    $autoresController->show($parameters[1]);
                }else{
                    $autoresController->index();
                }
                break;
            case "gestion":

                if(!empty($parameters[1])){

                    switch($parameters[1]){
                        case "inicio":
                            $librosController = new LibrosController();
                            $librosController->index();
                            break;
                        case "libros":
                            $librosController = new LibrosController();
                            if(!empty($parameters[2])){
                                switch($parameters[2]){
                                    case "crear":
                                        $librosController->create();
                                        break;
                                    case "guardar":
                                        $librosController->store();
                                        break;
                                    case "editar":
                                        $librosController->edit($parameters[3]);
                                        break;
                                    case "modificar":
                                        $librosController->update();
                                        break;
                                    case "eliminar":
                                        $librosController->destroy($parameters[3]);
                                        break;
                                    default:
                                        $librosController->show($parameters[2]);
                                        break;
                                }
                            }else{
                                $librosController->index();
                            }
                            break;
                        case "autores":
                            $autoresController = new AutoresController();
                            if(!empty($parameters[2])){
                                switch($parameters[2]){
                                    case "crear":
                                        $autoresController->create();
                                        break;
                                    case "guardar":
                                        $autoresController->store();
                                        break;
                                    case "editar":
                                        $autoresController->edit($parameters[3]);
                                        break;
                                    case "modificar":
                                        $autoresController->update();
                                        break;
                                    case "eliminar":
                                        $autoresController->destroy($parameters[3]);
                                        break;
                                    default:
                                        $autoresController->show($parameters[2]);
                                        break;
                                }
                            }else{
                                $autoresController->index();
                            }
                            break;
                    }
                }else{
                    $librosController = new LibrosController();
                    $librosController->index();
                }
                break;
            default:
                $librosController = new LibrosController();
                $librosController->index();
                break;
        }
    }else{
        $librosController = new LibrosController();
        $librosController->index();
    }
    

?>