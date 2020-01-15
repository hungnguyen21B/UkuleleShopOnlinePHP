<?php

function checkLogin($username, $password)
{
    global $db;
    $sql = "select * from account where username = '" . $username . "' and password ='" . $password . "';";
    $result = $db->query($sql)->fetch_all();
    if (count($result) > 0) {
        $acc = new Account($result[0][0], $result[0][1], $result[0][2], $result[0][3], $result[0][4]);
        if ($acc->isRole()) {
            header('Location: ../View/Admin/adminForm.php');
        } else {
            $_SESSION['check-login'] = true;
            $_SESSION['id-account-login'] = $acc->id;
            header('Location: ../index.php');
        }
    }
}
function checkRegister($username, $password1, $password2, $phonenumber)
{
    global $db;
    $sql = "select * from account where username ='" . $username . "';";
    $checkUsername = $db->query($sql)->fetch_all();
    $acc = new Account($checkUsername[0][0], $checkUsername[0][1], $checkUsername[0][2], $checkUsername[0][3], $checkUsername[0][4]);
    if ($acc->username != null || !$acc->checkPhonenumber($phonenumber) || !$acc->checkComfirmPassword($password1, $password2)) {
        header('Location: ../View/Cus/registerForm.php');
    } else {
        $sql = "insert into account(username,password,phonenumber) values ('" . $username . "','" . $password1 . "','" . $phonenumber . "');";
        $db->query($sql);
        // echo "<script>alert('Let log-in now.');</script>";
        header('Location: ../View/loginForm.php');
    }
}
