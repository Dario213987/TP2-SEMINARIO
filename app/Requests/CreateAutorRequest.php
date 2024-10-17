<?php
require_once "app/Requests/AbstractRequest.php";
require_once "php/Validators/ImageValidator.php";
require_once "php/Validators/StringValidator.php";
class CreateAutorRequest extends AbstractRequest{
    public function rules(){
        return [
            "nombre" => [(new StringValidator())->required()->maxLength(64)],
            "biografia" => [(new StringValidator())->required()->maxLength(maxLength: 2000)],
            "foto" => [(new ImageValidator())->allowedExtensions(["png","jpg","webp","jpeg"])->maxSize(2)->maxHeight(1000)->maxWidth(1000)->minHeight(100)->minWidth(100)]
        ];
    }
    public function messages(){
        return [
            "nombre.maxlength" => "El nombre es demasiado largo.",
            "nombre.required" => "El nombre es un campo obligatorio.",
            "biografia.required" => "La biografía es un campo obligatorio.",
            "biografia.maxlength" => "La la biografía no puede exceder 2000 caracteres.",
            "foto.required" => "Seleccione la foto del autor.",
            "foto.invalidextension" => "La foto debe ser una imagen en formato PNG, JPG, WEBP o JPEG.",
            "foto.maxsize" => "La foto no puede exceder 2 MB.",
            "foto.maxheight" => "La foto es muy grande.",
            "foto.maxwidth" => "La foto es muy grande.",
            "foto.minheight" => "La foto es muy pequeña",
            "foto.minwidth" => "La foto es muy pequeña",
        ];
    }
    
}
?>