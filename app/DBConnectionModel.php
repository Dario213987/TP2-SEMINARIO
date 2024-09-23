<?php
class DBConnectionModel{
    
    private $db;

    function __construct(){
        $this->db = $this->createConnection();
    }


    public function createConnection(){
        try{
            $pdo = new PDO('mysql:host=db;port=3306;dbname=libreria;charset=utf8',
            'root',
            'root');
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