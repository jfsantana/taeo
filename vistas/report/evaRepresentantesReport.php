<div class="col-sm-12">
    <label for="conclucionesRecomendaciones" class="d-block text-center text-white py-1" style="font-size: 0.8rem; background-color: #2570a1;"><strong>DATOS DE LOS PADRES</strong></label>
    
</div>

<?php 
foreach($arrayPadres as $dataPadres ){?> 
    <div class="col-sm-3">
    <label for="Aprendiz" > <strong> Nombre  <?php echo  $dataPadres['parentescoRepresentante'];?>: </label>  </br> </strong> <?php echo $dataPadres['apellidoRepresentante'].', '.$dataPadres['nombreRepresentante'];?>
    </div>
    <div class="col-sm-3">
    <label for="Aprendiz" ><strong> Email: </strong> </label> </br>  <small> <?php echo  $dataPadres['correoRepresentante'];?></small>
    </div>
    <div class="col-sm-3">
    <label for="Aprendiz" > <strong> Ocupacion: </strong> </label> </br> <small>  <?php echo  $dataPadres['profesionRepresentante'];?></small>
    </div>
    <div class="col-sm-3">
    <label for="Aprendiz" > <strong> Telefono: </strong> </label> </br> <small>  <?php echo  $dataPadres['telefonoRepresentante'];?></small>
    </div>
    <div class="col-12">
        <hr style="border: 0.5px solid lightgrey;">
    </div>
<?php  }  ?>

