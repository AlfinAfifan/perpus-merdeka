<?php

require 'functions.php';

$databuku = query("SELECT * FROM databuku");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach($databuku as $buku) : ?>
    <h1>Detail Buku "<?= $buku["Title"] ?>" </h1>
    <ul>
        <li>ID : <?= $buku["ID"]; ?> </li>
        <li>Title : <?= $buku["Title"]; ?> </li>
        <li>Author : <?= $buku["Author"]; ?> </li>
        <li>Publisher : <?= $buku["Publisher"]; ?> </li>
        <li>Category : <?= $buku["Category"]; ?> </li>
        <li>Year : <?= $buku["Year"]; ?> </li>
        <li>Status : <?= $buku["Status"]; ?> </li>
        <li>Type : <?= $buku["Type"]; ?> </li>
        <li>Condition : <?= $buku["Condition"]; ?> </li>
    </ul>
    <?php endforeach ?>
</body>
</html>