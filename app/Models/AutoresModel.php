<?php
require_once "app/DBConnectionModel.php";
class AutoresModel extends DBConnectionModel{

    public function getAllRecords(){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("SELECT * FROM autores");
            $query->execute();
            $connection->commit();
            $this->closeConnection();
            $autores = $query->fetchAll(PDO::FETCH_OBJ);
            return $autores;
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function getRecord($id){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("SELECT libros.*, autores.id AS autor_id, autores.nombre AS autor_nombre FROM libros JOIN autores ON libros.autor = autores.id WHERE libros.isbn = ?");
            $query->execute([$id]);
            $connection->commit();
            $this->closeConnection();
            $libro = $query->fetch(PDO::FETCH_OBJ);
            $autor = new stdClass();
            $autor->id = $libro->autor_id;
            $autor->nombre = $libro->autor_nombre;
            unset($libro->autor_id, $libro->autor_nombre, $libro->autor);
            $libro->autor = $autor;
            return $libro;
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }
    public function generic(){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();

            $connection->commit();
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }
}
?>