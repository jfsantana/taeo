<div id="printableArea">
<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
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
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/aprendiz?type=1";
$rs         = API::GET($URL, $token);
$arrayAprendices  = API::JSON_TO_ARRAY($rs);

//Sedes
$URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/sede?type=1";
$rs         = API::GET($URL1, $token);
$arraySede  = API::JSON_TO_ARRAY($rs);

//facilitadores
$URL1        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/empleados?type=3&rolUsuario=3";
$rs         = API::GET($URL1, $token);
$arrayFacilitadores  = API::JSON_TO_ARRAY($rs);




if ($_POST['mod'] == 1) {
  $activo =1;
  $accion = "Crear";
  if(isset($_POST['id'])){
    $idHeaderEvaluacion = @$_POST["id"];  //signifia que la creacion esta asociada a un aprendiz
  }
  $creadoPor = $_SESSION['usuario'];
  $fechaCreacion = date('Y-m-d');
} elseif($_POST['mod'] == 2) {

  $flag=true;
  $accion = "Editar";
  $disabled = 'disabled';

  //datos Representante
  $idHeaderEvaluacion = @$_POST["id"];

  //consulta de los header
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/preEvaluacion?type=1&idHeaderEvaluacion=$idHeaderEvaluacion";
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


  //consulta de los NIVELES PARA LA CREACION
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/preEvaluacion?type=6";
  $rs         = API::GET($URL, $token);
  $arrayNiveles  = API::JSON_TO_ARRAY($rs);

  //consulta de los ITEMS PARA LA CREACION
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/preEvaluacion?type=5";
  $rs         = API::GET($URL, $token);
  $arrayItemCreate  = API::JSON_TO_ARRAY($rs);

  //consulta las calificaciones de una evaluaicon
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/evaluacion?type=3";
  $rs         = API::GET($URL, $token);
  $arrayEvaluacion  = API::JSON_TO_ARRAY($rs);

    //consulta de los ITEMS PARA LA CREACION
    $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/preEvaluacion?type=7&idHeaderEvaluacion=$idHeaderEvaluacion";
    $rs         = API::GET($URL, $token);
    $arrayResumen  = API::JSON_TO_ARRAY($rs);

    
    
  //consulta de los items
    $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/preEvaluacion?type=2";
    $rs         = API::GET($URL, $token);
    $arrayItemByHeader  = API::JSON_TO_ARRAY($rs);

}

