<?php
class LibroMapper{
    public static function model2Libro($libro){
        $autor = new stdClass();
        $autor->id = $libro->autor_id;
        $autor->nombre = $libro->autor_nombre;
        $libro->autor = $autor;
        $idioma = new stdClass();
        $idioma->id = $libro->idioma_id;
        $idioma->nombre = $libro->idioma_nombre;
        $libro->idioma = $idioma;
        unset($libro->autor_id, $libro->autor_nombre, $libro->idioma_id, $libro->idioma_nombre);
        return $libro;
    }

    public static function form2Libro($libro){
        $autor = new stdClass();
        $autor->id = $libro->autor;
        $libro->autor = $autor;
        $idioma = new stdClass();
        $idioma->id = $libro->idioma_id;
        $libro->idioma = $idioma;
        unset($libro->autor_id, $libro->autor_nombre, $libro->idioma_id, $libro->idioma_nombre);
        return $libro;
    }
}
?>