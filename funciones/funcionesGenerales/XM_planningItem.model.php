HOLA GAFO<!-- <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'> -->
<link rel="stylesheet" href='./plugins/fontawesome-free/css/all.css'>
<link rel="stylesheet" href='./plugins/sweetalert2/sweetalert2.min.css'>
<link rel="stylesheet" href='./plugins/toastr/toastr.min.css'>
<link rel="stylesheet" href='./plugins/toastr/toastr.min.js'>
<link rel="stylesheet" href='./dist/css/adminlte.min.css'>
<?php

if (!isset($_SESSION)) {
    session_start();
}
include_once('../../add/script.php');
require_once '../wsdl/clases/consumoApi.class.php';
require '../../vendor/autoload.php';

$token = $_SESSION['token'];
 $_POST['token'] = $_SESSION['token'];
 $_POST['creadoPor'] = $_SESSION['usuario'];

$URL = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/planningItem";

print("<pre>".print_r(($_POST),true)."</pre>");die;

$rs = API::POST($URL, $token, $_POST);
$rs = API::JSON_TO_ARRAY($rs);

// print("<pre>".print_r(($rs),true)."</pre>");die; die;
?>
<script>console.log('aqui');</script>