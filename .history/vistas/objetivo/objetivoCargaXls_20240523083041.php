
  <div class="form-group">
    </br>
    <div class="col-sm-12">
      <input  accept=".xlsx" type="file" id="archivo" required name="archivo">
    </div>

    <?php if ($_POST['mod']==3){?>
      <div class="col-sm-12 text-danger">
        </br>
        <ul>
          <li>
            Con este proceso se ELIMINARÁ todo el contenido de la VERSION ACTUAL (<?php echo 'Version-'.$maxVersion;?>) del Objetivo existente
          </li>
          <li>Será REEMPLAZADO por el contenido del Nuevo archivo</li>
          <li><strong>NO podrea recuperar </strong>la informacion despues de finalizado el proceso</li>


        </ul>

      </div>
    <?php }?>


  </div>



