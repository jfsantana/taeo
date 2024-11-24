<div id="printableArea">
<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  " . $_SESSION['HTTP_ORIGIN']);
  exit();
}
include("scriptEva.php");
require_once '../funciones/wsdl/clases/consumoApi.class.php';
$token = $_SESSION['token'];

print("<pre>".print_r(($_POST) ,true)."</pre>"); //die;

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

$disabled ='';
if ($_POST['mod'] == 1) {
  $activo =1;
  $accion = "Crear";
  if(isset($_POST['id'])){
    $idHeaderEvaluacion = @$_POST["id"];
  }
  $creadoPor = $_SESSION['usuario'];
  $fechaEvaluacion = date('Y-m-d');

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

  //echo $fechaUltimaEvaluacion;
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
        <h1 class="m-0">Evaluaciones</h1>
      </div>
      <div class="col-sm-6 text-right">
         <button id="printButton" class="btn btn-primary">Imprimir</button>
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
      <!-- HEADER-->
      <div class="col-lg-12 col-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $accion; ?> Evaluación <?php echo @$nombreAprendizAux;?></h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" id="HeaderTable">
                <i class="fas fa-minus"></i>
              </button>

            </div>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form>
            <div class="card-body">
              <div class="row">

                <div class="col-sm-3">
                  <label for="Aprendiz">Aprendiz</label>
                                    <select class="form-control" name="idAprendiz" id="Aprendiz" <?php echo @$disabled;?> onchange="fetchNiveles(this.value,<?php echo $_POST['mod'];?>)" required>
                    <option  value=''>Seleccione</option>
                    <?php foreach($arrayAprendices as $dataAprendices ){?>
                      <option <?php if ($dataAprendices['idAprendiz'] == @$idAprendiz) {echo 'selected';} ?> value=<?php echo $dataAprendices['idAprendiz']; ?>><?php echo strtoupper($dataAprendices['apellidoAprendiz'].', '. $dataAprendices['nombreAprendiz']);?></option>
                    <?php }?>
                  </select>
                </div>

                <div class="col-sm-2">
                  <label for="idHeaderEvaluacionAnteriorl">Evaluación previa</label>
                  <select class="form-control" name="idHeaderEvaluacionAnterior" id="idHeaderEvaluacionAnterior" <?php echo @$disabled;?>  <?php if ($_POST['mod']==1){echo 'disabled';}?>>

                  </select>
                </div>

                <div class="col-sm-2">
                  <label for="sede">Sede:</label>
                  <select class="form-control" name="idSede" id="idSede"  <?php echo @$disabled;?>  onchange="fetchMediadores(this.value,'')"  required>
                    <option value=''>Seleccione</option>
                    <?php foreach($arraySede as $sede ){?>
                      <option <?php if ($sede['idSede'] == @$idSede) {echo 'selected';} ?> value=<?php echo $sede['idSede']; ?>><?php echo $sede['nombreSede']; ?></option>
                    <?php }?>
                  </select>
                </div>


                <div class="col-sm-4">
                  <label for="aprendiz">Evaluadores:</label>
                  <div id="idFacilitadorContainer">
                    <!-- Checkboxes will be populated here by fetchMediadores -->
                  </div>
                </div>





                <div class="col-sm-1">
                  <label>Activo</label>
                  <select class="form-control" name="activo" id="activo"  required>
                    <option <?php if (@$activo == 1) {
                              echo 'selected';
                            } ?> value=1>Activo</option>
                    <option <?php if (@$activo == 0) {
                              echo 'selected';
                            } ?> value=0>Desactivado</option>
                    <option <?php if (@$activo == 2)  {
                              echo 'selected';
                            } ?> value=2>Cerrada</option>
                  </select>
                </div>
                <div class="col-sm-12">
                          </br>
                    <label for="conclucionesRecomendaciones">Conclusiones y Recomendaciones</label>
                    <textarea  id="summernote" name="conclucionesRecomendaciones"><?php echo @$conclucionesRecomendaciones; ?></textarea>
                </div>

                <div class="col-sm-12">
                  <label for="nombreRepresentante">Observacion Evaluación</label>
                  <textarea  id="observacion" name="observacion"><?php echo @$observacion; ?></textarea>
                </div>
                <div class="col-sm-2">
                  <label for="cedulaRepresentante">Fecha Creación de la Evaluacion</label>
                  <input type="text" class="form-control" readonly name="fechaCreacion" id="fechaCreacion" placeholder="fechaCreacion" value="<?php echo @$fechaEvaluacion; ?>">
                </div>

                <div class="col-sm-2">
                  <label for="telefonoRepresentante">Creado Por</label>
                  <input type="text" class="form-control" name="creadoPor" id="creadoPor" placeholder="creadoPor" readonly value="<?php echo @$creadoPor; ?>">
                </div>

              </div>

            </div>
          </form>
        </div>
      </div>
      <?php if($_POST['mod']!=1){?>
        <!-- ITEMS  -->
        <div class="col-lg-12 col-12">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Detalle de la Evaluacion </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"  id="HeaderItems">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-4">
                    <label for="idNivelEvaluacion">Nivel Evaluada</label>
                    <select class="form-control" name="idNivelEvaluacion" id="idNivelEvaluacion"  required>
                      <option  value=''>Seleccione</option>
                      <?php foreach($arrayNiveles as $dataNiveles ){?>
                        <option  <?php if ($dataNiveles['idNivelesEvaluacion'] == @$idNivelEvaluacion) {echo 'selected';} ?> value=<?php echo $dataNiveles['idNivelesEvaluacion']; ?>><?php echo strtoupper($dataNiveles['nombreNivelEvaluacion']);?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <label for="Aprendiz">Edad Cronologia</label>
                    <select class="form-control" name="edadCronologica" id="edadCronologica"  required>
                      <option  value=''>Seleccione</option>
                      <?php
                        for ($i = 0; $i <= @$anioAprendiz; $i++) { ?>
                          <option  <?php if ($i== @$edadCronologica) {echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                  </div>

                  <div class="col-sm-4">
                    <label for="Aprendiz">Area Evaluada</label>
                    <select class="form-control" name="idAreaEvaluacion" id="idAreaEvaluacion"  required>
                      <option  value=''>Seleccione</option>
                      <?php foreach($arrayItemCreate as $dataItemCreate ){?>
                        <option   <?php if ($dataItemCreate['idAreaEvaluacion'] == @$idAreaEvaluacion) {echo 'selected';} ?> value=<?php echo $dataItemCreate['idAreaEvaluacion']; ?>><?php echo strtoupper($dataItemCreate['nombreAreaEvaluacion']);?></option>
                      <?php }?>
                    </select>
                  </div>

                  <div class="col-sm-10">
                      <label for="detalleEvalaacion">Descripcion</label>
                      <input type="text" class="form-control" name="detalleEvalaacion" id="detalleEvalaacion" placeholder="creadoPor"  required >
                  </div>

                  <div class="col-sm-2">
                    <label for="evaluacion_detalle">Evaluacion</label>
                    <select class="form-control" name="evaluacion_detalle" id="evaluacion_detalle"  required>
                      <option  value=''>Seleccione</option>
                      <?php foreach($arrayEvaluacion as $dataEvaluacion ){?>
                        <option  value=<?php echo $dataEvaluacion['descripcionCorta']; ?>><?php echo strtoupper($dataEvaluacion['descripcionLarga']);?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success" ><?php echo $accion; ?> Cabecera de la Evaluacion </button>
                  <button type="button" class="btn btn-primary" onclick="enviarParametros('preEvaluacion/preEvaluacionListar.php')">Volver al Listado de Evaluaciones</button>
                </div>

                  <div class="col-lg-12 col-12">
                    <div class="card">
                      <div class="card-header bg-gray">
                        <h3 class="card-title">Resumen  de Evaluaciones Creadas</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"  id="HeaderDetail">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          </thead>
                          <tbody>
                            <?php
                            $currentNivel = '';
                            $currentEdad = '';
                            $areas = [];
                            $dataByNivelAndEdad = [];
                            foreach ($arrayResumen as $datoResumen) {
                              $nivel = $datoResumen['nombreNivelEvaluacion'];
                              $edad = $datoResumen['edadCronologica'];
                              $area = $datoResumen['nombreAreaEvaluacion'];

                              if (!isset($dataByNivelAndEdad[$nivel])) {
                                $dataByNivelAndEdad[$nivel] = [];
                              }
                              if (!isset($dataByNivelAndEdad[$nivel][$edad])) {
                                $dataByNivelAndEdad[$nivel][$edad] = [];
                              }
                              if (!isset($dataByNivelAndEdad[$nivel][$edad][$area])) {
                                $dataByNivelAndEdad[$nivel][$edad][$area] = [];
                              }

                              $dataByNivelAndEdad[$nivel][$edad][$area][] = $datoResumen;

                              if (!in_array($area, $areas)) {
                                $areas[] = $area;
                              }
                            }

                            $numAreas = count($areas)*2;

                            // Print data

                            $modalsData = []; // Array para almacenar los datos de los modales


                            foreach ($dataByNivelAndEdad as $nivel => $edades) {
                              echo "<tr class='bg-danger'><td colspan='$numAreas'><strong>Nivel: " . strtoupper($nivel) . "</strong></td></tr>";
                              ksort($edades); // Sort edades by key (edad) in ascending order
                              foreach ($edades as $edad => $areasData) {
                                echo "<tr><td class='bg-info' colspan='$numAreas'><strong>Edad Cronologica: " . $edad . "</strong></td></tr>";
                                echo "<tr>";
                                $columnIndex = 1;
                                foreach ($areas as $area) {
                                  $class = "gradient-blue-$columnIndex";
                                  echo "<th class='$class'>" . strtoupper($area) . "</th>";
                                  echo "<th class='$class'>eva.</th>";
                                  $columnIndex = ($columnIndex % 8) + 1; // Cycle through 1 to 8
                                }
                                echo "</tr>";
                                $maxRows = max(array_map('count', $areasData));
                                for ($i = 0; $i < $maxRows; $i++) {
                                  echo "<tr>";
                                  $columnIndex = 1;
                                  foreach ($areas as $area) {
                                    $class = "gradient-blue-$columnIndex";
                                    if (isset($areasData[$area][$i])) {
                                      $detalle = $areasData[$area][$i]['detalleEvalaacion'];
                                      $evaluacion = $areasData[$area][$i]['evaluacion_detalle'];
                                      $id = isset($areasData[$area][$i]['idDetalleEvaluacion']) ? $areasData[$area][$i]['idDetalleEvaluacion'] : ''; // Verificar si 'idDetalleEvaluacion' existe

                                      switch ($evaluacion) {
                                        case 'AT':
                                          $icon = 'X';
                                          $class = 'Atotal';
                                          break;
                                        case 'AP':
                                          $icon = 'P';
                                          $class = 'AParcial';
                                          break;
                                        case 'SA':
                                          $icon = '√';
                                          break;
                                      }

                                      // Generar un ID único para el modal
                                      $modalId = "editModal_$id";

                                      echo "<td class='$class'><a href='#' class='edit-link' data-toggle='modal' data-target='#$modalId' data-id='$id' data-idHeaderEvaluacion='$idHeaderEvaluacion' data-nivel='$nivel' data-edad='$edad' data-area='$area' data-descripcion='$detalle' data-evaluacion='$evaluacion'>$detalle</a></td><td class='$class'> $icon ($evaluacion)</td>";

                                      // Almacenar los datos del modal en el array
                                      $modalsData[] = [
                                        'modalId' => $modalId,
                                        'id' => $id,
                                        'nivel' => $nivel,
                                        'idNivelEvaluacion' => $areasData[$area][$i]['idNivelEvaluacion'],
                                        'edad' => $edad,
                                        'edadCronologica' => $areasData[$area][$i]['edadCronologica'],
                                        'area' => $area,
                                        'idAreaEvaluacion' => $areasData[$area][$i]['idAreaEvaluacion'],
                                        'descripcion' => $detalle,
                                        'evaluacion' => $evaluacion,
                                        'idHeaderEvaluacion'=>$idHeaderEvaluacion
                                      ];
                                    } else {
                                      echo "<td class='$class'></td><td class='$class'></td>";
                                    }
                                    $columnIndex = ($columnIndex % 8) + 1; // Cycle through 1 to 8
                                  }
                                  echo "</tr>";
                                }
                              }
                            }
                            ?>
                          </tbody>
                          <tfoot>
                            <tr>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
          </div>
        </div>
      <?php } ?>
      <!-- botton volver -->
      <div class="">
      <div class="card-footer">
          <button type="submit" class="btn btn-success" ><?php echo $accion; ?> Cabecera de la Evaluacion </button>
          <button type="button" class="btn btn-primary" onclick="enviarParametros('preEvaluacion/preEvaluacionListar.php')">Volver al Listado de Evaluaciones</button>
        </div>
      </div>
    </div>
  </div>
</form>
</div>

<?php  include_once("preEvaluacionModalEditEvaluacion.php"); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      <?php if ($_POST['mod'] == 2): ?>
        fetchNiveles('<?php echo @$idAprendiz; ?>','<?php echo @$_POST['mod']; ?>');
        fetchMediadores('<?php echo @$idSede; ?>','<?php echo  $idEvaluadoPor; ?>');

        document.getElementById('HeaderTable').click();
       // document.getElementById('HeaderItems').click();
       // document.getElementById('HeaderDetail').click();

      <?php endif; ?>
    });
</script>

<!-- ******************** -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<script>
document.getElementById('printButton').addEventListener('click', function() {
    var id = <?php echo json_encode($_POST['id']); ?>;
    var host = '<?php echo $_SESSION['HTTP_ORIGIN']; ?>/vistas/report/';
    var url = 'informeEvaluacionAprendiz.php?id=' + id;

    url=host+url;

    window.open(url, '_blank', 'width=1200,height=600');



//     url = host + "/vistas/report/"+url;

// alert(url);



});

  //este script es para imprimir el contenido de la pagina
  // document.getElementById('printButton').addEventListener('click', function () {
  //   const { jsPDF } = window.jspdf;
  //   const doc = new jsPDF();

  //   // Obtener el nombre del aprendiz y la fecha actual
  //   const nombreAprendiz = "<?php echo $nombreAprendiz; ?>";
  //   const fechaActual = new Date().toLocaleDateString('es-ES');

  //   html2canvas(document.body, {
  //     onrendered: function (canvas) {
  //       const imgData = canvas.toDataURL('image/png');
  //       const imgWidth = 210; // A4 width in mm
  //       const pageHeight = 295; // A4 height in mm
  //       const imgHeight = canvas.height * imgWidth / canvas.width;
  //       let heightLeft = imgHeight;
  //       let position = 0;

  //       doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
  //       heightLeft -= pageHeight;

  //       while (heightLeft >= 0) {
  //         position = heightLeft - imgHeight;
  //         doc.addPage();
  //         doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
  //         heightLeft -= pageHeight;
  //       }

  //       doc.save(`${nombreAprendiz}_${fechaActual}.pdf`);
  //     }
  //   });
  // });
</script>





