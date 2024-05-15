<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';
$token = $_SESSION['token'];

 //print("<pre>".print_r(($_POST) ,true)."</pre>"); //die;


if ($_POST['mod'] == 1) {
  $accion = "Crear";
  if(isset($_POST['id'])){
    $idAprendiz=$_POST['id'];  //signifia que la creacion esta asociada a un aprendiz
  }
} else {
  $accion = "Editar";

  //datos Representante
  $idObjetivo = @$_POST["id"];

  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/objetivo?type=1&idObjetivoHeader=$idObjetivo";
  $rs         = API::GET($URL, $token);
  $arrayHeader  = API::JSON_TO_ARRAY($rs);
  print_r( $URL );
