<div class="col-sm-12">
    <label for="conclucionesRecomendaciones" class="d-block text-center text-white py-2" style="font-size: 1rem; background-color: #00B9F1;">EVALUADO POR</label>
</div>  
<?php 
foreach($arrayEvaluadores as $dataEvaluadores ){?>
    <div class="col-sm-4">
        <?php echo $dataEvaluadores['apellidoUsuario'].', '.$dataEvaluadores['nombreUsuario'];?>
    </div>
    <div class="col-sm-4">
    <small> <?php echo  $dataEvaluadores['emailUsuario'];?></small>
    </div>
    <div class="col-sm-4">
    <small>  <?php echo  $dataEvaluadores['descripcionCargo'];?></small>
    </div>
    <div class="col-12">
        <hr style="border: 0.5px solid lightgrey;">
    </div>
<?php  }  ?>