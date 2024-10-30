<?php
require_once "config/config.php";
class DBConnectionModel{
    
    private $db;

    function __construct(){
        $this->createConnection();
    }


    public function createConnection(){
        try{
            $this->db = new PDO('mysql:host='.MYSQL_HOST.';port='.MYSQL_PORT.';dbname='.MYSQL_DB.';charset=utf8',
            MYSQL_USER,
            MYSQL_PASSWORD);
            $this->deploy();
        }catch(Exception $e){
            var_dump($e);
        }
    }

    public function getConnection(){
        return $this->db;
    }

    private function deploy() {
        try {
            $tables = $this->db->query('SHOW TABLES')->fetchAll();
            if (count($tables) == 0) {
                $this->db->exec(file_get_contents(SQL_FILE_ROUTE));
            }
        } catch(Exception $e) {
            var_dump($e);
        }
    }
}
?>