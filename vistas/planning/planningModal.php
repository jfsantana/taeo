<?Php
  $token = $_SESSION['token'];
  $URL        = "http://" . $_SERVER['HTTP_HOST'] . "/funciones/wsdl/nivelArea?type=2&idAreaObjetivo=".@$idArea;
  $rs         = API::GET($URL, $token);
  $arrayNiveles  = API::JSON_TO_ARRAY($rs);
  ?>
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Área: <?php echo $nombreArea.'('.$aprendizFullName.')';?> </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <label for="nivelObjetivo">Niveles</label>
            <select class="form-control" name="nivelObjetivo" id="nivelObjetivo" onchange="fetchSelectPadre('<?php echo $idArea; ?>',this.value,1,0,'#nivelPadre')">
              <option>Seleccione</option>
              <?php foreach($arrayNiveles as $nivel ){?>
                <option <?php if ($nivel['idNivelAreaObjetivo'] == @$idNivelAreaObjetivo) {echo 'selected';} ?> value=<?php echo $nivel['idNivelAreaObjetivo']; ?>><?php echo strtoupper($nivel['nombreNivelAreaObjetivo']); ?></option>
              <?php }?>
            </select>
          </div>
          <div class="col-sm-12">
            <label for="nivelObjetivo">Nivel Padre</label>
            <select class="form-control" disabled name="nivelPadre" id="nivelPadre" onchange="fetchSelectPadre('<?php echo $idArea; ?>',document.getElementById('nivelObjetivo').value,2,this.value,'#nivel1')">
              <option>Seleccione</option>
              <?php foreach($arrayNiveles as $nivel ){?>
                <option <?php if ($nivel['idNivelAreaObjetivo'] == @$idNivelAreaObjetivo) {echo 'selected';} ?> value=<?php echo $nivel['idNivelAreaObjetivo']; ?>><?php echo strtoupper($nivel['nombreNivelAreaObjetivo']); ?></option>
              <?php }?>
            </select>
          </div>
          <div class="col-sm-3">
            <label for="nivelObjetivo">Nivel hijo 1</label>
            <select class="form-control" disabled name="nivel1" id="nivel1" onchange="fetchSelectPadre('<?php echo $idArea; ?>',document.getElementById('nivelObjetivo').value,3,this.value,'#nivel2')">
              <option>Seleccione</option>
              <?php foreach($arrayNiveles as $nivel ){?>
                <option <?php if ($nivel['idNivelAreaObjetivo'] == @$idNivelAreaObjetivo) {echo 'selected';} ?> value=<?php echo $nivel['idNivelAreaObjetivo']; ?>><?php echo strtoupper($nivel['nombreNivelAreaObjetivo']); ?></option>
              <?php }?>
            </select>
          </div>
          <div class="col-sm-3">
            <label for="nivelObjetivo">Nivel hijo 2</label>
            <select class="form-control" disabled name="nivel2" id="nivel2" onchange="fetchSelectPadre('<?php echo $idArea; ?>',document.getElementById('nivelObjetivo').value,4,this.value,'#nivel3')">
              <option>Seleccione</option>
              <?php foreach($arrayNiveles as $nivel ){?>
                <option <?php if ($nivel['idNivelAreaObjetivo'] == @$idNivelAreaObjetivo) {echo 'selected';} ?> value=<?php echo $nivel['idNivelAreaObjetivo']; ?>><?php echo strtoupper($nivel['nombreNivelAreaObjetivo']); ?></option>
              <?php }?>
            </select>
          </div>
          <div class="col-sm-3">
            <label for="nivelObjetivo">Nivel hijo 3</label>
            <select class="form-control" disabled name="nivel3" id="nivel3" onchange="fetchSelectPadre('<?php echo $idArea; ?>',document.getElementById('nivelObjetivo').value,5,this.value,'#nivel4')">
              <option>Seleccione</option>
              <?php foreach($arrayNiveles as $nivel ){?>
                <option <?php if ($nivel['idNivelAreaObjetivo'] == @$idNivelAreaObjetivo) {echo 'selected';} ?> value=<?php echo $nivel['idNivelAreaObjetivo']; ?>><?php echo strtoupper($nivel['nombreNivelAreaObjetivo']); ?></option>
              <?php }?>
            </select>
          </div>
          <div class="col-sm-3">
            <label for="nivelObjetivo">Nivel hijo 4</label>
            <select class="form-control" disabled name="nivel4" id="nivel4" onchange="fetchSelectPadre('<?php echo $idArea; ?>',document.getElementById('nivelObjetivo').value,6,this.value,'#nivel5')">
              <option>Seleccione</option>
              <?php foreach($arrayNiveles as $nivel ){?>
                <option <?php if ($nivel['idNivelAreaObjetivo'] == @$idNivelAreaObjetivo) {echo 'selected';} ?> value=<?php echo $nivel['idNivelAreaObjetivo']; ?>><?php echo strtoupper($nivel['nombreNivelAreaObjetivo']); ?></option>
              <?php }?>
            </select>
          </div>
          <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Actividades Objetivos Principal</h3>
                </div>
                <div class="card-header">
                </div>
                  <div class="card-body p-0">
                    <div class="col-sm-12">
                        <table id="tableActividad" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th with=5%>Activo</th>
                              <th>Nombre Actividad</th>
                            </tr>
                          </thead>
                          <tbody>

                        </tbody>
                          <tfoot>
                            <tr>
                             <th with=5%>Activo</th>
                              <th>Nombre Actividad</th>
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
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
