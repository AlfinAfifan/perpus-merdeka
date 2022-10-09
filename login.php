<?php

session_start();

if( isset($_SESSION["login"]) ) {
    header("location: redirect.php");
    exit;
}

require 'functions.php';

if( isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    $result = mysqli_query($conn, "SELECT * FROM datauser WHERE Name = '$username' AND Password = '$pwd'");

    // Cek username
    if( mysqli_num_rows($result) === 1 ) {

        $_SESSION["login"] = true;
        
        $data = mysqli_fetch_assoc($result);
        if( $data["UserID"] == 1 ) {
            header("location: index.php");
            exit;
        } 
        header("location: user.php");
        exit;
    }
    
    $error = true;
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Perpustakaan</title>
    <link rel="stylesheet" href="stylelogin.css?<?= time(); ?>">
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h1>Login Here</h1>
            <?php if( isset($error) ) : ?>
                <p class="error">Username / Password Salah</p>
            <?php endif; ?>    
            <input type="text" name="username" placeholder="Enter Your Username"> 
            <input type="password" name="pwd" placeholder="Enter Your Password"> 
            <button type="submit" name="login">Login</button>
            <p class="first">Don't have an account?</p>
            <p class="second"><a href="#">Sign up</a> here</p>
        </form>
    </div>
</body>
</html>