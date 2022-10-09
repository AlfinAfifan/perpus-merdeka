<?php

session_start();
if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Merdeka</title>
    <link rel="stylesheet" href="styleuser.css?<?= time(); ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="container" id="beranda">
        <nav>
            <div class="menu">
                <div class="kiri">
                    <div class="judul" id="judul">Perpustakaan Merdeka</div>
                </div>
                <div class="kanan">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </nav>

        <div class="content-logout">
            <h1 class="logout">Klik Tombol <a href="logout.php">Logout</a> </h1>
        </div>
    </div>

</body>
</html>