
  <div class="form-group">
    </br>
    <div class="col-sm-12">
      <input  accept=".xlsx" type="file" id="archivo" required name="archivo">
    </div>

    <?php if ($_POST['mod']==3){?>
      <div class="col-sm-12 text-danger">
        </br>
        Con este proceso se Eliminara todo el contenido de Obajtivo ya creado y sera reemplazado por el contenido del aechivo que se esta cargando
      </div>
    <?php }?>
  </div>



