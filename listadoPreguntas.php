<?php require_once "vistas_user/parte_sup.php"?>

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
$consulta = "SELECT e.employee_Id, CONCAT(e.employee_name, ' ', e.employee_lastname) AS employee_fullname, a.question_id, q.type_response, a.answer_value, q.question_text 
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

                    <table id="lp-tablaPreguntas" class="table table-striped table-bordered" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th style="display: none;">employee_Id</th>
                                <th>Pregunta</th>
                                <th>Tipo Pregunta</th>
                                <th style="width:60%">Respuesta</th>
                                <th style="display: none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Preguntas que tendrán el primer conjunto de valores (0 a 4)
                            $preguntasSet1 = [
                                4, 5, 6, 9, 12, 14, 32, 34, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 
                                50, 51, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68,
                                69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 81, 82, 83, 84, 85, 86, 87,
                                88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 
                                105, 127, 128, 129, 132, 135, 137, 145, 147, 152, 153, 154, 155, 156, 
                                157, 158, 159, 160, 161, 162, 163, 164, 165, 166, 167, 168, 169, 170, 
                                171, 172, 173, 174, 175, 176, 177, 178, 179, 180, 181, 182, 183, 184, 
                                185, 186, 187, 188, 190, 191, 192, 193, 194, 195, 196, 197, 198, 199, 
                                200, 201, 202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 220, 221, 
                                224, 225, 227, 228, 229, 230, 231, 232, 233, 234, 235, 236, 237, 238, 
                                239, 240, 241, 242, 243, 245, 247, 249
                            ];

                            // Preguntas que tienen valores 9, 6, 0, 3, 0
                            $preguntasSet2 = [252, 253, 254, 260, 264, 265, 266, 274, 275];

                            // Preguntas que tienen valores 6, 4, 0, 2, 0
                            $preguntasSet3 = [255, 256, 257, 261, 262, 267, 268, 269, 270, 276, 277, 278, 279];

                            // Preguntas que tienen valores 3, 2, 0, 1, 0
                            $preguntasSet4 = [258, 259, 263, 271, 272, 273, 280, 281, 282];

                            // Inicializa el array de opciones por pregunta
                            $opcionesPorPregunta = [];

                            for ($i = 1; $i <= 123; $i++) {
                                if (in_array($i, $preguntasSet1)) {
                                    // Para las preguntas en el conjunto 1 (con valores de 0 a 4)
                                    $opcionesPorPregunta[$i] = [
                                        'Nunca' => 0,
                                        'Casi Nunca' => 1,
                                        'Algunas Veces' => 2,
                                        'Casi Siempre' => 3,
                                        'Siempre' => 4
                                    ];
                                } elseif (in_array($i, $preguntasSet2)) {
                                    // Para las preguntas en el conjunto 2 (con valores 9, 6, 0, 3, 0)
                                    $opcionesPorPregunta[$i] = [
                                        'Nunca' => 0,
                                        'Casi Nunca' => 3,
                                        'Algunas Veces' => 0,
                                        'Casi Siempre' => 6,
                                        'Siempre' => 9
                                    ];
                                } elseif (in_array($i, $preguntasSet3)) {
                                    // Para las preguntas en el conjunto 3 (con valores 6, 4, 0, 2, 0)
                                    $opcionesPorPregunta[$i] = [
                                        'Nunca' => 0,
                                        'Casi Nunca' => 2,
                                        'Algunas Veces' => 0,
                                        'Casi Siempre' => 4,
                                        'Siempre' => 6
                                    ];
                                } elseif (in_array($i, $preguntasSet4)) {
                                    // Para las preguntas en el conjunto 4 (con valores 3, 2, 0, 1, 0)
                                    $opcionesPorPregunta[$i] = [
                                        'Nunca' => 0,
                                        'Casi Nunca' => 1,
                                        'Algunas Veces' => 0,
                                        'Casi Siempre' => 2,
                                        'Siempre' => 3
                                    ];
                                } else {
                                    // Para las preguntas que no están en los conjuntos anteriores (valores 4 a 0)
                                    $opcionesPorPregunta[$i] = [
                                        'Nunca' => 4,
                                        'Casi Nunca' => 3,
                                        'Algunas Veces' => 2,
                                        'Casi Siempre' => 1,
                                        'Siempre' => 0
                                    ];
                                }
                            };

                            foreach($data as $dat) {
                                $questionId = $dat['question_id'];
                                $answerValue = $dat['answer_value']; // El valor actual de la respuesta
                                $employeeId = $dat['employee_Id'];

                                // Obtener opciones para este question_id, o un set vacío por defecto
                                $opciones = isset($opcionesPorPregunta[$questionId]) ? $opcionesPorPregunta[$questionId] : ['Nunca' => 1, 'Casi Nunca' => 2, 'Algunas Veces' => 3, 'Casi Siempre' => 4, 'Siempre' => 5];
                            ?>
                            <tr>
                                <td style="display: none;" data-employee-id="<?php echo $employeeId; ?>"></td>
                                <td data-question-id="<?php echo $questionId; ?>"><?php echo $dat['question_text']; ?></td>
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

<?php require_once "vistas_user/parte_inf.php"?>
