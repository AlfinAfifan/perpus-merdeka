<?php

session_start();
if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'functions.php';

// Ambil data dari tabel
$alluser = query("SELECT * FROM datauser");

// Cek tombol simpan
if( isset($_POST["simpan"]) ) {
    // Cek edit / tambah
    if( $_GET['hal'] == "edit" ) {
        if( edit($_POST) > 0 ) {
            echo "
            <script>
                alert('Data Berhasil Diedit');
                document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Data Gagal Diedit');
                document.location.href = 'index.php';
            </script>
            ";
        }
    } else {
        if( tambah($_POST) > 0 ) {
            echo "
            <script>
                alert('Data Berhasil Ditambahkan');
                document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Data Gagal Ditambahkan');
                document.location.href = 'index.php';
            </script>
            ";
        }
        
    }
    
}


//  Tombol edit
if( isset($_GET['hal']) ) {
    $id = $_GET["UserID"];
    if( $_GET['hal'] == "edit" ) {
        // Tampilkan data
        $isiedit = mysqli_query($conn, "SELECT * FROM datauser WHERE UserID = $id");
        $dataEdit = mysqli_fetch_assoc($isiedit);   
        $user = query("SELECT * FROM datauser WHERE UserID = $id") [0]; 
    }
}


// Tombol hapus
if( isset($_GET['hal']) ) {
    if( $_GET['hal'] == "hapus" ) {
        global $id;
        if( hapus($id) > 0 ) {
            echo "
                <script>
                    alert('Data Berhasil Dihapus');
                    document.location.href = 'index.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Data Gagal Dihapus');
                    document.location.href = 'index.php';
                </script>
                ";
            }
    }
}


// Tombol search
if( isset($_POST['cari']) ) {
    $alluser = cari($_POST['keywoard']);
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pustakawan</title>
    <link rel="stylesheet" href="style.css?<?= time(); ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="container" id="beranda">
        <nav>
            <div class="expand">
                <div class="title">
                    <span class="material-icons tombol">menu</span>
                    <h2 class="tombol">Admin Perpus</h2>
                </div>
                    <ul>
                        <li>
                            <a href="index.php" class="tombol">
                                <span class="material-icons tombol">home</span>
                                <span class="tombol">Beranda</span>
                            </a>
                        </li>
                        <li>
                            <a href="#form" class="tombol">
                                <span class="material-icons tombol">post_add</span>
                                <span class="tombol">Tambah Data</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tabel" class="tombol">
                                <span class="material-icons tombol">description</span>
                                <span class="tombol">Tabel User</span>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php" class="tombol">
                                <span class="material-icons tombol">logout</span>
                                <span class="tombol">Logout</span>
                            </a>
                        </li>
                    </ul>
            </div>
            <div class="menu">
                <div class="kiri">
                    <span class="material-icons toggle" id="toggle">menu</span>
                    <div class="judul" id="judul">Admin Perpus</div>
                </div>
                <div class="kanan">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </nav>

        <div class="content">

            <form action="" method="post" id="form">
                <header>
                    <span class="material-icons">post_add</span>
                    <h2>Tambah / Edit User</h2>
                </header>
                
                <ul>
                    <li>
                        <label for="userid">User ID</label>
                        <input type="number" name="userid" id="userid" required value="<?= @$user['UserID']; ?>" autocomplete="off" placeholder="Masukkan User ID">
                    </li>
                    <li>
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" required value ="<?= @$user['Name']; ?>" autocomplete="off" placeholder="Masukkan username">
                    </li>
                    <li>
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" required value ="<?= @$user['Password']; ?>" autocomplete="off" placeholder="Masukkan password">
                    </li>
                    <li>
                        <label for="status">Status</label>
                        <input type="text" name="status" id="status" required value ="<?= @$user['Status']; ?>" autocomplete="off" placeholder="Masukkan status">
                    </li>
                    <li>
                        <div class="kosong"></div>
                        <div class="tombol">
                            <button type="reset" name="reset">Bersihkan</button>
                            <button type="submit" name="simpan">Simpan</button>
                        </div>
                    </li>
                </ul>
            </form>

            <div class="tabelMhs" id="tabel">
                <table>
                    <div class="tabhead">
                        <span class="material-icons">description</span>
                        <h2>Tabel User</h2>
                        <div class="search">
                            <form action="index.php#tabel" method="post">
                                <input type="text" name="keywoard" id="keywoard" placeholder="Masukkan kata kunci">
                                <button type="submit" name="cari">Cari</button>
                            </form>
                        </div>
                    </div>
                    <tr>
                        <th>No</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Password</th>
                        <th>Status</Kbd></th>
                        <th>Aksi</th>
                    </tr>

                    <?php $i = 1 ?>
                    <?php $nomor = 1 ?>
                    <?php foreach( $alluser as $user ) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $user['UserID']; ?></td>
                        <td><?= $user['Name']; ?></td>
                        <td><?= $user['Password']; ?></td>
                        <td><?= $user['Status']; ?></td>
                        <td>
                            <a class="edit" href="index.php?hal=edit&UserID=<?= $user['UserID']?>">Edit</a>
                            <a class="hapus" href="index.php?hal=hapus&UserID=<?= $user['UserID']?>" onclick="return confirm('Apakah anda ingin menghapus data mahasiswa nomor <?= $nomor++ ?>?');">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </table>
            </div>
            
        </div>
    </div>

    <script src="script2.js"></script>
</body>
</html>