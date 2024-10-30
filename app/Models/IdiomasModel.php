<?php
require_once "app/Models/DBConnectionModel.php";
class idiomasModel extends DBConnectionModel{

    public function all(){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("SELECT * FROM idiomas");
            $query->execute();
            $idiomas = $query->fetchAll(PDO::FETCH_OBJ);
            $connection->commit();
            return $idiomas;
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function find($id){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("SELECT * FROM idiomas WHERE id = ?");
            $query->execute([$id]);
            $idioma = $query->fetch(PDO::FETCH_OBJ);
            $connection->commit();
            return $idioma;
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function create($idioma){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("INSERT INTO idiomas(nombre) VALUES(?)");
            $query->execute([$idioma->nombre]);
            $connection->commit();
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }


    public function update($idioma){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("UPDATE idiomas SET nombre=? WHERE id = ?");
            $query->execute([$idioma->nombre, $idioma->id]);
            $connection->commit();
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function delete($id){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("DELETE FROM idiomas WHERE id = ?");
            $query->execute([$id]);
            $connection->commit();
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }


}
?>