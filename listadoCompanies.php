<?php require_once "vistas_admin/parte_sup.php"?>

<!-- Conexion Base de Datos -->
<?php
include_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Consulta 1: Obtener datos de 'users'
$consulta = "SELECT * FROM companies";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>


<!-- INICIO contenido principal -->

<!-- Tabla -->
<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="tcomps_btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nueva compañia</button>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="tablaCompanies" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id de la empresa</th>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Es activa?</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {
                            ?>
                            <tr>
                                <td><?php echo $dat['company_id'] ?></td>
                                <td><?php echo $dat['company_name'] ?></td>
                                <td><?php echo $dat['company_address'] ?></td>
                                <td><?php echo $dat['is_active'] ?></td>
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
<div class="modal fade" id="tcomps_modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tcomps_exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="tcomps_formCompanies">    
            <div class="modal-body">
                <input type="hidden" id="company_id" name="company_id" value="<?= $company['company_id'] ?? '' ?>">

                <div class="form-group">
                <label for="company_name" class="col-form-label">Nombre de la compañia:</label>
                <input type="text" class="form-control" id="company_name">
                </div>

                <div class="form-group">
                <label for="company_address" class="col-form-label">Dirección:</label>
                <input type="text" class="form-control" id="company_address">
                </div>

                <div class="form-group">
                <label for="is_active" class="col-form-label">Esta activa?:</label>
                <input type="text" class="form-control" id="is_active">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="tcomps-btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div> 

<!-- FIN contenido principal -->

<?php require_once "vistas_admin/parte_inf.php"?>