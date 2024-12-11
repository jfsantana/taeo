<div class="row">
    <div class="col-sm-12">
        <label for="conclucionesRecomendaciones" class="d-block text-center text-white py-1" style="font-size: 0.8rem; background-color: #2570a1;"><strong>DATOS DEL APRENDIZ</strong></label>
    </div>

    <div class="col-sm-6 mb-1">
        <label for="Aprendiz"><strong>Nombre y Apellido:</strong> <?php echo $nombreAprendiz; ?></label>
    </div>
    <div class="col-sm-6 mb-1">
        <label for="Aprendiz"><strong>cedulaAprendiz:</strong> <?php echo $cedulaAprendiz; ?></label>
    </div>

    <div class="col-sm-6 mb-1">
        <label for="Aprendiz"><strong>fechaNacimientoAprendiz:</strong> <?php echo date("d-m-Y", strtotime($fechaNacimientoAprendiz)); ?></label>
    </div>
    <div class="col-sm-6 mb-1">
        <label for="Aprendiz"><strong>direccionAprendiz:</strong> <?php echo $direccionAprendiz; ?></label>
    </div>
</div>


