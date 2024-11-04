// Call the dataTables jQuery plugin
$(document).ready(function() {
    tablaUsuarios = $('#tablaUsuarios').DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary tusers_btnEditar'>Editar</button><button class='btn btn-danger tusers_btnBorrar'>Borrar</button> </div></div>"
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

    $("#tusers_btnNuevo").click(function(){
        $("#tusers_formUsers").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Usuario");
        $("#tusers_modalCRUD").modal("show");
        users_id=null;
        opcion = 1; //alta
    });

    var fila; //captura la fila, para editar o borrar el registro
    $(document).on("click", ".tusers_btnEditar", function(){
        fila = $(this).closest("tr");
        opcion = 2; //editar
        users_id = parseInt(fila.find('td:eq(0)').text());

        if (!users_id) {
            console.error("No se pudo obtener el ID del usuario.");
            return;
        }

        users_name = fila.find('td:eq(1)').text();
        users_lastname = fila.find('td:eq(2)').text();
        users_email = fila.find('td:eq(3)').text();
        password_hash = parseInt(fila.find('td:eq(4)').data('password-usuario')) || 0;
        role_id = parseInt(fila.find('td:eq(5)').data('role-usuario')) || 2;

        $("#users_name").val(users_name);
        $("#users_lastname").val(users_lastname);
        $("#users_email").val(users_email);
        $("#password_hash").val(password_hash);
        $("#role_id").val(role_id);
        
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Usuario");
        $("#tusers_modalCRUD").modal("show");
    });

    $(document).on("click", ".tusers_btnBorrar", function(){
        fila = $(this);
        opcion = 3 //borrar
        users_id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        var respuesta = confirm("¿Está seguro de eliminar el registro: "+users_id+"?");
        if(respuesta){
            $.ajax({
                url: "bd/crud_usuarios.php",
                type: "POST",
                dataType: "json",
                data: {company_id:users_id, opcion:opcion},
                success: function(){
                    tablaUsuarios.row(fila.parents('tr')).remove().draw();
                }
            });
        }   
    });

    $("#tusers_formUsers").submit(function(e){
        e.preventDefault();
        
        users_id = $.trim($("#users_id").val()) || users_id;
        users_name = $.trim($("#users_name").val());
        users_lastname = $.trim($("#users_lastname").val());
        users_email = $.trim($("#users_email").val());
        password_hash = $.trim($("#password_hash").val());
        role_id = $.trim($("#role_id").val());

        console.log(users_id, users_name, users_lastname, users_email, password_hash, role_id, opcion);

        $.ajax({
            url: "bd/crud_usuarios.php",
            type: "POST",
            dataType: "json",
            data: {users_id:users_id, users_name:users_name, users_lastname:users_lastname, users_email:users_email, password_hash:password_hash, role_id:role_id, opcion:opcion},
            success: function(data){
                console.log(data);
                if(opcion == 1){tablaUsuarios.row.add([data[0].users_id, data[0].users_name, data[0].users_lastname, data[0].users_email, data[0].password_hash, data[0].role_id]).draw(false);}
                else{tablaUsuarios.row(fila).data([data[0].users_id, data[0].users_name, data[0].users_lastname, data[0].users_email, data[0].password_hash, data[0].role_id]).draw(false);}
            }
        });
        $("#tusers_modalCRUD").modal("hide");
    });
});

function myFunction() {
    var x = document.getElementById("password_hash");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}