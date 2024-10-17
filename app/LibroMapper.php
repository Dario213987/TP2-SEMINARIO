<?php
require_once "config/config.php";
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

    public static function request2Libro($request){
        global $configuracion;
        $values = $request->all();
        $libro = new stdClass();
        $libro->isbn = $values['isbn'];
        $libro->titulo = $values['titulo'];
        $libro->fecha_de_publicacion = $values['fecha_de_publicacion'];
        $libro->editorial = $values['editorial'];
        $libro->alto = $values['alto'];
        $libro->ancho = $values['ancho'];
        $libro->grosor = $values['grosor'];
        $libro->peso = $values['peso'];
        $libro->encuadernado = $values['encuadernado'];
        $libro->sinopsis = $values['sinopsis'];
        $autor = new stdClass();
        $autor->id = $values["autor"];
        $libro->autor = $autor;
        $idioma = new stdClass();
        $idioma->id = $values["idioma"];
        $libro->idioma = $idioma;
        $libro->old_isbn = $values["old_isbn"] ?? "";
        if (isset($values['portada']) && $values['portada']['tmp_name']) {
            $portadaRutaTemporal = $values['portada']['tmp_name'];
            $archivoPortada = file_get_contents($portadaRutaTemporal);
            $hash = hash("sha256", $archivoPortada);
            $extension = pathinfo($values['portada']['name'], PATHINFO_EXTENSION);
            //TODO: hacer que la ruta donde se guardan las imagenes sea una global configurable
            $libro->ruta_de_imagen = $configuracion['libros_image_route'] . $hash . "." . $extension;
        } else {
            $libro->ruta_de_imagen = "";
        }
        $libro->img = (file_exists($values['portada']['tmp_name'])) ? $values['portada'] : null; 
        return $libro;
    }
}
?>