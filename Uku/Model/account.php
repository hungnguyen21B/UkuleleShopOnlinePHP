<?php
    class Account{
        public $id;
        public $username;
        public $password;
        public $phonenumber;
        public $role;
        function __construct($id,$username,$password,$phonenumber,$role){
            $this->id=$id;
            $this->username=$username;
            $this->password=$password;
            $this->phonenumber=$phonenumber;
            $this->role=$role;
        }
        function isRole(){
            return $this->role;
        }
        function checkComfirmPassword($password1,$password2) {
            return $password1==$password2;
        }
        function checkPhonenumber($phonenumber) {
            if (strlen($phonenumber)<10 || strlen($phonenumber)>20){
                return false;
            }else if (!is_numeric(substr($phonenumber,5,5))){
                return false;
            }
            return true;
        }
    }
?>
