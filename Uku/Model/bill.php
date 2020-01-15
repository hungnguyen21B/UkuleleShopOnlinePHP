<?php
    class Bill{
        public $phone;
        public $name;
        public $payment;
        public $address;
        public $comment;
        public $listSp;
        public $idAccount;
        // function __construct($name,$payment,$phone,$address,$comment,$listSp,$idAccount)
        // {
        //     $this->payment=$payment;
        //     $this->name=$name;
        //     $this->address=$address;
        //     $this->phone=$phone;
        //     $this->comment=$comment;
        //     $this->comment=$comment;
        //     $this->listSp=$listSp;
        //     $this->idAccount=$idAccount;
        // }
        function setPhone($phone){
            if(strlen($phone)<10 || strlen($phone)>20 || !is_numeric(substr($phone,5,5))){
                $this->phone=null ;
            }else{
                $this->phone=$phone;
            }
        }
        function setAddress($address){
            if(strlen($address)<10){
                $this->address=null ;
            }else{
                $this->address=$address;
            }
        }
        function setListSp($listSp){
                $this->listSp=$listSp;
            }
        

    }
?>