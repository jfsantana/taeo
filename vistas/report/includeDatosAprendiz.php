          <div class="card direct-chat direct-chat-primary">
            <div class="card-header bg-info">
                <h3 class="card-title ">
                  <i class="fas fa-user mr-1"></i>
                    Datos del Aprendiz 
                </h3>
                <!-- card tools -->
                <div class="card-tools">

                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse" id='datosAprendiz'>
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <form>
              <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <label for="nombreAprendiz">Nombre</label>
                  <input   readonly  type="text" class="form-control" name="nombreAprendiz" id="nombreAprendiz" placeholder="Nombre(s)" value="<?php echo @$nombreAprendiz; ?>">
                </div>
                <div class="col-sm-3">
                  <label for="apellidoAprendiz">Apellido</label>
                  <input   readonly   readonlytype="text" class="form-control" name="apellidoAprendiz" id="apellidoAprendiz" placeholder="Apellido(s)" value="<?php echo @$apellidoAprendiz; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="cedulaAprendiz">Cédula</label>
                  <input   readonly type="text" class="form-control" name="cedulaAprendiz" id="cedulaAprendiz" placeholder="Cedula del Aprendiz" value="<?php echo @$cedulaAprendiz; ?>">
                </div>

                <div class="col-sm-3">
                  <label>Fecha de Nacimiento:</label>
                  <?php $fechaNacimientoAprendiz = isset($fechaNacimientoAprendiz) ? date('d-m-Y', strtotime($fechaNacimientoAprendiz)) : ''; ?>
                    <input   readonly   type="text" class="form-control" name="fechaNacimientoAprendiz" id="fechaNacimientoAprendiz" value="<?php echo @$fechaNacimientoAprendiz; ?>">

                </div>

                <div class="col-sm-3">
                  <label for="colegioAprendiz">Colegio</label>
                  <input   readonly type="text" class="form-control" name="colegioAprendiz" id="colegioAprendiz" placeholder="Colegio (si aplica)" value="<?php echo @$colegioAprendiz; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="gradoAprendiz">Grado de Escolaridad</label>
                  <input   readonly type="text" class="form-control" name="gradoAprendiz" id="gradoAprendiz" placeholder="Grado de escolaridad  (si aplica)" value="<?php echo @$gradoAprendiz; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="escolaridadAprendiz">Escolaridad</label>
                  <?php if (@$escolaridadAprendiz == 1) {
                    $escolaridadAprendiz = 'Si';
                  } else {
                    $escolaridadAprendiz = 'No';
                  } ?>
                  <input   readonly type="text" class="form-control" name="gradoAprendiz" id="gradoAprendiz" placeholder="Grado de escolaridad  (si aplica)" value="<?php echo @$escolaridadAprendiz; ?>">

                </div>

                <div class="col-sm-3">
                  <label for="direccionAprendiz">Dirección Aprendiz</label>
                  <input   readonly type="text" class="form-control" name="direccionAprendiz" id="direccionAprendiz" placeholder="direccion Aprendiz" value="<?php echo @$direccionAprendiz; ?>">
                </div>


                <div class="col-sm-3">
                  <label for="paisAprendiz">Pais Aprendiz</label>
                  <input   readonly type="text" class="form-control" name="direccionAprendiz" id="direccionAprendiz" placeholder="direccion Aprendiz" value="<?php echo @$paisAprendiz; ?>">

                </div>



                <div class="col-sm-3">
                  <label for="ciudadAprendiz">Ciudad Aprendiz</label>
                  <input   readonly type="text" class="form-control" name="ciudadAprendiz" id="ciudadAprendiz" placeholder="ciudad Aprendiz" value="<?php echo @$ciudadAprendiz; ?>">
                </div>

                <div class="col-sm-3">
                  <label for="facilitadoraAprendiz">Alergias Aprendiz</label>
                  <input   readonly type="text" class="form-control" name="alergiaAprendiz" id="alergiaAprendiz" placeholder="Especifique alguna alergia" value="<?php echo @$alergiaAprendiz; ?>">
                </div>

                </form>

            </div>

          </div>
