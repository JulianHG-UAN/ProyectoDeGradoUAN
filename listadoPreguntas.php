<?php require_once "vistas_admin/parte_sup.php"?>

<!-- Conexion Base de Datos -->
<?php
include_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Consulta 1: Obtener datos de 'employees'
$consulta = "SELECT e.employee_Id, a.question_id, q.type_response, a.answer_value FROM employees e LEFT JOIN answers a ON e.employee_Id = a.employee_id LEFT JOIN questions q ON q.question_id = a.question_id";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- INICIO contenido principal -->

<!-- Tabla -->
<div class="container">
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="lp-tablaPreguntas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>employee_Id</th>
                                <th>question_id</th>
                                <th>type_response</th>
                                <th>answer_value</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {
                            ?>
                            <tr>
                                <td><?php echo $dat['employee_Id'] ?></td>
                                <td><?php echo $dat['question_id'] ?></td>
                                <td><?php echo $dat['type_response'] ?></td>
                                <td><?php echo $dat['answer_value'] ?></td>
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
<div class="modal fade" id="lp-modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="lp-formPreguntas">    
            <div class="modal-body">

                <div class="form-group">
                <label for="question_id" class="col-form-label">question_id:</label>
                <input type="text" class="form-control" id="lp-question_id">
                </div>

                <div class="form-group">
                <label for="answer_value" class="col-form-label">answer_value:</label>
                <input type="text" class="form-control" id="lp-answer_value">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="lp-btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div> 



<!-- FIN contenido principal -->

<?php require_once "vistas_admin/parte_inf.php"?>