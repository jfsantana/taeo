<div id="printableArea">
<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  " . $_SESSION['HTTP_ORIGIN']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';
$token = $_SESSION['token'];

//print("<pre>".print_r(($_POST) ,true)."</pre>"); //die;

function edadAprendiz($fechaNacimiento){
  $fecha_nacimiento = @$fechaNacimiento;
  $fecha_actual = date("Y-m-d H:i:s");
  if (!$fecha_nacimiento) {
    return 0;
  }
  $timestamp_nacimiento = strtotime(@$fecha_nacimiento);
  $timestamp_actual = strtotime(@$fecha_actual);
  $diferencia = abs($timestamp_actual - $timestamp_nacimiento);
  $anios = floor($diferencia / (365 * 60 * 60 * 24));
  $meses = floor(($diferencia - $anios * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
  return  $anios; 
}

/*Tipos de MOD
*!MOD =1 CREATE
*!MOR = 2 UPDATE
*/

/**
 * Seccion de Apis
 */
//Datos del apendiz
$idAprendiz = @$_POST["id"];
$token = $_SESSION['token'];
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/aprendiz?type=1&idAprendiz=$idAprendiz";
$rs         = API::GET($URL, $token);
$arrayUsuario  = API::JSON_TO_ARRAY($rs);

$nombreAprendiz = $arrayUsuario[0]['nombreAprendiz'];
$apellidoAprendiz = $arrayUsuario[0]['apellidoAprendiz'];
$cedulaAprendiz = $arrayUsuario[0]['cedulaAprendiz'];
$fechaNacimientoAprendiz = $arrayUsuario[0]['fechaNacimientoAprendiz'];
$colegioAprendiz = $arrayUsuario[0]['colegioAprendiz'];
$gradoAprendiz = $arrayUsuario[0]['gradoAprendiz'];
$escolaridadAprendiz = $arrayUsuario[0]['escolaridadAprendiz'];
$direccionAprendiz = $arrayUsuario[0]['direccionAprendiz'];
$paisAprendiz = $arrayUsuario[0]['paisAprendiz'];
$ciudadAprendiz = $arrayUsuario[0]['ciudadAprendiz'];
$coordinadoraAprendiz = $arrayUsuario[0]['coordinadoraAprendiz'];
$facilitadoraAprendiz = $arrayUsuario[0]['facilitadoraAprendiz'];
$activoAprendiz = $arrayUsuario[0]['activoAprendiz'];
$creadoPor = $arrayUsuario[0]['creadoPor'];
$fechaCreacion = $arrayUsuario[0]['fechaCreacion'];
$alergiaAprendiz = $arrayUsuario[0]['alergiaAprendiz'];



//datos de sus repreentantes
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/aprendiz?type=2&idAprendiz=$idAprendiz";
$rs         = API::GET($URL, $token);
$arrayRepresentanteByAprendiz  = API::JSON_TO_ARRAY($rs);


////Header Evaluaciones
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=4&idAprendiz=$idAprendiz";
$rs         = API::GET($URL, $token);
$arrayPreEvaluacion  = API::JSON_TO_ARRAY($rs);


////Header Avances
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/evaluacion?type=8&idAprendiz=$idAprendiz";
$rs         = API::GET($URL, $token);
$arrayPlanificaciones  = API::JSON_TO_ARRAY($rs);


require_once("style.php")  ;
?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="./style.css" >
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Resumen Para el Aprendiz - <?php echo $apellidoAprendiz.', '.@$nombreAprendiz; ?>:</h1>
      </div>
      <div class="col-sm-6 text-right">
        <!-- <button id="printButton" class="btn btn-primary">Imprimir</button> -->
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<form action="../funciones/funcionesGenerales/XM_preEvaluacion.model.php" method="post" name="objetivo" id="objetivo"  enctype="multipart/form-data">

  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <input type="hidden" name="idHeaderEvaluacion" value="<?php echo @$idHeaderEvaluacion; ?>">
  



  <div class="container-fluid">
    <div class="row">
      <section class="col-lg-7 connectedSortable ui-sortable">
        <!-- Datos del Aprendiz-->
         <?PHP include("includeDatosAprendiz.php");?>

      </section>
      <!-- Datos del Representantes-->
      <section class="col-lg-5 connectedSortable ui-sortable">
        <?PHP include("includeDatosRepresentante.php");?>
      </section>
      <!-- Datos del Evaluaciones-->
      <section class="col-lg-12 connectedSortable ui-sortable">
        <?PHP include("includePreEvaluacione.php");?>
      </section>
      <!-- Datos del Registro de Avances-->
      <section class="col-lg-12 connectedSortable ui-sortable">
        <?PHP include("includeDatosAvances.php");?>
      </section>
    </div>

    
      
      <!-- botton volver -->
      <div class="">
      <div class="card-footer">
          <button type="button" class="btn btn-primary" onclick="enviarParametros('report/reportIntegralAprendizList.php')" >Volver al Listado</button>
        </div>
      </div>
    </div>
  </div>  
</form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('datosAprendiz').click();
        document.getElementById('datosRepresentantes').click();
        document.getElementById('datosEvaluacion').click();
       // document.getElementById('datosAvance').click();

        
    });
</script>

<!-- ******************** -->
<?php include("script.php");?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
  document.getElementById('printButton').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Obtener el nombre del aprendiz y la fecha actual
    const nombreAprendiz = "<?php echo $nombreAprendiz; ?>";
    const fechaActual = new Date().toLocaleDateString('es-ES');

    html2canvas(document.body, {
      onrendered: function (canvas) {
        const imgData = canvas.toDataURL('image/png');
        const imgWidth = 210; // A4 width in mm
        const pageHeight = 295; // A4 height in mm
        const imgHeight = canvas.height * imgWidth / canvas.width;
        let heightLeft = imgHeight;
        let position = 0;

        doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
        heightLeft -= pageHeight;

        while (heightLeft >= 0) {
          position = heightLeft - imgHeight;
          doc.addPage();
          doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
          heightLeft -= pageHeight;
        }

        doc.save(`${nombreAprendiz}_${fechaActual}.pdf`);
      }
    });
  });
</script>









