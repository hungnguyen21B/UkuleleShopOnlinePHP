<?php
    class ProductAdmin extends Product{
        public $type;
        function __construct($id,$name,$price,$oldPrice,$quantity,$description,$image,$type)
        {
            parent::__construct($id,$name,$price,$oldPrice,$quantity,$description,$image);
            $this->type=$type;
        }
        function getImageAdmin(){
            return "../../".$this->image;
        }
    }
?>
