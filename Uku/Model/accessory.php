<?php
    class Accessory extends Product{
        function __construct($id,$name,$price,$oldPrice,$quantity,$description,$image)
        {
            parent :: __construct($id,$name,$price,$oldPrice,$quantity,$description,$image);
        }
    }
?>