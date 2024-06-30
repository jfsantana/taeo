<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

//FACILITADORES
function fetchNiveles(idSede) {
    var nivelSelect = $('#idFacilitador');
    if (idSede) {
      console.log('VER PARA EL AREA:', idSede); // Agrega esta línea para depuración
      $.ajax({
        type: "POST",
        url: "planning/fetch_facilitadores.php",
        data: { idSede: idSede },
        success: function(response) {
          console.log('Response:', response); // Agrega esta línea para depuración
          var niveles = JSON.parse(response);
          // Limpia las opciones actuales
          nivelSelect.empty();
          nivelSelect.append('<option value="">Seleccione</option>');
          // Agrega las nuevas opciones
          niveles.forEach(function(nivel) {
            nivelSelect.append('<option value="' + nivel.idUsuario + '">' + nivel.facilitador + '</option>');
          });
          // Habilita el campo
          nivelSelect.prop('disabled', false);
        },
        error: function(xhr, status, error) {
          console.error('Error al obtener niveles:', error);
        }
      });
    } else {
      // Si no hay idSede, deshabilita el campo y restaura la opción predeterminada
      nivelSelect.prop('disabled', true);
      nivelSelect.empty();
      nivelSelect.append('<option value="">Seleccione</option>');
    }
  }


  //SelectPadre
  function fetchSelectPadre(idArea, nivelObjetivo, nivelNodo, valorPadre, objeto) {

    var nivelSelect = $(objeto);  // aqui se coloca el #ID DEL SELECT QUE QUEREMOS DESBLOQUEAR
    if (nivelObjetivo) {
      console.log('VER PARA EL idArea:', idArea); // Agrega esta línea para depuración
      console.log('VER PARA EL nivelObjetivo:', nivelObjetivo); // Agrega esta línea para depuración
      console.log('VER PARA EL nivelNodo:', nivelNodo); // Agrega esta línea para depuración
      console.log('VER PARA EL valorPadre:', valorPadre); // Agrega esta línea para depuración
      $.ajax({
        type: "POST",
        url: "planning/fetch_SelectEstructura.php",
        data: {
                idArea: idArea,
                nivelObjetivo: nivelObjetivo,
                nivelNodo: nivelNodo,
                valorPadre: valorPadre
               },
        success: function(response) {
          console.log('Response:', response); // Agrega esta línea para depuración
          var niveles = JSON.parse(response);
          // Limpia las opciones actuales
          nivelSelect.empty();
          nivelSelect.append('<option value="">Seleccione</option>');
          // Agrega las nuevas opciones
          niveles.forEach(function(nivel) {
            nivelSelect.append('<option value="' + nivel.jerarquia + '">' + nivel.jerarquia +  '-' + nivel.descripcion + '</option>');
          });
          // Habilita el campo
          nivelSelect.prop('disabled', false);
        },
        error: function(xhr, status, error) {
          console.error('Error al obtener niveles:', error);
        }
      });
    } else {
      // Si no hay nivelObjetivo, deshabilita el campo y restaura la opción predeterminada
      nivelSelect.prop('disabled', true);
      nivelSelect.empty();
      nivelSelect.append('<option value="">Seleccione</option>');
    }
  }



  </script>
