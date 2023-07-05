<?php
function curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
// alamat localhost untuk file getWisata.php, ambil hasil export JSON
$send = curl("http://localhost/json/getPasien.php");
// mengubah JSON menjadi array
$data = json_decode($send, TRUE);
foreach ($data as $row) {
    echo $row["id_pasien"] . "<br/>";
    echo $row["nama"] . "<br/>";
    echo $row["lahir"] . "<br/>";
    echo $row["penyakit"] . "<br/>";
    echo $row["goldarah"] . "<br/>";
    echo $row["biaya"] . "<br/><hr/>";
}
?>