

<div class="col-sm-12">
<label for="conclucionesRecomendaciones" class="d-block text-center text-white py-2" style="font-size: 1rem; background-color: #00B9F1;">DATOS DEL APRENDIZ</label>
</div>

<div class="col-sm-6">
<label for="Aprendiz" > <strong> Nombre y Apellido: </strong> <?php echo $nombreAprendiz;?></label>  
</div>
<div class="col-sm-6">
<label for="Aprendiz" ><strong> cedulaAprendiz: </strong> <?php echo $cedulaAprendiz;?></label>  
</div>

<div class="col-sm-6">
<label for="Aprendiz" ><strong>fechaNacimientoAprendiz:  </strong> <?php echo date("d-m-Y", strtotime($fechaNacimientoAprendiz)); ?></label>  
</div>
<div class="col-sm-6">
<label for="Aprendiz" ><strong>direccionAprendiz:  </strong> <?php echo $direccionAprendiz;?></label>  
</div>

