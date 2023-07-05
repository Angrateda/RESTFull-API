<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('api/Rest.php');
$api = new Rest();
switch ($requestMethod) {
    case 'GET':
        $psnId = '';
        if (isset($_GET['id'])) { // Periksa apakah kunci "id" ada dalam array $_GET
            $psnId = $_GET['id'];
        }
        $api->getPasien($psnId);
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;  
}
?>
