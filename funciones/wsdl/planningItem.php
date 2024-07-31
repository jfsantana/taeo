<?php

// ARCHIVO BASE PARA LOS SERVICIOS
require_once 'clases/respuestas.class.php';
require_once 'clases/planningItems.class.php';

$_respuestas = new respuestas();
$_objetivoItems = new planningItems();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    /*****!SECTION
   * type:
   * 1 listar detalle de un  idPlanificacionHeader
   *  2 indica si ya exite el padre para una planificacion especifica
   */
  if ($_GET['type']==1){
    $datosArray = $_objetivoItems->getDetailItemsObjetyivo(@$_GET['idPlanificacionHeader']);
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
    http_response_code(200);
  }elseif($_GET['type']==2){
    $datosArray = $_objetivoItems->getExistePadre(@$_GET['idPlanificacion'], @$_GET['nivelPadre'] , @$_GET['idNivel']   );
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($datosArray);
    http_response_code(200);
  }

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // POST CREATE

  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_POST);
  }

  $datosArray = $_objetivoItems->post($postBody);

    header('Content-Type: application/json;charset=utf-8');
  if (isset($datosArray['result']['error_id'])) {
    $responseCode = $datosArray['result']['error_id'];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }
  echo json_encode($datosArray);
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') { // PUT  UPDATER

  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_PUT);
  }

  //$datosArray = $_objetivoItems->put($postBody);

    header('Content-Type: application/json;charset=utf-8');
  if (isset($datosArray['result']['error_id'])) {
    $responseCode = $datosArray['result']['error_id'];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }
  echo json_encode($datosArray);

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') { // DELETE

  //$datosArray = $_objetivoItems->del($_GET['idHeader'],$_GET['versionObjetivo']);

    header('Content-Type: application/json;charset=utf-8');
  if (isset($datosArray['result']['error_id'])) {
    $responseCode = $datosArray['result']['error_id'];
    http_response_code($responseCode);
  } else {
    http_response_code(200);
  }
  echo json_encode($datosArray);

} else {
  header('Content-Type: application/json;charset=utf-8');
  $datosArray = $_respuestas->error_405();
  echo json_encode($datosArray);
}
