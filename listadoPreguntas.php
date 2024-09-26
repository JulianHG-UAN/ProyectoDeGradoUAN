<?php require_once "vistas_admin/parte_sup.php"?>

<!-- Conexion Base de Datos -->
<?php
include_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Consulta 1: Obtener datos de 'employees'
$consulta = "SELECT e.employee_Id, CONCAT(e.employee_name, ' ', e.employee_lastname) AS employee_fullname, a.question_id, q.type_response, a.answer_value 
             FROM employees e 
             LEFT JOIN answers a ON e.employee_Id = a.employee_id 
             LEFT JOIN questions q ON q.question_id = a.question_id";
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
                    <button type="submit" id="lp-btnGuardar" class="btn btn-dark">Guardar</button>
                    <table id="lp-tablaPreguntas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>employee_Id</th>
                                <th>question_id</th>
                                <th>type_response</th>
                                <th>answer_value</th>
                                <th style="display: none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $dat) { ?>
                            <tr>
                                <td data-employee-id="<?php echo $dat['employee_Id']; ?>"><?php echo $dat['employee_fullname']; ?></td>
                                <td><?php echo $dat['question_id'] ?></td>
                                <td><?php echo $dat['type_response'] ?></td>
                                <td><input type="text" value="<?php echo htmlspecialchars($dat['answer_value'], ENT_QUOTES, 'UTF-8'); ?>"></td>
                                <td style="display: none;"></td>
                            </tr>
                            <?php } ?>                         
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>  
    </div> 
</div>

<!-- FIN contenido principal -->

<?php require_once "vistas_admin/parte_inf.php"?>
