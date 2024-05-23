
  <div class="form-group">
    </br>
    <div class="col-sm-12">
      <input  accept=".xlsx" type="file" id="archivo" required name="archivo">
    </div>

    <?php if ($_POST['mod']==3){?>
      <div class="col-sm-12 text-danger">
        </br>
        <ul>
          <il>
          Con este proceso se ELIMINARÁ todo el contenido de la VERSION ACTUAL (<?php echo 'Version-'.$maxVersion;?>) del Objetivo existente
          </il>
          <il>Será REEMPLAZADO por el contenido del Nuevo archivo</il>
          <il>No podrea recuperar la informacion despues de finalizado el proceso</il>
          <il></il>

        </ul>

      </div>
    <?php }?>


  </div>



