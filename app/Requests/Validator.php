<?php
class Validator{
    private $data;
    private $rules;

    private $errors;
    function __construct($data, $rules){
        $this->rules = $rules;
        $this->data = $data;
        $this->errors = [];
        $this->validate();
    }

    function validate(){
        foreach($this->rules as $field => $rules){
            $rulesArray = explode("|", $rules);
            foreach($rulesArray as $rule){
                if(strpos($rule, ":") !== false){
                    list($ruleName, $ruleValue) = explode(":", $rule);
                }else{
                    $ruleName = $rule;
                    $ruleValue = null;
                }
                $this->applyRule($field, $ruleName, $ruleValue);
            }
        }
    }

    function applyRule($field, $ruleName, $ruleValue){
        switch($ruleName){
            case "required":
                if(empty($this->data[$field])){
                    $this->errors[] = $field.".".$ruleName;     
                }
                break;
            case "number":
                if(!is_numeric($this->data[$field])){
                    $this->errors[] = $field.".".$ruleName;     
                }
                break;
            case "maxlength":
                if(strlen($this->data[$field])>=$ruleValue){
                    $this->errors[] = $field.".".$ruleName;     
                }
                break;
            case "max":
                if($this->data[$field]>$ruleValue){
                    $this->errors[] = $field.".".$ruleName;     
                }
                break;
            case "min":
                if($this->data[$field]<$ruleValue){
                    $this->errors[] = $field.".".$ruleName;     
                }
                break;
            case "value_in":
                $allowedValues = explode(",", $ruleValue);
                if(!in_array($this->data[$field],$allowedValues)){
                    $this->errors[] = $field.".".$ruleName;
                }
                break;
        }
    }

    public function getErrors(){
        return $this->errors;
    }
}
?>