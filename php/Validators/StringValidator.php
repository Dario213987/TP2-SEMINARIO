<?php
require_once "php/Validators/AbstractValidator.php";
class StringValidator extends AbstractValidator {
    private $minLength;
    private $maxLength;
    private $allowedValues;

    private $allowedLengths;

    public function validate($string){
        parent::validate($string);

        if(!empty($string)){

            if(!$this->getError() && $this->maxLength && strlen($string) > $this->maxLength){
                $this->setError("maxlength");
                return;
            }

            if(!$this->getError() && $this->minLength && strlen($string) < $this->minLength){
                $this->setError("minlength");
                return;
            }

            if(!$this->getError() && $this->allowedValues && !in_array($string, $this->allowedValues)){
                $this->setError("allowedvalues");
                return;
            }   

            if(!$this->getError() && $this->allowedLengths && !in_array(strlen($string), $this->allowedLengths)){
                $this->setError("allowedlengths");
                return;
            }   
        }

    }
    public function maxLength($maxLength){
        $this->maxLength = $maxLength;
        return $this;
    }
    public function minLength($minLength){
        $this->minLength = $minLength;
        return $this;
    }

    public function allowedLengths($allowedLengths){
        $this->allowedLengths = $allowedLengths;
        return $this;
    }

    public function allowedValues($valueArray){
        $this->allowedValues = $valueArray;
        return $this;
    }
}
?>