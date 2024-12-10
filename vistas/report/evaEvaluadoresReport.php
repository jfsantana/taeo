<div class="col-sm-12">
    <label for="conclucionesRecomendaciones" class="d-block text-center text-white py-1" style="font-size: 0.8rem; background-color: #00B9F1;"><strong>EVALUADO POR</strong></label>
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