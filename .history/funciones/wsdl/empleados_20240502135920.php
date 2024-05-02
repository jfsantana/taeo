<?php

// ARCHIVO BASE PARA LOS SERVICIOS
require_once 'clases/respuestas.class.php';
require_once 'clases/empleados.class.php';

$_respuestas = new respuestas();
$_empleados = new empleados();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    /*****!SECTION
   * type:
   * 1 listar todos los empleados, recibe el idUsuario (opcional) para busacr un usuario
   *
   */
  if (isset($_GET['token'])) { //TAEO LISTO
    $token = $_GET['token'];
    $datosEmpleado = $_empleados->obtenerEmpleadoToken($token);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }elseif($_GET['type']==1){
    $datosEmpleado = $_empleados->getEmpleado(@$_GET['idUsuario']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosEmpleado);
    http_response_code(200);
  }

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST CREATE
  //$postBody = file_get_contents('php://input'); // para el plug in de crome
  //$postBody = file_get_contents('php://input');
  //$postBody = json_encode($_POST);
  //13336768 ajuste para no cambiar las pruebas desde
  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_POST);
  }

  $datosArray = $_empleados->post($postBody);

    header('Content-Type: application/json;charset=utf-8');
  if (isset($datosArray['result']['error_id'])) {
    $responseCode = $datosArray['result']['error_id'];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }
  echo json_encode($datosArray);
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') { // PUT  UPDATER


} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') { // DELETE

} else {
  header('Content-Type: application/json;charset=utf-8');
  $datosArray = $_respuestas->error_405();
  echo json_encode($datosArray);
}
