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

// busqueda de los distintos aprendices activos creados
$URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/aprendiz?type=1";
$rs         = API::GET($URL, $token);
$arrayAprendices  = API::JSON_TO_ARRAY($rs);

//Sedes
$URL1        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/sede?type=1";
$rs         = API::GET($URL1, $token);
$arraySede  = API::JSON_TO_ARRAY($rs);

//facilitadores
$URL1        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/empleados?type=3&rolUsuario=3";
$rs         = API::GET($URL1, $token);
$arrayFacilitadores  = API::JSON_TO_ARRAY($rs);


if ($_POST['mod'] == 1) {
  $activo =1;
  $accion = "Crear";
  if(isset($_POST['id'])){
    $idHeaderEvaluacion = @$_POST["id"];  
  }
  $creadoPor = $_SESSION['usuario'];
  $fechaCreacion = date('Y-m-d');
} elseif($_POST['mod'] == 2) {

  $flag=true;
  $accion = "Actualizar";
  $disabled = 'disabled';

  //datos Representante
  $idHeaderEvaluacion = @$_POST["id"];

  //consulta de los header
  $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=1&idHeaderEvaluacion=$idHeaderEvaluacion";
  $rs         = API::GET($URL, $token);
  $arrayHeader  = API::JSON_TO_ARRAY($rs);

  //VARIABLES PARA EDICION
  $idHeaderEvaluacion = @$arrayHeader[0]['idHeaderEvaluacion'];
  $fechaUltimaEvaluacion = @$arrayHeader[0]['fechaUltimaEvaluacion'];
  $fechaEvaluacion = @$arrayHeader[0]['fechaEvaluacion'];
  $conclucionesRecomendaciones = @$arrayHeader[0]['conclucionesRecomendaciones'];
  $idAprendiz = @$arrayHeader[0]['idAprendiz'];
  $idEvaluadoPor = @$arrayHeader[0]['idEvaluadoPor'];
  $idSede = @$arrayHeader[0]['idSede'];
  $activo = @$arrayHeader[0]['activo'];
  $observacion = @$arrayHeader[0]['observacion'];
  $creadoPor = @$arrayHeader[0]['creadoPor'];
  $fechaNacimientoAprendiz = @$arrayHeader[0]['fechaNacimientoAprendiz'];
  $nombreAprendiz= @$arrayHeader[0]['apellidoAprendiz'].', '.@$arrayHeader[0]['nombreAprendiz'];
  $nombreAprendizAux= '('.$nombreAprendiz.')';
  $anioAprendiz=edadAprendiz($fechaNacimientoAprendiz);

  $idNivelEvaluacion= @$_POST["idNivelEvaluacion"];
  $edadCronologica= @$_POST["edadCronologica"];
  $idAreaEvaluacion= @$_POST["idAreaEvaluacion"];


  //consulta de los NIVELES PARA LA CREACION
  $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=6";
  $rs         = API::GET($URL, $token);
  $arrayNiveles  = API::JSON_TO_ARRAY($rs);

  //consulta de los ITEMS PARA LA CREACION
  $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=5";
  $rs         = API::GET($URL, $token);
  $arrayItemCreate  = API::JSON_TO_ARRAY($rs);

  //consulta las calificaciones de una evaluaicon
  $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/evaluacion?type=3";
  $rs         = API::GET($URL, $token);
  $arrayEvaluacion  = API::JSON_TO_ARRAY($rs);

    //consulta de los ITEMS PARA LA CREACION
    $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=7&idHeaderEvaluacion=$idHeaderEvaluacion";
    $rs         = API::GET($URL, $token);
    $arrayResumen  = API::JSON_TO_ARRAY($rs);
    

    
    
  //consulta de los items
    $URL        = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/preEvaluacion?type=2";
    $rs         = API::GET($URL, $token);
    $arrayItemByHeader  = API::JSON_TO_ARRAY($rs);

}

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
        <h1 class="m-0">Resumen Para el Aprendiz:</h1>
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
      <section class="col-lg-12 connectedSortable ui-sortable">
        <!-- EVALUACIONES-->
         <?PHP include("includePreEvaluacione.php");?>

      </section>
      <section class="col-lg-12 connectedSortable ui-sortable">
        <?PHP include("includePlanificacion.php");?>
      </section>
    </div>

    
      
      <!-- botton volver -->
      <div class="">
      <div class="card-footer">
          <button type="button" class="btn btn-primary" onclick="enviarParametros('preEvaluacion/preEvaluacionListar.php')">Volver al Listado de Evaluaciones</button>
        </div>
      </div>
    </div>
  </div>  
</form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      <?php if ($_POST['mod'] == 2): ?>
        fetchNiveles('<?php echo @$idAprendiz; ?>','<?php echo @$_POST['mod']; ?>');
        fetchMediadores('<?php echo @$idSede; ?>','<?php echo  $idEvaluadoPor; ?>');

        document.getElementById('HeaderTable').click();
        document.getElementById('HeaderItems').click();
       // document.getElementById('HeaderDetail').click();

      <?php endif; ?>
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



