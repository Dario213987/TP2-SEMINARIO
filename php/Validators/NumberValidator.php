<?php
require_once "php/Validators/AbstractValidator.php";
class NumberValidator extends AbstractValidator{
    private $max;
    private $min;

    public function validate($number){
        parent::validate($number);

        if(!empty($number)){

            if(!$this->getError() && !is_numeric($number)){
                $this->setError(error: "numeric");
                return;
            }

            if(!$this->getError() && $this->max && $number > $this->max){
                $this->setError("max");
                return;
            }

            if(!$this->getError() && $this->min && $number < $this->min){
                $this->setError("min");
                return;
            }    
        }
            
    }
    public function max($max){
        $this->max = $max;
        return $this;
    }

    public function min($min){
        $this->min = $min;
        return $this;
    }
}
?>