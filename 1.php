<?php

// variable = type data
$name = "Kurniawan";
$umur = 40;
$phone = "082122232425";
$berat = 70.50;
$isActive = true;
// echo "Nama : " . $name . "<br>";
// echo "Umur : " . $umur . "<br>";

define("DB_HOST", "localhost");
define("DB_NAME", "db_pos");
const APP_DEBUG = true;

echo "HOST :" . DB_HOST . "<br>";
echo "DB_NAME :" . DB_NAME . "<br>";
echo "Mode Production :" . APP_DEBUG . "<br>";

// __DIR__
echo "Folder :" . __DIR__
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Nama Siswa</h1>
    <p>Nama : <?php echo $name ?> </p>
    <p>Umur : <?php echo $umur ?> </p>
    <p>Telepon : <?php echo $phone ?> </p>
    <p>Berat Badan : <?php echo $berat ?> </p>
</body>
</html>