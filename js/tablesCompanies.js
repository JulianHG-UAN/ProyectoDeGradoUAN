// Call the dataTables jQuery plugin
$(document).ready(function() {
    tablaCompanies = $('#tablaCompanies').DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary tcomps_btnEditar'>Editar</button><button class='btn btn-danger tcomps_btnBorrar'>Borrar</button> <button class='btn btn-warning tcomps_btnAsignUsuarios'>Asignar usuarios</button> </div></div>"
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

    $("#tcomps_btnNuevo").click(function(){
        $("#tcomps_formCompanies").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Compañia");
        $("#tcomps_modalCRUD").modal("show");
        company_id=null;
        opcion = 1; //alta
    });

    var fila; //captura la fila, para editar o borrar el registro
    $(document).on("click", ".tcomps_btnEditar", function(){
        fila = $(this).closest("tr");
        opcion = 2; //editar
        company_id = parseInt(fila.find('td:eq(0)').text());

        if (!company_id) {
            console.error("No se pudo obtener el ID del la compañia.");
            return;
        }

        company_name = fila.find('td:eq(1)').text();
        company_address = fila.find('td:eq(2)').text();
        is_active = fila.find('td:eq(3)').text();

        $("#company_name").val(company_name);
        $("#company_address").val(company_address);
        $("#is_active").val(is_active);

        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Compañia");
        $("#tcomps_modalCRUD").modal("show");
    });

    $(document).on("click", ".tcomps_btnBorrar", function(){
        fila = $(this);
        opcion = 3 //borrar
        company_id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        var respuesta = confirm("¿Está seguro de eliminar el registro: "+company_id+"?");
        if(respuesta){
            $.ajax({
                url: "bd/crud_companies.php",
                type: "POST",
                dataType: "json",
                data: {company_id:company_id, opcion:opcion},
                success: function(){
                    tablaCompanies.row(fila.parents('tr')).remove().draw();
                }
            });
        }   
    });

    $("#tcomps_formCompanies").submit(function(e){
        e.preventDefault();
        
        company_id = $.trim($("#company_id").val()) || company_id;
        company_name = $.trim($("#company_name").val());
        company_address = $.trim($("#company_address").val());
        is_active = $.trim($("#is_active").val());

        $.ajax({
            url: "bd/crud_companies.php",
            type: "POST",
            dataType: "json",
            data: {company_id:company_id, company_name:company_name, company_address:company_address, is_active:is_active, opcion:opcion},
            success: function(data){
                console.log(data);
                company_id = data[0].company_id;
                company_name = data[0].company_name;
                company_address = data[0].company_address;
                is_active = data[0].is_active;
                if(opcion == 1){tablaCompanies.row.add([company_id,company_name,company_address,is_active]).draw();}
                else{tablaCompanies.row(fila).data([company_id,company_name,company_address,is_active]).draw();}
            }
        });
        $("#tcomps_modalCRUD").modal("hide");
    });
});