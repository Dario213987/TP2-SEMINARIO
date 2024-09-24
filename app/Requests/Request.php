<?php
require_once "app/Requests/Validator.php";
abstract class Request{
    private $validator;
    private $fields;

    public function __construct($fields){
        $this->fields = $fields;
        $this->validator = new Validator($_REQUEST ,$this->rules());
    }
    public function getErrorMessages(){
        $values = [];
        foreach($this->validator->getErrors() as $error){
            $key = explode(".", $error)[0];
            if(!key_exists($key , $values)){
                $values[$key]=$this->messages()[$error];
            }
        }
        return $values;
    }

    public function hasErrors(){
        return !empty($this->validator->getErrors());
    }
    public function all(){
        return array_map(function($key){return $_REQUEST[$key];}, $this->fields);
    }
    public abstract function rules();
    public abstract function messages();
}
?>