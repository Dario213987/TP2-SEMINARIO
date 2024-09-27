<?php

abstract class AbstractValidator{
    private $error = null;
    private $required = false;
    function validate($value){
        if(!$this->getError() && $this->required && empty($value)){
            $this->setError("required");
            return;
        }
    }

    function required(){
        $this->required = true;
        return $this; 
    }

    function isRequired(){
        return $this->required;
    }
    function getError(){
        return $this->error;
    }
    function setError($error){
        $this->error = $error;
    }
}
?>