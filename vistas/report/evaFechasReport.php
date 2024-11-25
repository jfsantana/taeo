<div class="card card-primary">
                  
    <div class="card-body">
    <div class="row">
    <div class="col-sm-12">
        <label for="conclucionesRecomendaciones" class="d-block text-center text-white py-2" style="font-size: 1rem; background-color: #00B9F1;">FECHAS</label>
    </div>  
        <div class="col-sm-3">
        <label for="Aprendiz">Aprendiz</label>
            <select class="form-control" name="idAprendiz" id="Aprendiz" <?php echo @$disabled;?> onchange="fetchNiveles(this.value,<?php echo $_POST['mod'];?>)" required>
            <option  value=''>Seleccione</option>
            <?php foreach($arrayAprendices as $dataAprendices ){?>
                <option <?php if ($dataAprendices['idAprendiz'] == @$idAprendiz) {echo 'selected';} ?> value=<?php echo $dataAprendices['idAprendiz']; ?>><?php echo strtoupper($dataAprendices['apellidoAprendiz'].', '. $dataAprendices['nombreAprendiz']);?></option>
            <?php }?>
        </select>
        </div>
    </div>
    </div>

</div>