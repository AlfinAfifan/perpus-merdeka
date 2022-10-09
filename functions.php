<?php
// Konek ke database
$conn = mysqli_connect('localhost', 'root', '', 'dbperpus');

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $conn;
    // Ambil data dari tiap elemen
    $userid = htmlspecialchars($data["userid"]);
    $name = htmlspecialchars($data["name"]);
    $password = htmlspecialchars($data["password"]);
    $status = htmlspecialchars($data["status"]);

    // insert data
    $query = "INSERT INTO datauser VALUES
    ('$userid', '$name', '$password', '$status')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function edit($edit) {
    global $conn;
    // Ambil data dari tiap elemen
    $eid = $edit["userid"];
    $userid = htmlspecialchars($edit["userid"]);
    $name = htmlspecialchars($edit["name"]);
    $password = htmlspecialchars($edit["password"]);
    $status = htmlspecialchars($edit["status"]);

    // insert data
    $query = "UPDATE datauser SET
            UserID = '$userid',
            Name = '$name',
            Password = '$password',
            Status = '$status'
            WHERE UserID = $eid
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM datauser WHERE UserID = $id");

    return mysqli_affected_rows($conn);
}

function cari($keywoard) {
    $query = "SELECT * FROM datauser WHERE
            userid LIKE '%$keywoard%' OR
            name LIKE '%$keywoard%' OR
            password LIKE '%$keywoard%' OR
            status LIKE '%$keywoard%'
            ";
    return query($query);
}

function caribuku($keywoard) {
    $query = "SELECT * FROM databuku WHERE
            id LIKE '%$keywoard%' OR
            title LIKE '%$keywoard%' OR
            author LIKE '%$keywoard%' OR
            publisher LIKE '%$keywoard%' OR
            category LIKE '%$keywoard%' OR
            type LIKE '%$keywoard%' OR
            status LIKE '%$keywoard%'
            ";
    return query($query);
}


?>