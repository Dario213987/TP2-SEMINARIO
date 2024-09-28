<?php
require_once "app/Requests/AbstractRequest.php";
require_once "php/Validators/ImageValidator.php";
require_once "php/Validators/NumberValidator.php";
require_once "php/Validators/StringValidator.php";
require_once "php/Validators/DateValidator.php";
class CreateLibroRequest extends AbstractRequest{
    public function rules(){
        return [
            "titulo" => [(new StringValidator())->required()->maxLength(12)],
            "autor" => [(new NumberValidator())->required()],
            "fecha_de_publicacion" => [(new DateValidator())->required()->dateFormat("Y-m-d")],
            "editorial" => [(new StringValidator())->maxLength(32)],
            "isbn" => [(new StringValidator())->required()->allowedLengths([10, 13]), 
                (new NumberValidator())],
            "idioma" => [(new NumberValidator())->required()],
            "alto" => [(new NumberValidator())->required()->min(1)->max(4000)],
            "ancho" => [(new NumberValidator())->required()->min(1)->max(4000)],
            "grosor" => [(new NumberValidator())->required()->min(1)->max(4000)],
            "peso" => [(new NumberValidator())->required()->min(1)->max(10000)],
            "encuadernado" => [(new StringValidator())->required()->allowedValues(["Tapa dura", "Tapa blanda"])],
            "sinopsis" => [(new StringValidator())->required()->maxLength(maxLength: 2000)],
            "portada" => [(new ImageValidator())->allowedExtensions([".png",".jpg",".webp",".jpeg"])->maxSize(2)->maxHeight(1426)->maxWidth(1000)->minHeight(100)->minWidth(100)]
        ];
    }
    public function messages(){
        return [
            "titulo.maxlength" => "El nombre de la obra es demasiado largo.",
            "titulo.required" => "El título es un campo obligatorio.",
            "autor.required" => "El autor es un campo obligatorio.",
            "isbn.required" => "El ISBN es obligatorio.",
            "isbn.allowedlengths" => "El ISBN debe tener 10 o 13 caracteres.",
            "isbn.number" => "El ISBN debe de estar compuesto solo por números",
            "idioma.required" => "El idioma es un campo obligatorio.",
            "alto.required" => "La altura es un campo obligatorio.",
            "alto.min" => "La altura debe ser al menos 1mm.",
            "alto.max" => "La altura no puede exceder 4000mm.",
            "ancho.required" => "El ancho es un campo obligatorio.",
            "ancho.min" => "El ancho debe ser al menos 1mm.",
            "ancho.max" => "El ancho no puede exceder 4000mm.",
            "grosor.required" => "El grosor es un campo obligatorio.",
            "grosor.min" => "El grosor debe ser al menos 1mm.",
            "grosor.max" => "El grosor no puede exceder 4000mm.",
            "peso.required" => "El peso es un campo obligatorio.",
            "peso.min" => "El peso debe ser al menos 1g.",
            "peso.max" => "El peso no puede exceder 10000g.",
            "encuadernado.required" => "El tipo de encuadernado es obligatorio.",
            "encuadernado.allowedvalues" => "El encuadernado debe ser 'Tapa dura' o 'Tapa blanda'.",
            "sinopsis.required" => "La sinopsis es un campo obligatorio.",
            "sinopsis.maxlength" => "La sinopsis no puede exceder 2000 caracteres.",
            "portada.required" => "Seleccione la portada del libro.",
            "portada.invalidextension" => "La portada debe ser una imagen en formato PNG, JPG, WEBP o JPEG.",
            "portada.maxsize" => "La portada no puede exceder 2 MB.",
            "portada.maxheight" => "La portada es muy grande.",
            "portada.maxwidth" => "La portada es muy grande.",
            "portada.minheight" => "La portada es muy pequeña",
            "portada.minwidth" => "La portada es muy pequeña",
            "fecha_de_publicacion.required" => "La fecha de publicación es obligatoria",
            "fecha_de_publicacion.date" => "Formato de fecha incorrecto",
        ];
    }
    
}
?>