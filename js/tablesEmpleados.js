// Call the dataTables jQuery plugin
$(document).ready(function() {
    tablaEmpleados = $('#tablaEmpleados').DataTable({
        "columnDefs": [{
            "targets": 0,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"
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

var fila; //capturar la fila para editar o borrar el registro

//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    employee_Id = parseInt(fila.find('td:eq(0)').text());
    company_id = parseInt(fila.find('td:eq(1)').text());
    employee_Name = fila.find('td:eq(2)').text();
    employee_Secondname = fila.find('td:eq(3)').text();
    employee_Lastname = fila.find('td:eq(4)').text();
    employee_Secondlastname = fila.find('td:eq(5)').text();
    employee_Genero = parseInt(fila.find('td:eq(6)').text());
    employee_Birthdate = fila.find('td:eq(7)').text();
    employee_EstadoCivil = parseInt(fila.find('td:eq(8)').text());
    employee_UltimoNivelEstudio = parseInt(fila.find('td:eq(9)').text());
    employee_Ocupacion = fila.find('td:eq(10)').text();
    employee_ResidenciaDepartamento = parseInt(fila.find('td:eq(11)').text());
    employee_ResidenciaCuidad = parseInt(fila.find('td:eq(12)').text());
    employee_EstratoSocial = parseInt(fila.find('td:eq(13)').text());
    employee_TipoVivienda = parseInt(fila.find('td:eq(14)').text());
    employee_PersonasACargo = parseInt(fila.find('td:eq(15)').text());
    employee_TrabajoDepartamento = parseInt(fila.find('td:eq(16)').text());
    employee_TrabajoCuidad = parseInt(fila.find('td:eq(17)').text());
    employee_TiempoEnEmpresa = parseInt(fila.find('td:eq(18)').text());
    employee_NombreCargo = fila.find('td:eq(19)').text();
    employee_TipoCargo = parseInt(fila.find('td:eq(20)').text());
    employee_TiempoEnCargo = parseInt(fila.find('td:eq(21)').text());
    employee_NombreArea = fila.find('td:eq(22)').text();
    employee_TipoContrato = parseInt(fila.find('td:eq(23)').text());
    employee_HorasLaborales = parseInt(fila.find('td:eq(24)').text());
    employee_TipoSalario = parseInt(fila.find('td:eq(25)').text());
    
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
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Empleado");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud_empleados.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaEmpleados.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});

// Crear empleado
$("#formEmpleados").submit(function(e){
    e.preventDefault();
    employee_Id = $.trim($("#employee_Id").val());
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
    $.ajax({
        url: "bd/crud_empleados.php",
        type: "POST",
        dataType: "json",
        data: {opcion:opcion, employee_Id:employee_Id, company_id:company_id, employee_Name:employee_Name, employee_Secondname:employee_Secondname, employee_Lastname:employee_Lastname, employee_Secondlastname:employee_Secondlastname, employee_Genero:employee_Genero, employee_Birthdate:employee_Birthdate, employee_EstadoCivil:employee_EstadoCivil, employee_UltimoNivelEstudio:employee_UltimoNivelEstudio, employee_Ocupacion:employee_Ocupacion, employee_ResidenciaDepartamento:employee_ResidenciaDepartamento, employee_ResidenciaCuidad:employee_ResidenciaCuidad, employee_EstratoSocial:employee_EstratoSocial, employee_TipoVivienda:employee_TipoVivienda, employee_PersonasACargo:employee_PersonasACargo, employee_TrabajoDepartamento:employee_TrabajoDepartamento, employee_TrabajoCuidad:employee_TrabajoCuidad, employee_TiempoEnEmpresa:employee_TiempoEnEmpresa, employee_NombreCargo:employee_NombreCargo, employee_TipoCargo:employee_TipoCargo, employee_TiempoEnCargo:employee_TiempoEnCargo, employee_NombreArea:employee_NombreArea, employee_TipoContrato:employee_TipoContrato, employee_HorasLaborales:employee_HorasLaborales, employee_TipoSalario:employee_TipoSalario},
        success: function(data){  
            console.log(data);
            employee_Id = data[0].employee_Id;
            company_id = data[0].company_id;
            employee_Name = data[0].employee_Name;
            employee_Secondname = data[0].employee_Secondname;
            employee_Lastname = data[0].employee_Lastname;
            employee_Secondlastname = data[0].employee_Secondlastname;
            employee_Genero = data[0].employee_Genero;
            employee_Birthdate = data[0].employee_Birthdate;
            employee_EstadoCivil = data[0].employee_EstadoCivil;
            employee_UltimoNivelEstudio = data[0].employee_UltimoNivelEstudio;
            employee_Ocupacion = data[0].employee_Ocupacion;
            employee_ResidenciaDepartamento = data[0].employee_ResidenciaDepartamento;
            employee_ResidenciaCuidad = data[0].employee_ResidenciaCuidad;
            employee_EstratoSocial = data[0].employee_EstratoSocial;
            employee_TipoVivienda = data[0].employee_TipoVivienda;
            employee_PersonasACargo = data[0].employee_PersonasACargo;
            employee_TrabajoDepartamento = data[0].employee_TrabajoDepartamento;
            employee_TrabajoCuidad = data[0].employee_TrabajoCuidad;
            employee_TiempoEnEmpresa = data[0].employee_TiempoEnEmpresa;
            employee_NombreCargo = data[0].employee_NombreCargo;
            employee_TipoCargo = data[0].employee_TipoCargo;
            employee_TiempoEnCargo = data[0].employee_TiempoEnCargo;
            employee_NombreArea = data[0].employee_NombreArea;
            employee_TipoContrato = data[0].employee_TipoContrato;
            employee_HorasLaborales = data[0].employee_HorasLaborales;
            employee_TipoSalario = data[0].employee_TipoSalario;

            if(opcion == 1){tablaEmpleados.row.add([employee_Id, company_id, employee_Name, employee_Secondname, employee_Lastname, employee_Secondlastname, employee_Genero, employee_Birthdate, employee_EstadoCivil, employee_UltimoNivelEstudio, employee_Ocupacion, employee_ResidenciaDepartamento, employee_ResidenciaCuidad, employee_EstratoSocial, employee_TipoVivienda, employee_PersonasACargo, employee_TrabajoDepartamento, employee_TrabajoCuidad, employee_TiempoEnEmpresa, employee_NombreCargo, employee_TipoCargo, employee_TiempoEnCargo, employee_NombreArea, employee_TipoContrato, employee_HorasLaborales, employee_TipoSalario]).draw();}
            else{tablaEmpleados.row(fila).data([employee_Id, company_id, employee_Name, employee_Secondname, employee_Lastname, employee_Secondlastname, employee_Genero, employee_Birthdate, employee_EstadoCivil, employee_UltimoNivelEstudio, employee_Ocupacion, employee_ResidenciaDepartamento, employee_ResidenciaCuidad, employee_EstratoSocial, employee_TipoVivienda, employee_PersonasACargo, employee_TrabajoDepartamento, employee_TrabajoCuidad, employee_TiempoEnEmpresa, employee_NombreCargo, employee_TipoCargo, employee_TiempoEnCargo, employee_NombreArea, employee_TipoContrato, employee_HorasLaborales, employee_TipoSalario]).draw();}            
        }     
    });
    $("#modalCRUD").modal("hide");
});
});