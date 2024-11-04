<?php foreach ($modalsData as $modalData): ?>
<!-- Modal -->
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
            <label for="editNivel_<?php echo $modalData['modalId']; ?>">Nivel</label>
            <select class="form-control" name="idNivelEvaluacion" id="editNivel_<?php echo $modalData['modalId']; ?>" required>
              <option value=''>Seleccione</option>
              <?php foreach($arrayNiveles as $dataNiveles ){?>
                <option <?php if ($dataNiveles['idNivelesEvaluacion'] == @$modalData['idNivelEvaluacion']) {echo 'selected';} ?> value=<?php echo $dataNiveles['idNivelesEvaluacion']; ?>><?php echo strtoupper($dataNiveles['nombreNivelEvaluacion']);?></option>
              <?php }?>
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
            <label for="editArea_<?php echo $modalData['modalId']; ?>">Área</label>
            <select class="form-control" name="idAreaEvaluacion" id="editArea_<?php echo $modalData['modalId']; ?>" required>
              <option value=''>Seleccione</option>
              <?php foreach($arrayItemCreate as $dataItemCreate ){?>
                <option <?php if ($dataItemCreate['idAreaEvaluacion'] == @$modalData['idAreaEvaluacion']) {echo 'selected';} ?> value=<?php echo $dataItemCreate['idAreaEvaluacion']; ?>><?php echo strtoupper($dataItemCreate['nombreAreaEvaluacion']);?></option>
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
<?php endforeach; ?>