<!-- <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'> -->
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


//print("<pre>".print_r(json_encode($_POST),true)."</pre>"); die;

$URL = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/planning";
$rs = API::POST($URL, $token, $_POST);
$rs = API::JSON_TO_ARRAY($rs);

//print("<pre>".print_r(json_encode($rs),true)."</pre>");die;


//onclick="enviarParametros('admin/clienteList.php')"
$idHeaderNew = @$rs['result']['idHeaderNew'];
$mensaje = @$rs['result']['mensaje'];

if (@$rs['status'] == 'OK') {
  //id= 2 es por que se creo correctamente debe precargar y cargar el modal
    $url = "onclick=\"enviarParametrosGetsionUpdate2('planning/planningCreate.php','2', $idHeaderNew)\"";
} else {
    $url = "onclick=\"enviarParametrosCRUD('planning/planningCreate.php','1')\"";
}

?>

<div class="modal fade" id="modal-success">
    <div class="modal-dialog">
        <div class="modal-content <?php if (@$rs['status'] == 'OK') {
            echo 'bg-success';
        } else {
            echo 'bg-danger';
        } ?>">
            <div class="modal-header">
                <h4 class="modal-title"><?php if (@$rs['status'] == 'OK') {
                    echo 'Se Actualizo Correctamente con Exito.';
                } else {
                    echo $mensaje;
                } ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo @$rs['result']['mensaje']; ?></p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" <?php echo @$url; ?>>Close</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="./plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="./plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>

<script>
    $(document).ready(function() {
        $('#modal-success').modal('toggle')
    });
</script>
