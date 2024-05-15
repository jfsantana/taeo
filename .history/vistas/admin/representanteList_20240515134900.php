<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';

//Listado Clientes
// demo
$id = @$_POST["id"];
$token = $_SESSION['token'];
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/representante?type=1";

$rs         = API::GET($URL, $token);
$arrayRepresentante  = API::JSON_TO_ARRAY($rs);

print("<pre>".print_r(($URL) ,true)."</pre>"); //die;

?>