?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Evaluaciones</h1>
      </div><!-- /.col -->
      <div class="col-sm-6 text-right">
        <!-- <button id="printButton" class="btn btn-primary">Imprimir</button> -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container -fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<form action="../funciones/funcionesGenerales/XM_preEvaluacion.model.php" method="post" name="objetivo" id="objetivo"  enctype="multipart/form-data">

  <input type="hidden" name="mod" value="<?php echo @$_POST['mod'] ?>">
  <input type="hidden" name="idHeaderEvaluacion" value="<?php echo @$idHeaderEvaluacion; ?>">
  



  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
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
                  <select class="form-control" name="idAprendiz" id="Aprendiz" <?php echo $disabled;?> onchange="fetchNiveles(this.value,<?php echo $_POST['mod'];?>)">
                    <option  value=''>Seleccione</option>
                    <?php foreach($arrayAprendices as $dataAprendices ){?>
                      <option <?php if ($dataAprendices['idAprendiz'] == @$idAprendiz) {echo 'selected';} ?> value=<?php echo $dataAprendices['idAprendiz']; ?>><?php echo strtoupper($dataAprendices['apellidoAprendiz'].', '. $dataAprendices['nombreAprendiz']);?></option>
                    <?php }?>
                  </select>
                </div>

                <div class="col-sm-2">
                  <label for="idHeaderEvaluacionAnteriorl">Evaluación previa</label>
                  <select class="form-control" name="idHeaderEvaluacionAnterior" id="idHeaderEvaluacionAnterior" <?php echo $disabled;?>  <?php if ($_POST['mod']==1){echo 'disabled';}?>>

                  </select>
                </div>

                <div class="col-sm-2">
                  <label for="sede">Sede:</label>
                  <select class="form-control" name="idSede" id="idSede"  <?php echo $disabled;?>  onchange="fetchMediadores(this.value,'')" >
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
                  <select class="form-control" name="activo" id="activo">
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

            <div class="card-footer">

              <button type="submit" class="btn btn-success" ><?php echo $accion; ?> Cabecera de la Evaluacion </button>
              <?php if($_POST['mod']==1){?>
                <button type="button" class="btn btn-primary" onclick="enviarParametros('preEvaluacion/preEvaluacionListar.php')">Volver al Listado de Evaluaciones</button>
              <?php } ?>
            </div>



          </form>
        </div>
      </div>
      <!-- ITEMS -->
      <div class="col-lg-12 col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">ITEMS </h3>
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
                  <select class="form-control" name="idNivelEvaluacion" id="idNivelEvaluacion">
                    <option  value=''>Seleccione</option>
                    <?php foreach($arrayNiveles as $dataNiveles ){?>
                      <option  value=<?php echo $dataNiveles['idNivelesEvaluacion']; ?>><?php echo strtoupper($dataNiveles['nombreNivelEvaluacion']);?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label for="Aprendiz">Edad Cronologia</label>
                  <select class="form-control" name="edadCronologica" id="edadCronologica">
                    <option  value=''>Seleccione</option>
                    <?php
                      for ($i = 0; $i <= @$anioAprendiz; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                      <?php } ?>
                  </select>
                </div>

                <div class="col-sm-4">
                  <label for="Aprendiz">Area Evaluada</label>
                  <select class="form-control" name="idAreaEvaluacion" id="idAreaEvaluacion">
                    <option  value=''>Seleccione</option>
                    <?php foreach($arrayItemCreate as $dataItemCreate ){?>
                      <option  value=<?php echo $dataItemCreate['idAreaEvaluacion']; ?>><?php echo strtoupper($dataItemCreate['nombreAreaEvaluacion']);?></option>
                    <?php }?>
                  </select>
                </div>

                <div class="col-sm-10">
                    <label for="detalleEvalaacion">Descripcion</label>
                    <input type="text" class="form-control" name="detalleEvalaacion" id="detalleEvalaacion" placeholder="creadoPor"  >
                </div>

                <div class="col-sm-2">
                  <label for="evaluacion_detalle">Evaluacion</label>
                  <select class="form-control" name="evaluacion_detalle" id="evaluacion_detalle">
                    <option  value=''>Seleccione</option>
                    <?php foreach($arrayEvaluacion as $dataEvaluacion ){?>
                      <option  value=<?php echo $dataEvaluacion['descripcionCorta']; ?>><?php echo strtoupper($dataEvaluacion['descripcionLarga']);?></option>
                    <?php }?>
                  </select>
                </div>
                

              </div>

              <div class="card-footer">
                  <button type="submit" class="btn btn-success" ><?php echo $accion; ?> Cabecera de la Evaluacion </button>
                  <?php if($_POST['mod']==1){?>
                    <button type="button" class="btn btn-primary" onclick="enviarParametros('preEvaluacion/preEvaluacionListar.php')">Volver al Listado de Evaluaciones</button>
                  <?php } ?>
              </div>

              <div class="row">
              
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
                        
                          // Organize data by nivel and edad
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
                        
                          $numAreas = count($areas);
                        
                          // Print data
                          foreach ($dataByNivelAndEdad as $nivel => $edades) {
                            echo "<tr><td colspan='$numAreas'><strong>Nivel: " . strtoupper($nivel) . "</strong></td></tr>";
                            ksort($edades); // Sort edades by key (edad) in ascending order
                            foreach ($edades as $edad => $areasData) {
                              echo "<tr><td colspan='$numAreas'><strong>Edad Cronologica: " . $edad . "</strong></td></tr>";
                              echo "<tr>";
                              foreach ($areas as $area) {
                                echo "<th>" . strtoupper($area) . "</th>";
                              }
                              echo "</tr>";
                              $maxRows = max(array_map('count', $areasData));
                              for ($i = 0; $i < $maxRows; $i++) {
                                echo "<tr>";
                                foreach ($areas as $area) {
                                  if (isset($areasData[$area][$i])) {
                                    $detalle = $areasData[$area][$i]['detalleEvalaacion'];
                                    $evaluacion = $areasData[$area][$i]['evaluacion_detalle'];
                                    echo "<td>$detalle - $evaluacion</td>";
                                  } else {
                                    echo "<td></td>";
                                  }
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
    </div>
    
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->

  
  <!--  </section> -->
</form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      <?php if ($_POST['mod'] == 2): ?>
        fetchNiveles('<?php echo @$idAprendiz; ?>','<?php echo @$_POST['mod']; ?>');
        fetchMediadores('<?php echo @$idSede; ?>','<?php echo  $idEvaluadoPor; ?>');

        document.getElementById('HeaderTable').click();
        document.getElementById('HeaderItems').click();
        document.getElementById('HeaderDetail').click();

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