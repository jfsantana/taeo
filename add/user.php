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
                  <?php
                    echo 'Rol:'.$_SESSION['des_rol']. '<br><br>(Acceso a Sede:<br>' ;
                    if(isset($_SESSION['nombreSede'] ))
                      $sedes = explode('*', $_SESSION['nombreSede']);
                      foreach ($sedes as $index => $sede) {
                          if ($index === count($sedes) - 1) {
                              echo $sede . ')<br>';
                          } else {
                              echo $sede . '<br>';
                          }
                      }
                    ;
                  ?></a>
        </div>
      </div>


