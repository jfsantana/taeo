
  <div class="form-group">
    </br>
    <div class="col-sm-12">
      <input  accept=".xlsx" type="file" id="archivo" required name="archivo">
    </div>

    <?php if ($_POST['mod']==3){?>
      <div class="col-sm-12 text-danger">
        </br>
        Con este proceso se ELIMINARÁ todo el contenido de Objetivo existente y será REEMPLAZADO por el contenido del Nuevo archivo
      </div>
    <?php }?>
  </div>



