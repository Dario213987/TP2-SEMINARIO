<?php
require_once "app/DBConnectionModel.php";
class idiomasModel extends DBConnectionModel{

    public function all(){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("SELECT * FROM idiomas");
            $query->execute();
            $connection->commit();
            $idiomas = $query->fetchAll(PDO::FETCH_OBJ);
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
            $connection->commit();
            $idioma = $query->fetch(PDO::FETCH_OBJ);
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

    public function save($idioma){
        if(isset($idioma->id)){
            $this->update($idioma);
        }else{
            $this->create($idioma);
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