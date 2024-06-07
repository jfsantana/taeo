<?php
// fetch_niveles.php
echo 'entro'; die;
// Incluye aquí la lógica para conectar a la base de datos
$token = $_SESSION['token'];
$URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/nivelArea?type=2&idAreaObjetivo=$idAreaObjetivo";
$rs         = API::GET($URL1, $token);
$arrayNivelAreaObjetivo  = API::JSON_TO_ARRAY($rs);
?>
