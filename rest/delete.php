<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('api/Rest.php');
$api = new Rest();
switch ($requestMethod) {
    case 'GET':
        $psnId = '';
        if ($_GET['id']) {
            $psnId = $_GET['id'];
        }
        $api->deletePasien($psnId);
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
?>