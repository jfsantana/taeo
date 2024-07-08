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


  document.addEventListener('DOMContentLoaded', function() {
      var selectAllCheckbox = document.getElementById('selectAll');


      function toggleAllCheckboxes(selectAll) {
        var checkboxes = document.querySelectorAll('#tableActividad tbody input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
          checkbox.checked = selectAll.checked;
        });
      }

      selectAllCheckbox.addEventListener('change', function() {
        toggleAllCheckboxes(this);
      });


    });

  //SelectPadre
  function fetchSelectPadre(idArea, nivelObjetivo, nivelNodo, valorPadre, objeto) {
    var table = $('#tableActividad');
    var nivelSelect = $(objeto);  // aqui se coloca el #ID DEL SELECT QUE QUEREMOS DESBLOQUEAR
    var selectIds = ['#nivelPadre', '#nivel1', '#nivel2', '#nivel3', '#nivel4']; // IDs de los select anidados

    var currentIndex = selectIds.indexOf(objeto);
    for (var i = currentIndex + 1; i < selectIds.length; i++) {
        $(selectIds[i]).prop('disabled', true);
        $(selectIds[i]).empty().append('<option value="">Seleccione</option>');
    }

    // Limpiar la tabla tableActividad al iniciar la búsqueda
    table.find('tbody').empty();
    $('#selectAll').prop('disabled', true);

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
            console.log('Response:', response);
          // Agrega esta línea para depuración
            var niveles = JSON.parse(response);
            // Limpia las opciones actuales
            nivelSelect.empty();
            nivelSelect.append('<option value="">Seleccione</option>');
          // Agrega las nuevas opciones
            niveles['valores'].forEach(function(nivel) {
              nivelSelect.append('<option value="' + nivel.jerarquia + '">' + nivel.jerarquia +  '-' + nivel.descripcion + '</option>');
            });
          // Habilita el campo
          if(niveles['abuelo']==1)
            nivelSelect.prop('disabled', false);
          else{
            nivelSelect.prop('disabled', true);
            // Llena la tabla tableActividad con los resultados
            table.find('tbody').empty(); // Limpia las filas actuales de la tabla
                    niveles['valores'].forEach(function(nivel) {
                        var row = '<tr>' +
                                    '<td><input type="checkbox" name="Representante[]" value="' + nivel.jerarquia + '"></td>' +
                                    '<td>' + nivel.descripcion + '</td>' +
                                  '</tr>';
                        table.find('tbody').append(row);
                    });
                    // Habilitar los checkboxes de "seleccionar todo" después de cargar los datos
            $('#selectAll').prop('disabled', false);
          }

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
