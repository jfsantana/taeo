<?php
if (!empty($modalsData)) {
   foreach (@$modalsData as $modalData){ ?>
    <!-- Modal  -->
     
    <?php $idEvaluacionEditDelete = $modalData['id']; ?>
      <div class="modal fade" id="<?php echo $modalData['modalId']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel">Editar Evaluación (<?php echo $modalData['id']; ?>)</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="editForm_<?php echo $modalData['modalId']; ?>">
                <input type="hidden" class="form-control" id="editIdHeaderEvaluacion_<?php echo $modalData['modalId']; ?>" name="idHeaderEvaluacion" value="<?php echo $modalData['idHeaderEvaluacion']; ?>">
                <div class="form-group">
                    <label for="editNivel_<?php echo $modalData['modalId']; ?>">Nivel </label>
                    <select class="form-control" name="idNivelEvaluacion" id="editNivel_<?php echo $modalData['modalId']; ?>" required>
                        <option value=''>Seleccione</option>
                        <?php foreach($arrayNiveles as $dataNiveles) { ?>
                            <option 
                              value="<?php echo $dataNiveles['idNivelesEvaluacion'];?>"
                              <?php if ($dataNiveles['idNivelesEvaluacion'] == @$modalData['idNivelEvaluacion']) {echo 'selected';} ?> >
                              <?php echo strtoupper($dataNiveles['nombreNivelEvaluacion']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="editEdad_<?php echo $modalData['modalId']; ?>">Edad</label>
                  <select class="form-control" name="edadCronologica" id="editEdad_<?php echo $modalData['modalId']; ?>" required>
                    <option value=''>Seleccione</option>
                    <?php for ($i = 0; $i <= @$anioAprendiz; $i++) { ?>
                      <option <?php if ($i == @$modalData['edadCronologica']) {echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="editArea_<?php echo $modalData['modalId']; ?>">Área </label>
                  <select class="form-control" name="idAreaEvaluacion" id="editArea_<?php echo $modalData['modalId']; ?>" required>
                    <option value=''>Seleccione</option>
                    <?php foreach($arrayItemCreate as $dataItemCreate ){?>
                      
                      <option <?php if ($dataItemCreate['idAreaEvaluacion'] == @$modalData['idAreaEvaluacion']) {echo 'selected';} ?> value=<?php echo $dataItemCreate['idAreaEvaluacion'];?>><?php echo strtoupper($dataItemCreate['nombreAreaEvaluacion']);?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="editDescripcion_<?php echo $modalData['modalId']; ?>">Descripción</label>
                  <input type="text" class="form-control" id="editDescripcion_<?php echo $modalData['modalId']; ?>" name="descripcion" value="<?php echo $modalData['descripcion']; ?>">
                </div>
                <div class="form-group">
                  <label for="editEvaluacion_<?php echo $modalData['modalId']; ?>">Evaluación</label>
                  <select class="form-control" name="evaluacion_detalle" id="editEvaluacion_<?php echo $modalData['modalId']; ?>" required>
                    <option value=''>Seleccione</option>
                    <?php foreach($arrayEvaluacion as $dataEvaluacion ){?>
                      <option <?php if ($dataEvaluacion['descripcionCorta'] == @$modalData['evaluacion']) {echo 'selected';} ?> value=<?php echo $dataEvaluacion['descripcionCorta']; ?>><?php echo strtoupper($dataEvaluacion['descripcionLarga']);?></option>
                    <?php }?>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <button type="button" class="btn btn-danger" id="deleteButton_<?php echo $modalData['modalId']; ?>" data-id="<?php echo $idEvaluacionEditDelete; ?>">Eliminar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
  <?php }
    
}?>


<script>
  //este es el script que se encarga de enviar los datos al modal de edicion y almacenarlos
  $(document).on('show.bs.modal', '.modal', function (event) {
    //Bloque 1
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

    //Bloque 2
    console.log('ID:', id);
    console.log('Nivel:', nivel);
    console.log('ID Nivel Evaluacion:', idNivelEvaluacion);
    console.log('Edad:', edad);
    console.log('Edad Cronologica:', edadCronologica);
    console.log('Área:', area);
    console.log('ID Área Evaluacion:', idAreaEvaluacion);
    console.log('Descripción:', descripcion);
    console.log('Evaluación:', evaluacion);

    //Bloque 3
    var modal = $(this);

    //Bloque 4
    modal.find('#previewId_' + modal.attr('id')).text(id);
    modal.find('#previewNivel_' + modal.attr('id')).text(nivel);
    modal.find('#previewEdad_' + modal.attr('id')).text(edad);
    modal.find('#previewArea_' + modal.attr('id')).text(area);
    modal.find('#previewDescripcion_' + modal.attr('id')).text(descripcion);
    modal.find('#previewEvaluacion_' + modal.attr('id')).text(evaluacion);

    //Bloque 5
    // modal.find('#editNivel_' + modal.attr('id')).val(idNivelEvaluacion);
    // modal.find('#editEdad_' + modal.attr('id')).val(edadCronologica);
    // modal.find('#editArea_' + modal.attr('id')).val(idAreaEvaluacion);
    // modal.find('#editDescripcion_' + modal.attr('id')).val(descripcion);
    // modal.find('#editEvaluacion_' + modal.attr('id')).val(evaluacion);
    // modal.find('#editIdHeaderEvaluacion_' + modal.attr('id')).val(idHeaderEvaluacion);

    //Bloque 6
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

    //alert('Datos enviados:' + JSON.stringify(data));
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
        url: '<?php echo $_SESSION['HTTP_ORIGIN'];?>/funciones/wsdl/preEvaluacion',
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