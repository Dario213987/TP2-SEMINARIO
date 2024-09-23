<?php
    require_once "app/Controllers/LibrosController.php";
    require_once "app/Controllers/AutoresController.php";

    define("BASE_URL", "//".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]));
    $librosController = new LibrosController();
    $autoresController = new AutoresController();
    $action = $_GET['action'];
    if($action != ""){
        $parameters = explode('/',$action);

        switch($parameters[0]){
            case "inicio":
            case "libros":
                  $librosController->index();
                break;
            case "gestion":
                    if(!empty($parameters[1])){
                        switch($parameters[1]){
                            case "libros":
                                if(!empty($parameters[2])){
                                    switch($parameters[2]){
                                        case "crear":
                                            $librosController->create();
                                            break;
                                        case "guardar":
                                            $librosController->store();
                                            break;
                                        default:
                                            $librosController->show($parameters[2]);
                                    }
                                }else{
                                    $librosController->index();
                                }
                                break;
                        }
                    }else{
                        $librosController->index();
                    }
                break;
            case "autores":
                if(!empty($parameters[1])){
                    $autoresController->show($parameters[1]);
                }else{
                    $autoresController->index();
                }
                break;

            default:
                 $librosController->index();
                break;

        }
    }else{
        $librosController->index();
    }
    

?>