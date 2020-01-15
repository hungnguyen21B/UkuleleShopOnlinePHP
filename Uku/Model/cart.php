<?php
   class Cart{
    public $id;
    public $name;
    public $image;
    public $quantity;
    public $price;
    function __construct($id,$name,$price,$quantity,$image)
    {
        $this->id=$id;
        $this->name=$name;
        $this->quantity=$quantity;
        $this->price=$price;
        $this->image=$image;
    }
    function getTotalOnePro(){
        return $this->price*$this->quantity;
    }
    function getImage(){
        return "../../".$this->image;
    }
}
?>