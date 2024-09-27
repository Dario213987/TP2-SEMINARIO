<?php
require_once "php/Validators/AbstractValidator.php";
class FileValidator extends AbstractValidator{
    private $minSize;
    private $maxSize;
    private $allowedMIMEtypes;
    private $allowedExtensions;

    public function validate($file){
        parent::validate($file);

        if(file_exists($file["tmp_name"])){
    
            if(!$this->getError() && $this->minSize && $file["size"] < $this->minSize){
                $this->setError("minsize");
                return;
            }
    
            if(!$this->getError() && $this->maxSize && $file["size"] > $this->maxSize){
                $this->setError("maxsize");
                return;
            }
    
            if (!$this->getError() && $this->allowedMIMEtypes && !in_array(mime_content_type($file['tmp_name']), $this->allowedMIMEtypes)) {
                $this->setError("invalidmime");
                return;
            }
    
            if (!$this->getError() && $this->allowedExtensions && !in_array(pathinfo($file['name'], PATHINFO_EXTENSION), $this->allowedExtensions)) {
                $this->setError("invalidextension");
                return;
            }
        }elseif($this->isRequired()){
            $this->setError(error: "required");
            return;
        }
        



    }

    public function minSize($MB){
        $this->minSize = $MB * 1024 * 1024;
        return $this;
    }

    public function maxSize($MB){
        $this->maxSize = $MB * 1024 * 1024;
        return $this;
    }

    public function allowedMIMEtypes($MIMEtypes){
        $this->allowedMIMEtypes = $MIMEtypes;
        return $this;
    }

    public function allowedExtensions($fileExtensions){
        $this->allowedExtensions = $fileExtensions;
        return $this;
    }
}
?>