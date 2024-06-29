<?Php
  // $idPlanificacion ;
  // $idArea ;
  // $idSede ;
  // $idFacilitador ;
  // $idAprendiz ;
  // $periodoEvaluacion ;
  // $observacion ;
  // $fechaCreacion ;
  // $creadoPor;
  // $activo ;
  // $estado ;
  // $nombreArea ;
  // $nombreSede ;
  // $facilitador;
  // $aprendiz ;apellidoAprendiz  nombreAprendiz

  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/nivelArea?type=2&idAreaObjetivo=".@$idArea;
  $rs         = API::GET($URL, $token);
  $arrayNiveles  = API::JSON_TO_ARRAY($rs);


  ?>
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Área: <?php echo $nombreArea.'('.$aprendiz['apellidoAprendiz'].', '.$aprendiz['nombreAprendiz'].')';?> </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-sm-4">
            <label for="nivelObjetivo">Niveles</label>
            <select class="form-control" name="idArea" id="idArea">
              <option>Seleccione</option>
              <?php foreach($arrayNiveles as $nivel ){?>
                <option <?php if ($nivel['idNivelAreaObjetivo'] == @$idNivelAreaObjetivo) {echo 'selected';} ?> value=<?php echo $nivel['idNivelAreaObjetivo']; ?>><?php echo strtoupper($nivel['nombreNivelAreaObjetivo']); ?></option>
              <?php }?>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
