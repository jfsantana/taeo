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

$token = $_SESSION['token'];
$_POST['token'] = $_SESSION['token'];
$_POST['creador'] = $_SESSION['usuario'];


//print("<pre>".print_r(($_POST),true)."</pre>"); 

$request=array();

$request['idEvento']=@$_POST['idEvento'];
$request['nombreEvento']=@$_POST['nombreEvento'];
$request['idSede']=@$_POST['idSede'];
$request['descripcionEvento']=@$_POST['descripcionEvento'];
$request['lugarEvento']=@$_POST['lugarEvento'];
$request['fechaEvento']=@$_POST['fechaEvento'];
$request['envioCorreo']=@$_POST['envioCorreo'];
$request['tipoEvento']=@$_POST['tipoEvento'];
$request['fechaCreacion']=date('Y-m-d H:i:s');
$request['activo']=@$_POST['activo'];
$request['creadoPor']=@$_SESSION['usuario'];
$request['organizadoPor']=@$_POST['organizadoPor'];
$request['ponentes']=@$_POST['ponentes'];
$request['mod']=@$_POST['mod'];
$request['token'] = $_SESSION['token'];
$request['creador'] = $_SESSION['usuario'];

//print("<pre>".print_r($_SERVER,true)."</pre>");

if (isset($_FILES['afiche']) && $_FILES['afiche']['error'] == 0) {

    $nombreArchivo = $_FILES['afiche']['name'];
    $carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . '/funciones/wsdl/uploads/';
    $rutaImagen=  $_SERVER['HTTP_ORIGIN'] . '/funciones/wsdl/uploads/';
    $tamanoArchivo = $_FILES['afiche']['size'];

    // Ruta de guardado
    $request['imagen']['nombreFichero'] =  $nombreArchivo;
    $request['imagen']['rutaFichero'] = $carpetaDestino . $nombreArchivo;
    $request['imagen']['rutaImagen'] = $rutaImagen . $nombreArchivo;
    $request['imagen']['tamanoArchivo'] = $tamanoArchivo;
    $request['imagen']['tipoArchivo'] = $_FILES['afiche']['type'];
    // Mover el archivo a la carpeta de destino
    move_uploaded_file($_FILES['afiche']['tmp_name'], $request['imagen']['rutaFichero']);

} else {
    $request['imagen']['nombreFichero'] =  null;
    $request['imagen']['rutaFichero'] =   null;
    $request['imagen']['rutaImagen'] =   null;
    $request['imagen']['tamanoArchivo'] =   null;
    $request['imagen']['tipoArchivo'] =   null;
}




//echo "<pre>" . json_encode($_SERVER, JSON_PRETTY_PRINT) . "</pre>";die;

  if (
    (@$_POST['nombreEvento']!="")&&
    (@$_POST['idSede']!="")&&
    (@$_POST['descripcionEvento']!="")&&
    (@$_POST['fechaEvento']!="")
    ){
        $URL = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/event";
            $rs = API::POST($URL, $token, $request);
            $rs = API::JSON_TO_ARRAY($rs);
    }

//print("<pre>".print_r(json_encode($rs),true)."</pre>");die;
//onclick="enviarParametros('admin/clienteList.php')"

$idHeaderNew = @$rs['result']['idHeaderNew'];

if (@$rs['status'] == 'OK') {
    $url = "onclick=\"enviarParametrosCRUD('event/eventList.php')\"";
} else {
    $url = "onclick=\"enviarParametrosCRUD('event/crearEvent.php','1')\"";
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
