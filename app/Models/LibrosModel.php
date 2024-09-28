<?php
require_once "app/DBConnectionModel.php";
class LibrosModel extends DBConnectionModel{

    public function all(){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("SELECT libros.*, autores.id AS autor_id, autores.nombre AS autor_nombre , idiomas.id AS idioma_id, idiomas.nombre AS idioma_nombre FROM libros JOIN autores ON libros.autor = autores.id JOIN idiomas ON libros.idioma = idiomas.id");
            $query->execute();
            $connection->commit();
            $libros = $query->fetchAll(PDO::FETCH_OBJ);
            foreach($libros as $libro){
            $libro = LibroMapper::model2Libro($libro);
            }
            return $libros;
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function find($isbn){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("SELECT libros.*, autores.id AS autor_id, autores.nombre AS autor_nombre , idiomas.id AS idioma_id, idiomas.nombre AS idioma_nombre FROM libros JOIN autores ON libros.autor = autores.id JOIN idiomas ON libros.idioma = idiomas.id WHERE libros.isbn = ?");
            $query->execute([$isbn]);
            $connection->commit();
            $libro = $query->fetch(PDO::FETCH_OBJ);
            return LibroMapper::model2Libro($libro);
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    function create($libro){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("INSERT INTO libros(isbn, titulo, fecha_de_publicacion, editorial, idioma, alto, ancho, grosor, peso, encuadernado, sinopsis, autor) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $query->execute([
                $libro->isbn,
                $libro->titulo,
                $libro->fecha_de_publicacion,
                $libro->editorial,
                $libro->idioma->id,
                $libro->alto,
                $libro->ancho,
                $libro->grosor,
                $libro->peso,
                $libro->encuadernado,
                $libro->sinopsis,
                $libro->autor->id
            ]);
            $connection->commit();
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function update($libro){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("UPDATE libros SET isbn=?, titulo=?, fecha_de_publicacion=?, editorial=?, idioma=?, alto=?, ancho=?, grosor=?, peso=?, encuadernado=? , sinopsis=?, autor=? WHERE isbn = ?");
            $query->execute([
                $libro->isbn,
                $libro->titulo,
                $libro->fecha_de_publicacion,
                $libro->editorial,
                $libro->idioma->id,
                $libro->alto,
                $libro->ancho,
                $libro->grosor,
                $libro->peso,
                $libro->encuadernado,
                $libro->sinopsis,
                $libro->autor->id,
                $libro->isbn
            ]);
            $connection->commit();
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function save($libro){
        if(isset($libro->isbn)){
            $this->update($libro);
        }else{
            $this->create($libro);
        }
    }

    public function delete($isbn){
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("DELETE FROM libros WHERE isbn = ?");
            $query->execute([$isbn]);
            $connection->commit();
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }
}
?>