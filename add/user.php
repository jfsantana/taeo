<?php
if (!isset($_SESSION)) {
      session_start();
  }
  ?>
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block">
              <?php  echo $_SESSION['nombre']; ?>
              </br>
              (
                  <?php
                    echo $_SESSION['des_rol'] ;
                    if(isset($_SESSION['nombreEmpresaConsultora'] ))
                    echo ' / '.$_SESSION['sedeNombre'];
                    ;
                  ?>)</a>
        </div>
      </div>


