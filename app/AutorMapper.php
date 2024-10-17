<?php
class AutorMapper{
    public static function request2Autor($request){
        $values = $request->all();
        $autor = new stdClass();
        if(key_exists("id", $values)){
            $autor->id = $values["id"];
        }
        $autor->nombre = $values["nombre"];
        $autor->biografia = $values["biografia"];
        //Acá me complique un poco, pero bueno, para cargar la ruta en la que estará la foto le pongo de nombre su hash, ya que no puedo usar la id para nombrarlo si no se cargó todavía.
        if (isset($values['foto']) && $values['foto']['tmp_name']) {
            $fotoRutaTemporal = $values['foto']['tmp_name'];
            $archivoPortada = file_get_contents($fotoRutaTemporal);
            $hash = hash("sha256", $archivoPortada);
            $extension = pathinfo($values['foto']['name'], PATHINFO_EXTENSION);
            //TODO: hacer que la ruta donde se guardan las imagenes sea una global configurable
            $autor->ruta_de_imagen = "img/autores/" . $hash . "." . $extension;
        } else {
            $autor->ruta_de_imagen = "";
        }
        $autor->img = (file_exists($values['foto']['tmp_name'])) ? $values['foto'] : null; 
        return $autor;
    }
}
?>