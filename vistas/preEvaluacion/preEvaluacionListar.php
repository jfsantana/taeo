<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['id_user'])) {
  header("Location:  http://" . $_SERVER['HTTP_HOST']);
  exit();
}
require_once '../funciones/wsdl/clases/consumoApi.class.php';


function edadAprendiz($fechaNacimiento){
  $fecha_nacimiento = $fechaNacimiento;
  $fecha_actual = date("Y-m-d H:i:s");
  $timestamp_nacimiento = strtotime($fecha_nacimiento);
  $timestamp_actual = strtotime($fecha_actual);
  $diferencia = abs($timestamp_actual - $timestamp_nacimiento);
  $anios = floor($diferencia / (365 * 60 * 60 * 24));
  $meses = floor(($diferencia - $anios * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
  return  $anios . " años, " . $meses . " meses"; 
}

function edadByEvaluacion($fechaNacimiento, $fechaEvaluacion){
// Convertir las fechas a objetos DateTime
$fechaNacimientoDateTime = new DateTime($fechaNacimiento);
$fechaEvaluacionDateTime = new DateTime($fechaEvaluacion);

// Calcular la diferencia entre las dos fechas
$diferencia = $fechaNacimientoDateTime->diff($fechaEvaluacionDateTime);

// Obtener los años y meses de la diferencia
$anios = $diferencia->y;
$meses = $diferencia->m;

// Imprimir la edad en años y meses
return  $anios . " años, " . $meses . " meses"; 
}



//Listado Clientes
$id = @$_POST["id"];
$token = $_SESSION['token'];
$URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/preEvaluacion?type=1";
//echo $URL ;
$rs         = API::GET($URL, $token);
$arrayPreEvaluacion  = API::JSON_TO_ARRAY($rs);

?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Evaluaciones</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-12">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?php echo count($arrayPreEvaluacion); ?></h3>
            <p>Numero Evaluaciones Realizadas</p>
          </div>
          <div class="icon">
            <i class="ion "><ion-icon name="happy-outline"></ion-icon></i>
          </div>

          <a href="#" onclick="enviarParametrosGetsionCreate('preEvaluacion/preEvaluacionCreate.php','1')" class="small-box-footer">Crear Evaluación </a>
        </div>
      </div>

    </div>

    <div class="row">
      <section class="col-lg-12 connectedSortable">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listado de Evaluaciones Creadas</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Aprendiz</th>
                  <th>Fecha Evaluación</th>
                  <th>Edad a la  Evaluacion</th>
                  <th>Edad Actual</th>
                  <th>Evaluado Por</th>
                </tr>
              </thead>
              
              <tbody>
                <?php foreach ($arrayPreEvaluacion as $preEvaluacion) { ?>
                  <tr>
                  <td>
                      <a  href="#" 
                      
                      onclick="enviarParametrosGetsionUpdate('preEvaluacion/preEvaluacionCreate.php',2,'<?php echo $preEvaluacion['idHeaderEvaluacion']; ?>')" class="nav-link ">
                      <?php echo strtoupper($preEvaluacion['apellidoAprendiz'].', '. $preEvaluacion['nombreAprendiz']); ?>
                      </a>
                  </td>
                  <td><?php echo $preEvaluacion['fechaEvaluacion']; ?></td>
                  <td><?php echo edadByEvaluacion($preEvaluacion['fechaNacimientoAprendiz'],$preEvaluacion['fechaEvaluacion']); ?></td>
                  <td><?php echo edadAprendiz($preEvaluacion['fechaNacimientoAprendiz']); ?></td>                  
                  <td><?php echo $preEvaluacion['nombreUsuario']; ?></td>
                  </tr>
                <?php } ?>

              </tbody>
              <tfoot>
                <tr>
                  <th>Aprendiz</th>
                  <th>Edad Actual</th>
                  <th>Edad a la  Evaluacion</th>
                  <th>Fecha Evaluación</th>
                  <th>Evaluado Por</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>

      </section>

    </div>
</div>
</section>
