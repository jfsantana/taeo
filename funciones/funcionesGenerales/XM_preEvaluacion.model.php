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


print("<pre>".print_r((json_encode($_POST)),true)."</pre>"); //die;
?><script> console.log("<?php echo json_encode($_POST)?>")</script><?php

if (@$_POST['idNivelEvaluacion'] == '') {
    $continuidadAlmacenamientoidNivelEvaluacion = @$_POST['idNivelEvaluacion'];
}

if (@$_POST['idHeaderEvaluacionAnterior'] != '') {
    $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=1&idHeaderEvaluacion=".$_POST['idHeaderEvaluacionAnterior'];
    $rs         = API::GET($URL, $token);
    $arrayPreEvaluacion  = API::JSON_TO_ARRAY($rs);
    $_POST['fechaUltimaEvaluacion'] =$arrayPreEvaluacion[0]['fechaEvaluacion'] ;
}

$URL = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion";
?> <script>console.log(<?php echo $URL?>)</script><?php
//print("<pre>".print_r(($URL),true)."</pre>");die;
$rs = API::POST($URL, $token, $_POST);
$rs = API::JSON_TO_ARRAY($rs);

?><script> console.log("<?php echo json_encode($rs)?>")</script><?php
//print("<pre>".print_r(json_encode($rs),true)."</pre>");die;


$idEvaluacion= $_POST['idHeaderEvaluacion'];
$aux1=@$_POST['idNivelEvaluacion'];
$aux2=@$_POST['edadCronologica'];
$aux3=@$_POST['idAreaEvaluacion'];

$idHeaderNew = @$rs['result']['idHeaderNew'];

if (@$rs['status'] == 'OK') {
    if(@$aux1 != ''){
        $url = "onclick=\"enviarParametrosEvaluacion('preEvaluacion/preEvaluacionCreate.php','2', $idHeaderNew,$aux1, $aux2 , $aux3)\"";
    }else{
        $url = "onclick=\"enviarParametrosGetsionUpdate2('preEvaluacion/preEvaluacionCreate.php','2', $idHeaderNew)\"";
    }    
} else {
    $url = "onclick=\"enviarParametrosCRUD('objetivo/objetivoCreate.php','1')\"";
}?>

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
                    echo 'Error';
                } ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo @$rs['result']['MSG']; ?></p>
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