<script>
  $(document).on('show.bs.modal', '.modal', function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var id = button.data('id');
    var idHeaderEvaluacion = button.data('idHeaderEvaluacion');
    var nivel = button.data('nivel');
    var idNivelEvaluacion = button.data('idNivelEvaluacion');
    var edad = button.data('edad');
    var edadCronologica = button.data('edadCronologica');
    var area = button.data('area');
    var idAreaEvaluacion = button.data('idAreaEvaluacion');
    var descripcion = button.data('descripcion');
    var evaluacion = button.data('evaluacion');

    console.log('ID:', id);
    console.log('Nivel:', nivel);
    console.log('ID Nivel Evaluacion:', idNivelEvaluacion);
    console.log('Edad:', edad);
    console.log('Edad Cronologica:', edadCronologica);
    console.log('Área:', area);
    console.log('ID Área Evaluacion:', idAreaEvaluacion);
    console.log('Descripción:', descripcion);
    console.log('Evaluación:', evaluacion);

    var modal = $(this);
    // Rellenar la vista previa
    modal.find('#previewId_' + modal.attr('id')).text(id);
    modal.find('#previewNivel_' + modal.attr('id')).text(nivel);
    modal.find('#previewEdad_' + modal.attr('id')).text(edad);
    modal.find('#previewArea_' + modal.attr('id')).text(area);
    modal.find('#previewDescripcion_' + modal.attr('id')).text(descripcion);
    modal.find('#previewEvaluacion_' + modal.attr('id')).text(evaluacion);

    // Seleccionar los valores en los select
    modal.find('#editNivel_' + modal.attr('id')).val(idNivelEvaluacion);
    modal.find('#editEdad_' + modal.attr('id')).val(edadCronologica);
    modal.find('#editArea_' + modal.attr('id')).val(idAreaEvaluacion);
    modal.find('#editDescripcion_' + modal.attr('id')).val(descripcion);
    modal.find('#editEvaluacion_' + modal.attr('id')).val(evaluacion);

    modal.find('#editIdHeaderEvaluacion_' + modal.attr('id')).val(idHeaderEvaluacion);

    // Guardar el ID del registro para eliminarlo
    modal.find('#deleteButton_' + modal.attr('id')).data('id', id);
  });

  $(document).on('submit', '[id^=editForm_]', function (event) {
    event.preventDefault();
    var form = $(this);
    var modalId = form.attr('id').replace('editForm_', '');
    var id = form.find('#deleteButton_' + modalId).data('id');
    var idNivelEvaluacion = form.find('#editNivel_' + modalId).val();
    var edadCronologica = form.find('#editEdad_' + modalId).val();
    var idAreaEvaluacion = form.find('#editArea_' + modalId).val();
    var descripcion = form.find('#editDescripcion_' + modalId).val();
    var evaluacion = form.find('#editEvaluacion_' + modalId).val();

    var idHeaderEvaluacion = form.find('#editIdHeaderEvaluacion_' + modalId).val();

    

    // Crear el objeto de datos para enviar en la solicitud POST
    var data = {
      idDetalleEvaluacion: id,
      idNivelEvaluacion: idNivelEvaluacion,
      edadCronologica: edadCronologica,
      idAreaEvaluacion: idAreaEvaluacion,
      detalleEvalaacion: descripcion,
      evaluacion_detalle: evaluacion,
      idHeaderEvaluacion: idHeaderEvaluacion
    };

    alert('Datos enviados:' + JSON.stringify(data));
    // Realizar la solicitud POST al servicio
    $.ajax({
      url: '<?php echo $_SESSION['HTTP_ORIGIN'];?>/funciones/wsdl/preEvaluacion',
      type: 'PUT',
      data: JSON.stringify(data),
      contentType: 'application/json',
      success: function(response) {
        // Cerrar el modal
        enviarParametrosEvaluacion('preEvaluacion/preEvaluacionCreate.php','2', idHeaderEvaluacion,idNivelEvaluacion, edadCronologica , idAreaEvaluacion);

       
    },
      error: function(xhr, status, error) {
        console.error('Error en la actualización:', error);
      }
    });
  });

  $(document).on('click', '[id^=deleteButton_]', function () {
    event.preventDefault();
    var form = $(this).closest('form');
    var modalId = form.attr('id').replace('editForm_', '');
    var id = form.find('#deleteButton_' + modalId).data('id');
    var idNivelEvaluacion = form.find('#editNivel_' + modalId).val();
    var edadCronologica = form.find('#editEdad_' + modalId).val();
    var idAreaEvaluacion = form.find('#editArea_' + modalId).val();
    var descripcion = form.find('#editDescripcion_' + modalId).val();
    var evaluacion = form.find('#editEvaluacion_' + modalId).val();
    var idHeaderEvaluacion = form.find('#editIdHeaderEvaluacion_' + modalId).val();

    // Crear el objeto de datos para enviar en la solicitud POST
    var data = {
        idDetalleEvaluacion: id,
        idNivelEvaluacion: idNivelEvaluacion,
        edadCronologica: edadCronologica,
        idAreaEvaluacion: idAreaEvaluacion,
        detalleEvalaacion: descripcion,
        evaluacion_detalle: evaluacion,
        idHeaderEvaluacion: idHeaderEvaluacion
    };

    console.log('Datos enviados:', JSON.stringify(data));

    // Realizar la solicitud POST al servicio
    $.ajax({
        url: '<?php echo $_SESSION['HTTP_ORIGIN'];?>//funciones/wsdl/preEvaluacion',
        type: 'DELETE',
        data: JSON.stringify(data),
        contentType: 'application/json',
        success: function(response) {
            
          enviarParametrosEvaluacion('preEvaluacion/preEvaluacionCreate.php','2', idHeaderEvaluacion,idNivelEvaluacion, edadCronologica , idAreaEvaluacion);
        },
        error: function(xhr, status, error) {
            console.error('Error en la actualización:', error);
        }
    });
  });



</script>





