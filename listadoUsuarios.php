<?php require_once "vistas_admin/parte_sup.php"?>

<!-- Conexion Base de Datos -->
<?php
include_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Consulta 1: Obtener datos de 'users'
$consulta = "SELECT * FROM users";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- INICIO contenido principal -->

<!-- Tabla -->
<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="tusers_btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo Usuario</button>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id del usuario</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {
                            ?>
                            <tr>
                                <td><?php echo $dat['users_id'] ?></td>
                                <td><?php echo $dat['users_name'] ?></td>
                                <td><?php echo $dat['users_lastname'] ?></td>
                                <td><?php echo $dat['users_email'] ?></td>
                                <td data-password-usuario="<?php echo $dat['password_hash']; ?>"><?php echo str_repeat('*', 8); ?></td>
                                <td data-role-usuario="<?php echo $dat['role_id']; ?>"><?php echo $dat['role_id'] == 1 ? 'Usuario Administrador' : 'Usuario Operador'; ?></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                        </table>                    
                    </div>
                </div>
        </div>  
    </div> 


<!-- Modal para CRUD -->
<div class="modal fade" id="tusers_modalCRUD" tabindex="-1" role="dialog" aria-labelledby="tusers_exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tusers_exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="tusers_formUsers">    
            <div class="modal-body">
                <input type="hidden" id="users_id" name="users_id" value="<?= $users['users_id'] ?? '' ?>">

                <div class="form-group">
                <label for="users_name" class="col-form-label">Nombre del usuario:</label>
                <input type="text" class="form-control" id="users_name">
                </div>

                <div class="form-group">
                <label for="users_lastname" class="col-form-label">Apellido del usuario:</label>
                <input type="text" class="form-control" id="users_lastname">
                </div>

                <div class="form-group">
                <label for="users_email" class="col-form-label">Correo del usuario:</label>
                <input type="text" class="form-control" id="users_email">
                </div>

                <div class="form-group">
                <label for="password_hash" class="col-form-label">Contraseña del usuario:</label>
                <input type="password" class="form-control" id="password_hash">
                <input type="checkbox" onclick="myFunction()"> Mostrar contraseña
                </div>

                <div class="form-group">
                    <label for="role_id" class="col-form-label">Rol del usuario:</label>
                    <select class="form-control" id="role_id" name="role_id">
                        <option value="" selected disabled>Selecciona el Rol</option> <!-- Opción vacía por defecto -->
                        <option value="1">Usuario Administrador</option>
                        <option value="2">Usuario Operador</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="tusers-btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div> 

<!-- FIN contenido principal -->

<?php require_once "vistas_admin/parte_inf.php"?>