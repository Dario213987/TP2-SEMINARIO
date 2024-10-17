<?php
require_once "config/config.php";
class DBConnectionModel{
    
    private $db;

    function __construct(){
        $this->db = $this->createConnection();
    }


    public function createConnection(){
        try{
            global $configuracion;
            $pdo = new PDO('mysql:host='.$configuracion['host'].';port='.$configuracion['db_port'].';dbname='.$configuracion['database'].';charset=utf8',
            $configuracion['user'],
            $configuracion['password']);
        }catch(Exception $e){
            var_dump($e);
        }
        return $pdo;
    }

    public function getConnection(){
        return $this->db;
    }
}
?>