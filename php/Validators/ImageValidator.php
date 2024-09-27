<?php
require_once "php/Validators/FileValidator.php";
class ImageValidator extends FileValidator{
    private $maxHeight;
    private $maxWidth;
    private $minHeight;
    private $minWidth;

    public function validate($picture){
        parent::validate(file: $picture);
        if(!empty($picture['tmp_name'])){

        list($width, $height) = getimagesize($picture['tmp_name']);
        if(!$this->getError() && $picture && !str_starts_with(mime_content_type($picture['tmp_name']), "image/")){
            $this->setError("image");
            return;
        }

        if(!$this->getError() && $this->maxHeight && $this->maxHeight < $height){
            $this->setError("maxheight");
            return;
        }

        if(!$this->getError() && $this->maxWidth && $this->maxWidth < $width){
            $this->setError("maxwidth");
            return;
        }

        if(!$this->getError() && $this->minHeight && $this->minHeight > $height){
            $this->setError("minheight");
            return;
        }

        if(!$this->getError() && $this->minWidth && $this->minWidth > $width){
            $this->setError("minwidth");
            return;
        }


        }
    }

    public function maxHeight($maxHeight){
        $this->maxHeight = $maxHeight;
        return $this;
    }

    public function maxWidth($maxWidth){
        $this->maxWidth = $maxWidth;
        return $this;
    }

    public function minHeight($minHeight){
        $this->minHeight = $minHeight;
        return $this;
    }

    public function minWidth($minWidth){
        $this->minWidth = $minWidth;
        return $this;
    }
}
?>