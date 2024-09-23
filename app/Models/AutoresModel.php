<?php
require_once "app/DBConnectionModel.php";
class AutoresModel extends DBConnectionModel{

    public function all(){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("SELECT * FROM autores");
            $query->execute();
            $connection->commit();
            $autores = $query->fetchAll(PDO::FETCH_OBJ);
            return $autores;
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function find($id){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("SELECT * FROM libroe WHERE id = ?");
            $query->execute([$id]);
            $connection->commit();
            $autor = $query->fetch(PDO::FETCH_OBJ);
            return $autor;
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function create($autor){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("INSERT INTO libros(nombre, biografia) VALUES(?, ?)");
            $query->execute([$autor->nombre, $autor->biografia]);
            $connection->commit();
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }


    public function update($autor){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("UPDATE autores SET nombre=?, biografia=? WHERE id = ?");
            $query->execute([$autor->nombre, $autor->biografia, $autor->id]);
            $connection->commit();
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function save($autor){
        if(isset($autor->id)){
            $this->update($autor);
        }else{
            $this->create($autor);
        }
    }

    public function delete($id){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("DELETE FROM autores WHERE id = ?");
            $query->execute([$id]);
            $connection->commit();
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }


}
?>