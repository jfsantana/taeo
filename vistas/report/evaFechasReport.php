<?php 
function edadAprendizAux($fechaNacimiento){
    $fecha_nacimiento = $fechaNacimiento;
    $fecha_actual = date("Y-m-d H:i:s");
    $timestamp_nacimiento = strtotime($fecha_nacimiento);
    $timestamp_actual = strtotime($fecha_actual);
    $diferencia = abs($timestamp_actual - $timestamp_nacimiento);
    $anios = floor($diferencia / (365 * 60 * 60 * 24));
    $meses = floor(($diferencia - $anios * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    return  $anios . " años, " . $meses . " meses"; 
  }

  function edadByEvaluacionAux($fechaNacimiento, $fechaEvaluacion){
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
    <div class="card card-primary">
        <div class="card-body">

                <div class="col-sm-12">
                    <label for="conclucionesRecomendaciones" class="d-block text-center text-white py-1" style="font-size: 0.8rem; background-color: #2570a1;"><strong>DATOS EVALUACION</strong></label>
                </div>

                <div class="col-sm-12 mb-1">
                    <label for="Aprendiz"><strong>Fecha de Evaluacion:</strong> <?php echo $fechaEvaluacion; ?></label>
                </div>
                <div class="col-sm-12 mb-1">
                    <label for="Aprendiz"><strong>Edad a la Evaluacion:</strong> 
                    <?php echo edadByEvaluacionAux($fechaNacimientoAprendiz,$fechaEvaluacion); ?></label>
                </div>
                <div class="col-sm-12 mb-1">
                    <label for="Aprendiz"><strong>Edad Actual:</strong> 
                    <?php echo edadAprendizAux($fechaNacimientoAprendiz); ?></label>
                </div>
            </div>

    </div>
</div>
