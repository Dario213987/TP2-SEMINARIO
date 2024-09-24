<?php
require_once "app/Requests/Request.php";
class CreateLibroRequest extends Request{
    public function rules(){
        return [
            "titulo"=> "required|maxlength:4"
        ];
    }
    public function messages(){
        return [
            "titulo.maxlength" => "El nombre de la obra es demasiado largo"
        ];
    }
}
?>