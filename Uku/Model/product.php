<?php
    class Product{
        public $id;
        public $name;
        public $price;
        public $oldPrice;
        public $quantity;
        public $description;
        public $image;
        function __construct($id,$name,$price,$oldPrice,$quantity,$description,$image)
        {
            $this->id=$id;
            $this->name=$name;
            $this->quantity=$quantity;
            $this->price=$price;
            $this->oldPrice=$oldPrice;
            $this->description=$description;
            $this->image=$image;
        }
        
    }
?>
