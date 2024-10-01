// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#tablaEmpleados').DataTable();
});

// Call the dataTables jQuery plugin
$(document).ready(function() {
  tablaPreguntas = $('#lp-tablaPreguntas').DataTable({
      "columnDefs": [{
          "targets": -1,
          "data": null,
      }],
      "lengthMenu": [
            [25],
            [25]
      ],
      "language": {
          "lengthMenu": "Mostrar _MENU_ registros",
          "zeroRecords": "No se encontraron resultados",
          "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sSearch": "Buscar:",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast":"Último",
              "sNext":"Siguiente",
              "sPrevious": "Anterior"
           },
           "sProcessing":"Procesando...",
      }
  });

    // Guardar cambios al hacer click en el botón
    $("#lp-btnGuardar").click(function(e){
      e.preventDefault(); // Prevenir el comportamiento por defecto
  
      // Recopilar datos de la tabla
      let answers = [];
  
      $('#lp-tablaPreguntas tbody tr').each(function() {
        let employee_id = $(this).find('td').eq(0).data('employee-id');
        let question_id = $(this).find('td').eq(1).text();
        let answer_value = $(this).find('input').val();
    
        console.log({ employee_id, question_id, answer_value });  // Muestra los valores en la consola para verificar
    
        if (employee_id && question_id && answer_value) {
            answers.push({
                employee_id: employee_id,
                question_id: question_id,
                answer_value: answer_value
            });
        }
    });
    
    console.log("Datos recolectados: ", answers);
    
      // Enviar los datos mediante AJAX
      $.ajax({
          url: "bd/update_answers.php",
          type: "POST",
          dataType: "json",
          data: {
              answers: answers // Enviamos un array con los datos de las respuestas
          },
          success: function(data){  
              if (!data || !data[0]) {
                  console.log("Datos vacíos o incorrectos:", data);
                  alert("Datos guardados correctamente");
                  return;
              }
              // Procesar la respuesta y actualizar la tabla si es necesario
              console.log("Respuesta exitosa del servidor:", data);
          },
          error: function(xhr, status, error) {
              console.error("Error en la petición:", error);
          }
      });
    });  
});

$(document).ready(function() {    
    $('#lp-tablaDatos').DataTable({        
        language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',    
        buttons:[ 
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel"></i> ',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
			{
				extend:    'pdfHtml5',
				text:      '<i class="fas fa-file-pdf"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger'
			},
		]	        
    });     
});