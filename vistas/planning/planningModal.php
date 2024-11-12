<?php
$token = $_SESSION['token'];
$URL = $_SESSION['HTTP_ORIGIN'] . "/funciones/wsdl/nivelArea?type=2&idAreaObjetivo=" . @$idArea;
$rs = API::GET($URL, $token);
$arrayNiveles = API::JSON_TO_ARRAY($rs);
?> 
<form action="../funciones/funcionesGenerales/XM_planningItem.model.php" name="formPlanningModal" id="formPlanningModal" method="post">

  <input type="hidden" name="mod" value="1">
  <input type="hidden" name="idObjetivoHeader" value="<?php echo @$idObjetivoHeader; ?>">
  <input type="hidden" name="idAreaObjetivo" value="<?php echo @$idArea ; ?>">
  <input type="hidden" name="tipo" value="auto">

  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Área: <?php echo $nombreArea . '(' . $aprendizFullName . ')'; ?> </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <label for="nivelObjetivo">Niveles</label>
              <select class="form-control" name="nivelObjetivo" id="nivelObjetivo" onchange="fetchSelectPadre('<?php echo $idArea; ?>', this.value, 1, 0, '#nivelPadre')">
                <option>Seleccione</option>
                <?php foreach ($arrayNiveles as $nivel) { ?>
                  <option <?php if ($nivel['idNivelAreaObjetivo'] == @$idNivelAreaObjetivo) { echo 'selected'; } ?> value=<?php echo $nivel['idNivelAreaObjetivo']; ?>><?php echo strtoupper($nivel['nombreNivelAreaObjetivo']); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-12">
              <label for="nivelObjetivo">Nivel Padre</label>
              <select class="form-control" disabled name="nivelPadre" id="nivelPadre" onchange="fetchSelectPadre('<?php echo $idArea; ?>', document.getElementById('nivelObjetivo').value, 2, this.value, '#nivel1')">
                <option>Seleccione</option>
                <?php foreach ($arrayNiveles as $nivel) { ?>
                  <option <?php if ($nivel['idNivelAreaObjetivo'] == @$idNivelAreaObjetivo) { echo 'selected'; } ?> value=<?php echo $nivel['idNivelAreaObjetivo']; ?>><?php echo strtoupper($nivel['nombreNivelAreaObjetivo']); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="nivelObjetivo">Nivel hijo 1</label>
              <select class="form-control" disabled name="nivel1" id="nivel1" onchange="fetchSelectPadre('<?php echo $idArea; ?>', document.getElementById('nivelObjetivo').value, 3, this.value, '#nivel2')">
                <option>Seleccione</option>
                <?php foreach ($arrayNiveles as $nivel) { ?>
                  <option <?php if ($nivel['idNivelAreaObjetivo'] == @$idNivelAreaObjetivo) { echo 'selected'; } ?> value=<?php echo $nivel['idNivelAreaObjetivo']; ?>><?php echo strtoupper($nivel['nombreNivelAreaObjetivo']); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="nivelObjetivo">Nivel hijo 2</label>
              <select class="form-control" disabled name="nivel2" id="nivel2" onchange="fetchSelectPadre('<?php echo $idArea; ?>', document.getElementById('nivelObjetivo').value, 4, this.value, '#nivel3')">
                <option>Seleccione</option>
                <?php foreach ($arrayNiveles as $nivel) { ?>
                  <option <?php if ($nivel['idNivelAreaObjetivo'] == @$idNivelAreaObjetivo) { echo 'selected'; } ?> value=<?php echo $nivel['idNivelAreaObjetivo']; ?>><?php echo strtoupper($nivel['nombreNivelAreaObjetivo']); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="nivelObjetivo">Nivel hijo 3</label>
              <select class="form-control" disabled name="nivel3" id="nivel3" onchange="fetchSelectPadre('<?php echo $idArea; ?>', document.getElementById('nivelObjetivo').value, 5, this.value, '#nivel4')">
                <option>Seleccione</option>
                <?php foreach ($arrayNiveles as $nivel) { ?>
                  <option <?php if ($nivel['idNivelAreaObjetivo'] == @$idNivelAreaObjetivo) { echo 'selected'; } ?> value=<?php echo $nivel['idNivelAreaObjetivo']; ?>><?php echo strtoupper($nivel['nombreNivelAreaObjetivo']); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="nivelObjetivo">Nivel hijo 4</label>
              <select class="form-control" disabled name="nivel4" id="nivel4" onchange="fetchSelectPadre('<?php echo $idArea; ?>', document.getElementById('nivelObjetivo').value, 6, this.value, '#nivel5')">
                <option>Seleccione</option>
                <?php foreach ($arrayNiveles as $nivel) { ?>
                  <option <?php if ($nivel['idNivelAreaObjetivo'] == @$idNivelAreaObjetivo) { echo 'selected'; } ?> value=<?php echo $nivel['idNivelAreaObjetivo']; ?>><?php echo strtoupper($nivel['nombreNivelAreaObjetivo']); ?></option>
                <?php } ?>
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
                    <table id="tableActividad" name="tableActividad" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th width="15%"> <input type="checkbox" id="selectAll" disabled></th>
                          <th>Nombre Actividad</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th width="15%"> </th>
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
        <div class="modal-footer justify-content-between">
          <button type="submit"  class="btn btn-primary">Salvar Objetivos</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function() {
  var form = document.getElementById('formPlanningModal');
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      var actionUrl = this.getAttribute('action');
      var formData = $(this).serialize();
      
      console.log("formData: ", formData);    
      console.log("actionUrl: ", actionUrl);
      
      $.ajax({
        type: "POST",
        url: actionUrl,
        data: formData,
        success: function(response) {
          //console.log("Response: ", response);
          alert("CORRECTO al salvar objetivos");
          window.location.reload();
        },
        error: function(xhr, status, error) {
          console.error("Error: ", error);
          console.error("XHR: ", xhr);
          console.error("Status: ", status);
          alert("Error al salvar objetivos");
        }
      });
    });
  } else {
    console.error("Form with ID 'formPlanningModal' not found.");
  }
});
</script>
<!-- <script>

document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('formPlanningModal').addEventListener('submit', function(e) {
    e.preventDefault();
    var actionUrl = this.getAttribute('action');
    //alert (actionUrl);
    console.log($(this).serialize());
    alert($(this).serialize());
    $.ajax({
      type: "POST",
      url: actionUrl,
      data: $(this).serialize(),
      success: function(response) {
        console.log("Response: ", response);
        //$('#modal-lg').modal('hide');
        alert("CORRECTO al salvar objetivos");
        window.location.reload();
      },
      error: function() {
        alert("Response: ", response);
        alert("Error al salvar objetivos");
      }
    });
  });
});
</script> -->
