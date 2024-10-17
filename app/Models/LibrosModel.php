<?php
require_once "app/DBConnectionModel.php";
require_once "app/LibroMapper.php";
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
            $query = $connection->prepare("INSERT INTO libros(isbn, titulo, fecha_de_publicacion, editorial, idioma, alto, ancho, grosor, peso, encuadernado, sinopsis, autor, ruta_de_imagen) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
                $libro->ruta_de_imagen
            ]);
            if (isset($libro->img) && is_uploaded_file($libro->img["tmp_name"])) {
                move_uploaded_file($libro->img["tmp_name"],$libro->ruta_de_imagen);
            }
            $connection->commit();
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function update($libro){
        $libroOld = $this->find($libro->old_isbn);
        $libro->ruta_de_imagen = !empty($libro->ruta_de_imagen) ? $libro->ruta_de_imagen : $libroOld->ruta_de_imagen;
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("UPDATE libros SET isbn=?, titulo=?, fecha_de_publicacion=?, editorial=?, idioma=?, alto=?, ancho=?, grosor=?, peso=?, encuadernado=? , sinopsis=?, autor=?, ruta_de_imagen=? WHERE isbn = ?");
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
                $libro->ruta_de_imagen,
                $libro->old_isbn
            ]);
            $connection->commit();
            if ($libro->ruta_de_imagen && $libro->ruta_de_imagen != $libroOld->ruta_de_imagen) {
                if (file_exists($libroOld->ruta_de_imagen)) {
                    unlink($libroOld->ruta_de_imagen);
                }
                if (is_uploaded_file($libro->img["tmp_name"])) {
                    move_uploaded_file($libro->img["tmp_name"],$libro->ruta_de_imagen);
                }
            }            
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }

    public function delete($isbn){
        $libroOld = $this->find($isbn);
        try{
            $connection = $this->getConnection();
            $connection->beginTransaction();
            $query = $connection->prepare("DELETE FROM libros WHERE isbn = ?");
            $query->execute([$isbn]);
            $connection->commit();
            if($libroOld->ruta_de_imagen && file_exists($libroOld->ruta_de_imagen)){
                unlink($libroOld->ruta_de_imagen);
            }
        }catch(Exception $e){
            $connection ->rollBack();
            error_log($e ->getMessage());
        }
    }
}
?>