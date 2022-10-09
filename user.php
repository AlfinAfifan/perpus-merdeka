<?php

session_start();
if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'functions.php';
$databuku = query("SELECT * FROM databuku");

if( isset($_POST['caribuku']) ) {
    $databuku = caribuku($_POST['keywoard']);
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

        <div class="content">
            <div class="tabelMhs" id="tabel">
                <table>
                    <div class="tabhead">
                        <span class="material-icons">description</span>
                        <h2>Daftar Buku</h2>
                        <div class="search">
                            <form action="user.php" method="post">
                                <input type="text" name="keywoard" id="keywoard" placeholder="Masukkan kata kunci">
                                <button type="submit" name="caribuku">Cari</button>
                            </form>
                        </div>
                    </div>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>

                    <?php foreach( $databuku as $buku ) : ?>
                    <tr>
                        <td><?= $buku['ID']; ?></td>
                        <td><?= $buku['Title']; ?></td>
                        <td><?= $buku['Author']; ?></td>
                        <td><?= $buku['Publisher']; ?></td>
                        <td><?= $buku['Category']; ?></td>
                        <td><?= $buku['Status']; ?></td>
                        <td>
                            <a class="edit" href="detail.php?hal=detail&ID=<?= $buku['ID']?>">Lihat</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </table>
            </div>
            
        </div>
    </div>

</body>
</html>