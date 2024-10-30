<?php
require_once "app/Models/DBConnectionModel.php";
class AutoresModel extends DBConnectionModel{

    public function all(){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("SELECT * FROM autores");
            $query->execute();
            $autores = $query->fetchAll(PDO::FETCH_OBJ);
            $connection->commit();
            return $autores;
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function librosFromAutor($id){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("SELECT * FROM libros WHERE autor = ?");
            $query->execute([$id]);
            $libros = $query->fetchAll(PDO::FETCH_OBJ);
            $connection->commit();
            return $libros;
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function find($id){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("SELECT * FROM autores WHERE id = ?");
            $query->execute([$id]);
            $autor = $query->fetch(PDO::FETCH_OBJ);
            $connection->commit();
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
            $query = $connection->prepare("INSERT INTO autores(nombre, biografia, ruta_de_imagen) VALUES(?, ?, ?)");
            $query->execute([$autor->nombre, $autor->biografia, $autor->ruta_de_imagen]);
            $connection->commit();
            if ($autor->ruta_de_imagen && is_uploaded_file($autor->img["tmp_name"])) {
                move_uploaded_file($autor->img["tmp_name"], $autor->ruta_de_imagen);
            }
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }


    public function update($autor){
        $autorOld = $this->find($autor->id);
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("UPDATE autores SET nombre=?, biografia=?, ruta_de_imagen=? WHERE id = ?");
            $query->execute([$autor->nombre, $autor->biografia, $autor->ruta_de_imagen, $autor->id]);
            $connection->commit();
            if ($autor->ruta_de_imagen && $autor->ruta_de_imagen != $autorOld->ruta_de_imagen) {
                if (file_exists($autorOld->ruta_de_imagen)) {
                    unlink($autorOld->ruta_de_imagen);
                }
                if (is_uploaded_file($autor->img["tmp_name"])) {
                    move_uploaded_file($autor->img["tmp_name"],$autor->ruta_de_imagen);
                }
            }    
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function delete($id){
        $autorOld = $this->find($id);
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("DELETE FROM autores WHERE id = ?");
            $query->execute([$id]);
            $connection->commit();
            if($autorOld->ruta_de_imagen){
                unlink($autorOld->ruta_de_imagen);
            }
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }


}
?>