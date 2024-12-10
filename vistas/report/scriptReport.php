<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

// mediadores
function fetchMediadores(idSede,idEvaluadoPor) {
  
  const container = document.getElementById('idFacilitadorContainer');
  
  if (idSede === '') {
    container.innerHTML = ''; // Clear existing checkboxes
    return; // Exit the function
  }

  const token = '<?php echo $_SESSION['token']; ?>';
  const protocol = window.location.protocol;
  const url = `${protocol}//${window.location.host}/funciones/wsdl/empleados?type=5&idSede=${idSede}`;

  fetch(url, {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`
    }
  })
  .then(response => response.json())
  .then(data => {
    container.innerHTML = ''; // Clear existing checkboxes

    // Convert idEvaluadoPor to an array of strings
    const evaluadoPorArray = idEvaluadoPor ? idEvaluadoPor.split(',') : [];


    data.forEach(facilitador => {
      const checkbox = document.createElement('input');
      checkbox.type = 'checkbox';
      checkbox.name = 'idEvaluadoPor[]';
      checkbox.value = facilitador.idUsuario;
      checkbox.id = `facilitador_${facilitador.idUsuario}`;

      if (evaluadoPorArray.includes(facilitador.idUsuario.toString())) {
        checkbox.checked = true;
      }

      const label = document.createElement('label');
      label.htmlFor = `facilitador_${facilitador.idUsuario}`;
      label.textContent = `${facilitador.facilitador}(${facilitador.descripcionCargo})`;

      const div = document.createElement('div');
      div.appendChild(checkbox);
      div.appendChild(label);

      container.appendChild(div);
    });
  })
  .catch(error => console.error('Error fetching mediadores:', error));
}

//Evaluacion Previas (fechas)
function fetchNiveles(idAprendiz,mod) {
  var idHeaderEvaluacionAnterior = $('#idHeaderEvaluacionAnterior');
  if (idAprendiz) {
    console.log('VER PARA EL idAprendiz:', idAprendiz); // Agrega esta línea para depuración
    $.ajax({
      type: "POST",
      url: "preEvaluacion/fetch_evaluaciones_previas.php",
      data: { idAprendiz: idAprendiz },
      success: function(response) {
        //console.log('Response:', response); // Agrega esta línea para depuración
        try {
          var niveles = JSON.parse(response);
          if (Array.isArray(niveles) && niveles.length > 0) { // Verifica si niveles es un array y tiene elementos
            idHeaderEvaluacionAnterior.empty();
            
            // Agrega las nuevas opciones
            niveles.forEach(function(nivel) {
              if( nivel.fechaEvaluacion == "0000-00-00")
              {
                idHeaderEvaluacionAnterior.append('<option value="">No hay evaluaciones previas</option>');
              }else{
                idHeaderEvaluacionAnterior.append('<option value="' + nivel.idHeaderEvaluacion + '">' + nivel.fechaEvaluacion + '</option>');
              }              
            });

            // Ajusta el estado del campo según el valor de mod
            if (mod == 2) {
              idHeaderEvaluacionAnterior.prop('disabled', true);
            } else if (mod == 1) {
              idHeaderEvaluacionAnterior.prop('disabled', false);
            }
          } else {
            idHeaderEvaluacionAnterior.empty();
            idHeaderEvaluacionAnterior.append('<option value="">No hay evaluaciones previas</option>');
            idHeaderEvaluacionAnterior.prop('disabled', true);
          }
        } catch (e) {
          console.error('Error al parsear el JSON:', e);
          idHeaderEvaluacionAnterior.empty();
          idHeaderEvaluacionAnterior.append('<option value="">Error al obtener evaluaciones</option>');
          idHeaderEvaluacionAnterior.prop('disabled', true);
        }
      },
      error: function(xhr, status, error) {
        console.error('Error al obtener niveles:', error);
        idHeaderEvaluacionAnterior.empty();
        idHeaderEvaluacionAnterior.append('<option value="">Error al obtener evaluaciones</option>');
        idHeaderEvaluacionAnterior.prop('disabled', true);
      }
    });
  } else {
    // Si no hay idAprendiz, deshabilita el campo y restaura la opción predeterminada
    idHeaderEvaluacionAnterior.prop('disabled', true);
    idHeaderEvaluacionAnterior.empty();
    idHeaderEvaluacionAnterior.append('<option value="">Seleccione</option>');
  }
}


  </script>
