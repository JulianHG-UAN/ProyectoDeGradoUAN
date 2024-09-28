<?php require_once "vistas_admin/parte_sup.php"?>

<!-- Conexion Base de Datos -->
<?php
include_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Verificamos si existe el parámetro employee_Id en la URL
$employee_Id = isset($_GET['employee_Id']) ? $_GET['employee_Id'] : 0;

if ($employee_Id) {
    // Consulta para obtener el nombre completo del empleado
    $consultaEmpleado = "SELECT employee_name, employee_lastname FROM employees WHERE employee_Id = :employee_Id";
    $resultadoEmpleado = $conexion->prepare($consultaEmpleado);
    $resultadoEmpleado->bindParam(':employee_Id', $employee_Id, PDO::PARAM_INT);
    $resultadoEmpleado->execute();
    $empleado = $resultadoEmpleado->fetch(PDO::FETCH_ASSOC);
}

// Consulta 1: Obtener datos de 'employees'
$consulta = "SELECT e.employee_Id, CONCAT(e.employee_name, ' ', e.employee_lastname) AS employee_fullname, a.question_id, q.type_response, a.answer_value 
             FROM employees e 
             LEFT JOIN answers a ON e.employee_Id = a.employee_id 
             LEFT JOIN questions q ON q.question_id = a.question_id
             WHERE e.employee_Id = :employee_Id";  // Filtrar por employee_Id
$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':employee_Id', $employee_Id, PDO::PARAM_INT);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- INICIO contenido principal -->

<!-- Muestra el nombre del empleado si se encontró -->
<div class="container">
    <?php if ($empleado) { ?>
        <h2>Empleado: <?php echo htmlspecialchars($empleado['employee_name'] . ' ' . $empleado['employee_lastname'], ENT_QUOTES, 'UTF-8'); ?></h2>
    <?php } else { ?>
        <h2>Empleado no encontrado</h2>
    <?php } ?>
</div>

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
