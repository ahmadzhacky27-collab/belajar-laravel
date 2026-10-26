<!-- 
    '':
    "":
    ``:
-->
<?php
$nama = "Bamb Ang";
$namaLengkap = "Bamb Ang Pamungkas";
echo 'Nama anda adalah $nama';
echo '<br>';
echo "Nama anda adalah $nama";
echo '<br>';
echo '""';
echo '<br>';

// strlen()
echo "Panjang String: " . strlen($nama);
echo '<br>';
// substr :
echo substr($nama, 0, 5);
echo '<br>';
echo str_replace($namaLengkap, "Ang", "Duarr");
?>