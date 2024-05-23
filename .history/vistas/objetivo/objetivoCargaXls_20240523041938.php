
  <div class="form-group">
    </br>
    <div class="col-sm-12">
      <input  accept=".xlsx" type="file" id="archivo" required name="archivo">
    </div>

    <?php if ($_POST['mod']==3){?>
      <div class="col-sm-12 text-danger">
        </br>
        Con este proceso se Eliminará todo el contenido de Objetivo ya creado y será reemplazado por el contenido del archivo que se está cargando
      </div>
    <?php }?>
  </div>



