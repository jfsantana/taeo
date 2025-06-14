<?php

require_once 'clases/auth.class.php';
require_once 'clases/respuestas.class.php';

$_auth = new auth;
$_respuestas = new respuestas;

if ($_SERVER['REQUEST_METHOD'] == 'GET') { // Get READ
  if (isset($_GET['updateToken'])) {
    $listaclientes = $_auth->updateToken();
    header('Content-Type: application/json;charset=utf-8');
    http_response_code(200);
    echo json_encode($listaclientes);
    
  } else {
    http_response_code(200);
  }
} elseif ($_SERVER['REQUEST_METHOD']=="POST"){
  if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Postman') !== false) {
    $postBody = file_get_contents('php://input');
  } else {
      $postBody = json_encode($_POST);
  }

    $datosArray = $_auth->login($postBody);
    header('Content-Type: application/json;charset=utf-8');
    if(isset($datosArray["result"]["error_id"])){
        $responseCode =  $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    }else{
        http_response_code(200);
    }
    echo(json_encode($datosArray));
}else{
    header('Content-Type: application/json;charset=utf-8');
    $datosArray =$_respuestas->error_405();
    echo(json_encode($datosArray));
}
?>
