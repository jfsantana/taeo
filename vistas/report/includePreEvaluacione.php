<?php


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
?>
            <div class="card direct-chat direct-chat-primary">
              <div class="card-header  bg-info">
                 <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Evaluaciones
                </h3>

                <div class="card-tools">
                  <button type="button"  class="btn btn-primary btn-sm" data-card-widget="collapse" id="datosEvaluacion">
                    <i class="fas fa-minus"></i>
                  </button>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <form>
                  <?php if (count($arrayPreEvaluacion) > 0) { ?>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Fecha Evaluación</th>
                          <th>Edad a la  Evaluacion</th>
                          <th>Edad Actual</th>
                          <th>Evaluado Por</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        <?php foreach (@$arrayPreEvaluacion as $preEvaluacion) { 
                        // print_r($arrayPreEvaluacion); die;?>
                          <tr>
                          <td>
                              <a  href="#" 
                              <?php $fechaNacimientoAprendiz = isset($preEvaluacion['fechaEvaluacion']) ? date('d-m-Y', strtotime($preEvaluacion['fechaEvaluacion'])) : ''; ?>
                              onclick="enviarParametrosGetsionUpdate('preEvaluacion/preEvaluacionCreate.php',2,'<?php echo $preEvaluacion['idHeaderEvaluacion']; ?>')" class="nav-link ">
                              <?php echo strtoupper($fechaNacimientoAprendiz); ?>
                              </a>
                          </td>
                          <td><?php echo edadByEvaluacion($preEvaluacion['fechaNacimientoAprendiz'],$preEvaluacion['fechaEvaluacion']); ?></td>
                          <td><?php echo edadAprendiz($preEvaluacion['fechaNacimientoAprendiz']); ?></td>                  
                          <td><?php echo $preEvaluacion['evaluadorPor']; ?></td>
                          </tr>
                        <?php } ?>

                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Fecha Evaluación</th>
                          <th>Edad a la  Evaluacion</th>
                          <th>Edad Actual</th>
                          <th>Evaluado Por</th>
                        </tr>
                      </tfoot>
                    </table>

                    <?php } else {?>

                      <h3 class="text-center">No se han registrado Evaluaciones</h3>

                    <?php } ?>

                </form>
              </div>
          </div>
