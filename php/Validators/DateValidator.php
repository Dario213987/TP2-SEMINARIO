<?php
require_once "php/Validators/AbstractValidator.php";
class DateValidator extends AbstractValidator{
    private $dateFormat;
    public function validate($date){
        parent::validate($date);

        if(!$this->getError() && $this->dateFormat && $this->validDate($date)){
            $this->setError("date");
        }
    }

    public function dateFormat($dateFormat){
        $this->dateFormat = $dateFormat;
        return $this;
    }

    private function validDate($d){
        $date = DateTime::createFromFormat($this->dateFormat, $d);
        return $date && $date->format($this->dateFormat) === $d;
    }
}
?>