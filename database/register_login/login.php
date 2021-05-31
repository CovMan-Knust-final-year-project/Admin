<?php
    // $response = '';
    session_start();
    require_once('../config.php');
    require_once('../../helpers/functions.php');

    if (isset($_POST["login_username"]) && isset($_POST["login_password"])) {

    $password = trim($_POST['login_password']);
    
    //status 1 means the person is active, 0 means the person is deleted
    $sql = "SELECT * FROM admin WHERE username = :username AND password = :password AND status = 1";
    $statement = $con->prepare($sql);
    $statement->execute(
        array(
        ':username' => trim($_POST['login_username']),
        ':password' => crypt($password, '$6$rounds=1000$ldfowetwnvmlope$')
        )
    );
    $count = $statement->rowCount();

    if ($count == 1) {

        $user = $statement->fetch();

        if ($user['status'] == 1) {
        $_SESSION['company_name']   = $user['company_name'];
        $_SESSION['id']             = $user['id'];
        $_SESSION['username']       = $user['username'];
        $_SESSION['phone_number']   = $user['phone_number'];
        //   header('Location: user_dashboard/dashboard.php');
        echo "1"; //successful
        // sendSms($user['phone_number'], 'Login attempt was noticed today at ' . date('Y-m-d H:i:s') . ". If this wasn't you contact customer care NOW on 0268977129 to rectify the issue. Thanks");
        } else {
            echo "2";// blocked account
        //   $response = '<div class="alert alert-danger text-center">You account has been blocked. Please contact support</div>';
        }
    } else {
        // $response = '<div class="alert alert-danger text-center">Incorrect username or password</div>';
        echo "0";//incorrect credentials
    }
    }
?>