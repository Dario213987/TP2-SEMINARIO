<?php
abstract class AbstractRequest{
    private $errorMessages;
    private $fields;
    private $fileFields;
    private $data;

    function __construct($fields, $fileFields){
        foreach($fields as $field){
            $this->data[$field] = $_REQUEST[$field];
        }
        foreach($fileFields as $fileField){
            $this->data[$fileField] = $_FILES[$fileField];
        }
        $this->validate();
    }
    public function getErrorMessages(){
        return $this->errorMessages;
    }
    public function validate(){
        foreach($this->rules() as $field => $rules){
            foreach($rules as $rule){
                $rule->validate($this->data[$field]);
                if($rule->getError()){
                    $this->errorMessages[$field] = $this->messages()[$field.".".$rule->getError()] ;
                }
            }
        }
    }
    public function hasErrors(){
        return !empty($this->errorMessages);
    }
    public function all(){
        return $this->data;
    }
    public abstract function rules();
    public abstract function messages();
}
?>