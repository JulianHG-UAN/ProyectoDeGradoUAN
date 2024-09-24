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
          "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary lp-btnEditar'>Editar</button>"
      }],
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

  $(document).on("click", ".lp-btnEditar", function(){
    fila = $(this).closest("tr");
    employee_id = parseInt(fila.find('td:eq(0)').text()) || 0; // Usa un valor por defecto si es undefined
    question_id = parseInt(fila.find('td:eq(1)').text());
    answer_value = parseInt(fila.find('td:eq(3)').text());

    if (!employee_id) {
        console.error("No se pudo obtener el ID del empleado.");
        return;
    }

    console.log("employee_id: ", employee_id, " question_id: ", question_id, " answer_value: ", answer_value);

    $("#lp-question_id").val(question_id);
    $("#lp-answer_value").val(answer_value);
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Respuesta");            
    $("#lp-modalCRUD").modal("show");
  });

  // Crear empleado
  $("#lp-formPreguntas").submit(function(e){
    e.preventDefault();
    
    // Recopilar datos del formulario
    employee_id = $.trim($("#employee_id").val()) || employee_id;
    question_id = $.trim($("#lp-question_id").val());
    answer_value = $.trim($("#lp-answer_value").val());

    // Enviar los datos mediante AJAX
    $.ajax({
        url: "bd/update_answers.php",
        type: "POST",
        dataType: "json",
        data: {
            employee_id: employee_id,
            question_id: question_id,
            answer_value: answer_value
        },
        success: function(data){  
            if (!data || !data[0]) {
                console.log(employee_id, question_id, answer_value);
                console.error("Los datos recibidos están vacíos o no tienen el formato esperado.");
                console.log("Fallido. Respuesta recibida en Alta: ", data);
                return;
            }
            // Procesar la respuesta correctamente
            var datos = JSON.parse(data);
            console.log("Exitoso. Respuesta recibida en Alta: ", data);
            tablaPreguntas.row(fila).data([data[0].employee_id, data[0].question_id, data[0].answer_value]).draw();
            $("#lp-modalCRUD").modal("hide");
        }
    });
  });
});