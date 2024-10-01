// Call the dataTables jQuery plugin
$(document).ready(function() {
    tablaEmpleados = $('#tablaEmpleados').DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button> <button class='btn btn-warning btnPreguntas'>Preguntas</button> </div></div>"
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

$("#btnNuevo").click(function(){
    $("#formEmpleados").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo empleado");            
    $("#modalCRUD").modal("show");        
    employee_Id=null;
    opcion = 1; //alta
}); 

// Delegamos el evento click para .btnPreguntas en la tabla
$('#tablaEmpleados tbody').on('click', '.btnPreguntas', function() {
    var filaEmp = $(this).closest("tr"); // Encuentra la filaEmp asociada al botón
    var employee_Id = parseInt(filaEmp.find('td:eq(0)').text()) || 0; // Asigna el ID del empleado

    if (!employee_Id) {
        console.error("No se pudo obtener el ID del empleado.");
        return;
    }

    // Redirige a listadoPreguntas.php con el ID del empleado como parámetro
    window.location.href = "listadoPreguntas.php?employee_Id=" + employee_Id;
}); 

var fila; //capturar la fila para editar o borrar el registro

$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    employee_Id = parseInt(fila.find('td:eq(0)').text()) || 0; // Usa un valor por defecto si es undefined
    
    if (!employee_Id) {
        console.error("No se pudo obtener el ID del empleado.");
        return;
    }

    employee_Id = parseInt(fila.find('td:eq(0)').text()) || 0;
    company_id = parseInt(fila.find('td:eq(1)').data('company-id')) || 0;
    employee_Name = fila.find('td:eq(2)').text() || '';
    employee_Secondname = fila.find('td:eq(3)').text() || '';
    employee_Lastname = fila.find('td:eq(4)').text() || '';
    employee_Secondlastname = fila.find('td:eq(5)').text() || '';
    employee_Genero = parseInt(fila.find('td:eq(6)').data('genero-id')) || 0;
    employee_Birthdate = fila.find('td:eq(7)').text() || '';
    employee_EstadoCivil = fila.find('td:eq(8)').data('estadocivil-id') || 0;
    employee_UltimoNivelEstudio = parseInt(fila.find('td:eq(9)').data('nivelestudio-id')) || 0;
    employee_Ocupacion = fila.find('td:eq(10)').text() || '';
    employee_ResidenciaDepartamento = parseInt(fila.find('td:eq(11)').data('residenciadepartamento-id')) || 0;
    employee_ResidenciaCuidad = parseInt(fila.find('td:eq(12)').data('residenciaciudad-id')) || 0;
    employee_EstratoSocial = parseInt(fila.find('td:eq(13)').data('estrato-id')) || 0;
    employee_TipoVivienda = parseInt(fila.find('td:eq(14)').data('tipovivienda-id')) || 0;
    employee_PersonasACargo = parseInt(fila.find('td:eq(15)').text()) || 0;
    employee_TrabajoDepartamento = parseInt(fila.find('td:eq(16)').data('trabajodepartamento-id')) || 0;
    employee_TrabajoCuidad = parseInt(fila.find('td:eq(17)').data('trabajocuidad-id')) || 0;
    employee_TiempoEnEmpresa = parseInt(fila.find('td:eq(18)').text()) || 0;
    employee_NombreCargo = fila.find('td:eq(19)').text() || '';
    employee_TipoCargo = parseInt(fila.find('td:eq(20)').data('tipocargo-id')) || 0;
    employee_TiempoEnCargo = parseInt(fila.find('td:eq(21)').text()) || 0;
    employee_NombreArea = fila.find('td:eq(22)').text() || '';
    employee_TipoContrato = parseInt(fila.find('td:eq(23)').data('tipocontrato-id')) || 0;
    employee_HorasLaborales = parseInt(fila.find('td:eq(24)').text()) || 0;
    employee_TipoSalario = parseInt(fila.find('td:eq(25)').data('tiposalario-id')) || 0;

    $("#company_id").val(company_id);
    $("#employee_Name").val(employee_Name);
    $("#employee_Secondname").val(employee_Secondname);
    $("#employee_Lastname").val(employee_Lastname);
    $("#employee_Secondlastname").val(employee_Secondlastname);
    $("#employee_Genero").val(employee_Genero);
    $("#employee_Birthdate").val(employee_Birthdate);
    $("#employee_EstadoCivil").val(employee_EstadoCivil);
    $("#employee_UltimoNivelEstudio").val(employee_UltimoNivelEstudio);
    $("#employee_Ocupacion").val(employee_Ocupacion);
    $("#employee_ResidenciaDepartamento").val(employee_ResidenciaDepartamento);
    $("#employee_ResidenciaCuidad").val(employee_ResidenciaCuidad);
    $("#employee_EstratoSocial").val(employee_EstratoSocial);
    $("#employee_TipoVivienda").val(employee_TipoVivienda);
    $("#employee_PersonasACargo").val(employee_PersonasACargo);
    $("#employee_TrabajoDepartamento").val(employee_TrabajoDepartamento);
    $("#employee_TrabajoCuidad").val(employee_TrabajoCuidad);
    $("#employee_TiempoEnEmpresa").val(employee_TiempoEnEmpresa);
    $("#employee_NombreCargo").val(employee_NombreCargo);
    $("#employee_TipoCargo").val(employee_TipoCargo);
    $("#employee_TiempoEnCargo").val(employee_TiempoEnCargo);
    $("#employee_NombreArea").val(employee_NombreArea);
    $("#employee_TipoContrato").val(employee_TipoContrato);
    $("#employee_HorasLaborales").val(employee_HorasLaborales);
    $("#employee_TipoSalario").val(employee_TipoSalario);
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Empleado");            
    $("#modalCRUD").modal("show");
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){
    fila = $(this);
    opcion = 3 //borrar
    employee_Id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+employee_Id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud_empleados.php",
            type: "POST",
            dataType: "json",
            data: {employee_Id:employee_Id, opcion:opcion},
            success: function(){
                tablaEmpleados.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});

// Crear empleado
$("#formEmpleados").submit(function(e){
    e.preventDefault();
    
    // Recopilar datos del formulario
    employee_Id = $.trim($("#employee_Id").val()) || employee_Id;
    company_id = $.trim($("#company_id").val());
    employee_Name = $.trim($("#employee_Name").val());
    employee_Secondname = $.trim($("#employee_Secondname").val());
    employee_Lastname = $.trim($("#employee_Lastname").val());
    employee_Secondlastname = $.trim($("#employee_Secondlastname").val());
    employee_Genero = $.trim($("#employee_Genero").val());
    employee_Birthdate = $.trim($("#employee_Birthdate").val());
    employee_EstadoCivil = $.trim($("#employee_EstadoCivil").val());
    employee_UltimoNivelEstudio = $.trim($("#employee_UltimoNivelEstudio").val());
    employee_Ocupacion = $.trim($("#employee_Ocupacion").val());
    employee_ResidenciaDepartamento = $.trim($("#employee_ResidenciaDepartamento").val());
    employee_ResidenciaCuidad = $.trim($("#employee_ResidenciaCuidad").val());
    employee_EstratoSocial = $.trim($("#employee_EstratoSocial").val());
    employee_TipoVivienda = $.trim($("#employee_TipoVivienda").val());
    employee_PersonasACargo = $.trim($("#employee_PersonasACargo").val());
    employee_TrabajoDepartamento = $.trim($("#employee_TrabajoDepartamento").val());
    employee_TrabajoCuidad = $.trim($("#employee_TrabajoCuidad").val());
    employee_TiempoEnEmpresa = $.trim($("#employee_TiempoEnEmpresa").val());
    employee_NombreCargo = $.trim($("#employee_NombreCargo").val());
    employee_TipoCargo = $.trim($("#employee_TipoCargo").val());
    employee_TiempoEnCargo = $.trim($("#employee_TiempoEnCargo").val());
    employee_NombreArea = $.trim($("#employee_NombreArea").val());
    employee_TipoContrato = $.trim($("#employee_TipoContrato").val());
    employee_HorasLaborales = $.trim($("#employee_HorasLaborales").val());
    employee_TipoSalario = $.trim($("#employee_TipoSalario").val());

    // Enviar los datos mediante AJAX
    $.ajax({
        url: "bd/crud_empleados.php",
        type: "POST",
        dataType: "json",
        data: {
            employee_Id: employee_Id,
            company_id: company_id,
            employee_Name: employee_Name,
            employee_Secondname: employee_Secondname,
            employee_Lastname: employee_Lastname,
            employee_Secondlastname: employee_Secondlastname,
            employee_Genero: employee_Genero,
            employee_Birthdate: employee_Birthdate,
            employee_EstadoCivil: employee_EstadoCivil,
            employee_UltimoNivelEstudio: employee_UltimoNivelEstudio,
            employee_Ocupacion: employee_Ocupacion,
            employee_ResidenciaDepartamento: employee_ResidenciaDepartamento,
            employee_ResidenciaCuidad: employee_ResidenciaCuidad,
            employee_EstratoSocial: employee_EstratoSocial,
            employee_TipoVivienda: employee_TipoVivienda,
            employee_PersonasACargo: employee_PersonasACargo,
            employee_TrabajoDepartamento: employee_TrabajoDepartamento,
            employee_TrabajoCuidad: employee_TrabajoCuidad,
            employee_TiempoEnEmpresa: employee_TiempoEnEmpresa,
            employee_NombreCargo: employee_NombreCargo,
            employee_TipoCargo: employee_TipoCargo,
            employee_TiempoEnCargo: employee_TiempoEnCargo,
            employee_NombreArea: employee_NombreArea,
            employee_TipoContrato: employee_TipoContrato,
            employee_HorasLaborales: employee_HorasLaborales,
            employee_TipoSalario: employee_TipoSalario,
            opcion: opcion
        },
        success: function(data){  
            if (!data || !data[0]) {
                console.error("Los datos recibidos están vacíos o no tienen el formato esperado.");
                console.log("Fallido. Respuesta recibida en Alta: ", data);
                return;
            }
            
            // Procesar la respuesta correctamente
            console.log("Exitoso. Respuesta recibida en Alta: ", data);

            // Actualizar tabla con el nuevo empleado
            if (opcion == 1) {
                tablaEmpleados.row.add([
                    data[0].employee_Id,
                    data[0].company_name,
                    data[0].employee_Name, 
                    data[0].employee_Secondname,
                    data[0].employee_Lastname,
                    data[0].employee_Secondlastname,
                    data[0].genero,
                    data[0].employee_Birthdate,
                    data[0].estado_civil,
                    data[0].nivel_estudio,
                    data[0].employee_Ocupacion,
                    data[0].residencia_departamento,
                    data[0].residencia_ciudad,
                    data[0].estrato,
                    data[0].tipo_vivienda,
                    data[0].employee_PersonasACargo,
                    data[0].departamento,
                    data[0].ciudad,
                    data[0].employee_TiempoEnEmpresa,
                    data[0].employee_NombreCargo,
                    data[0].tipo_cargo,
                    data[0].employee_TiempoEnCargo,
                    data[0].employee_NombreArea,
                    data[0].tipo_contrato,
                    data[0].employee_HorasLaborales,
                    data[0].tipo_salario
                ]).draw(false);  // Llama a draw(false) para evitar reinicializar la tabla completamente.
            } else {
                tablaEmpleados.row(fila).data([
                    data[0].employee_Id, 
                    data[0].company_name, 
                    data[0].employee_Name, 
                    data[0].employee_Secondname,
                    data[0].employee_Lastname,
                    data[0].employee_Secondlastname,
                    data[0].genero,
                    data[0].employee_Birthdate,
                    data[0].estado_civil,
                    data[0].nivel_estudio,
                    data[0].employee_Ocupacion,
                    data[0].residencia_departamento,
                    data[0].residencia_ciudad,
                    data[0].estrato,
                    data[0].tipo_vivienda,
                    data[0].employee_PersonasACargo,
                    data[0].departamento,
                    data[0].ciudad,
                    data[0].employee_TiempoEnEmpresa,
                    data[0].employee_NombreCargo,
                    data[0].tipo_cargo,
                    data[0].employee_TiempoEnCargo,
                    data[0].employee_NombreArea,
                    data[0].tipo_contrato,
                    data[0].employee_HorasLaborales,
                    data[0].tipo_salario
                ]).draw(false);
            }

            // Cerrar el modal después de agregar el empleado
            $("#modalCRUD").modal("hide");
        }
    });
});
});