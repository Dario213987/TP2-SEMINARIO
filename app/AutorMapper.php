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
        /*
            Está parte del método verifica si se cargó una imagen y si se cargó calcula el hash de la misma.
            Con ese hash se calcula la ruta en la que se guardará la imagen en el servidor siendo esta: 
            {ruta asignada en el archivo de connfiguración} + {hash de la imagen} + "." + {extension del archivo cargado} 
        */
        if (isset($values['foto']) && $values['foto']['tmp_name']) {
            $fotoRutaTemporal = $values['foto']['tmp_name'];
            $archivoPortada = file_get_contents($fotoRutaTemporal);
            $hash = hash("sha256", $archivoPortada);
            $extension = pathinfo($values['foto']['name'], PATHINFO_EXTENSION);
            $autor->ruta_de_imagen = AUTORES_IMAGE_ROUTE . $hash . "." . $extension;
            $autor->img = $values['foto']; 
        } else {
            $autor->ruta_de_imagen = "";
        }
        return $autor;
    }
}
?>