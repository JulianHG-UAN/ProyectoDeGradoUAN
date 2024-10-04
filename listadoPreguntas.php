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
                    <button onclick="history.back()" class="btn btn-dark">Volver</button>

                    <table id="lp-tablaPreguntas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th style="display: none;">employee_Id</th>
                                <th>question_id</th>
                                <th>type_response</th>
                                <th>answer_value</th>
                                <th style="display: none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Array asociativo que asigna los valores a cada question_id
                            $opcionesPorPregunta = [
                                1 => ['Nunca' => 1, 'Casi Nunca' => 2, 'Algunas Veces' => 3, 'Casi Siempre' => 4, 'Siempre' => 5],
                                2 => ['Nunca' => 10, 'Casi Nunca' => 20, 'Algunas Veces' => 30, 'Casi Siempre' => 40, 'Siempre' => 50],
                                // Añadir más question_id con sus respectivos valores
                            ];

                            foreach($data as $dat) {
                                $questionId = $dat['question_id'];
                                $answerValue = $dat['answer_value']; // El valor actual de la respuesta
                                $employeeId = $dat['employee_Id'];

                                // Obtener opciones para este question_id, o un set vacío por defecto
                                $opciones = isset($opcionesPorPregunta[$questionId]) ? $opcionesPorPregunta[$questionId] : ['Nunca' => 1, 'Casi Nunca' => 2, 'Algunas Veces' => 3, 'Casi Siempre' => 4, 'Siempre' => 5];
                            ?>
                            <tr>
                                <td style="display: none;" data-employee-id="<?php echo $employeeId; ?>"></td>
                                <td><?php echo $questionId; ?></td>
                                <td><?php echo $dat['type_response']; ?></td>
                                <td>
                                    <?php foreach ($opciones as $label => $value): ?>
                                        <div class="form-check form-check-inline">
                                            <!-- Se asegura que cada grupo de radio buttons tenga un nombre único basado en el question_id -->
                                            <input class="form-check-input" type="radio" name="answer_value_<?php echo $questionId; ?>" value="<?php echo $value; ?>" <?php echo $answerValue == $value ? 'checked' : ''; ?>>
                                            <label class="form-check-label"><?php echo $label; ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </td>
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
