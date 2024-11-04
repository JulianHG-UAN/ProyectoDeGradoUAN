<?php require_once "vistas_user/parte_sup.php"?>

<!-- INICIO contenido principal -->

<!-- Conexion Base de Datos -->
<?php
include_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Preparar la consulta del procedimiento almacenado
$consulta = "CALL ObtenerResultados()";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$datos = $resultado->fetchAll(PDO::FETCH_ASSOC); // Obtiene los resultados como un array asociativo
?>

<!-- Tabla -->
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <a href="graficas.php" class="btn btn-success">Ver gráficas</a>
                    <button onclick="history.back()" class="btn btn-dark">Volver</button>
                    <table id="lp-tablaDatos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Nombre completo</th>
                                <th>Tipo de Cargo</th>
                                <th>Dimensión: Características del liderazgo - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Características del liderazgo - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Relaciones sociales en el trabajo - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Relaciones sociales en el trabajo - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Retroalimentación del desempeño - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Retroalimentación del desempeño - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Relación con los colaboradores - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Relación con los colaboradores - Forma A (nivel de riesgo)</th>
                                <th>DOMINIO Liderazgo y relaciones sociales en el trabajo - Forma A (puntaje transformado)</th>
                                <th>DOMINIO Liderazgo y relaciones sociales en el trabajo - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Claridad de rol - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Claridad de rol - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Capacitación - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Capacitación - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Participación y manejo del cambio - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Participación y manejo del cambio - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Oportunidades para el uso y desarrollo de habilidades y conocimientos - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Oportunidades para el uso y desarrollo de habilidades y conocimientos - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Control y autonomía sobre el trabajo - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Control y autonomía sobre el trabajo - Forma A (nivel de riesgo)</th>
                                <th>DOMINIO Control sobre el trabajo - Forma A (puntaje transformado)</th>
                                <th>DOMINIO Control sobre el trabajo - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Demandas ambientales y de esfuerzo físico - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Demandas ambientales y de esfuerzo físico - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Demandas emocionales - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Demandas emocionales - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Demandas cuantitativas - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Demandas cuantitativas - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Influencia del trabajo sobre el entorno extralaboral - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Influencia del trabajo sobre el entorno extralaboral - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Exigencias de responsabilidad del cargo - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Exigencias de responsabilidad del cargo - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Demandas de carga mental - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Demandas de carga mental - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Consistencia del rol - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Consistencia del rol - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Demandas de la jornada de trabajo - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Demandas de la jornada de trabajo - Forma A (nivel de riesgo)</th>
                                <th>DOMINIO Demandas del trabajo - Forma A (puntaje transformado)</th>
                                <th>DOMINIO Demandas del trabajo - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Recompensas derivadas de la pertenencia - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Recompensas derivadas de la pertenencia - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Reconocimiento y compensación - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Reconocimiento y compensación - Forma A (nivel de riesgo)</th>
                                <th>DOMINIO Recompensas - Forma A (puntaje transformado)</th>
                                <th>DOMINIO Recompensas - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Características del liderazgo - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Características del liderazgo - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Relaciones sociales en el trabajo - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Relaciones sociales en el trabajo - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Retroalimentación del desempeño - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Retroalimentación del desempeño - Forma B (nivel de riesgo)</th>
                                <th>DOMINIO Liderazgo y relaciones sociales en el trabajo - Forma B (puntaje transformado)</th>
                                <th>DOMINIO Liderazgo y relaciones sociales en el trabajo - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Claridad de rol - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Claridad de rol - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Capacitación - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Capacitación - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Participación y manejo del cambio - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Participación y manejo del cambio - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Oportunidades para el uso y desarrollo de habilidades y conocimientos - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Oportunidades para el uso y desarrollo de habilidades y conocimientos - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Control y autonomía sobre el trabajo - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Control y autonomía sobre el trabajo - Forma B (nivel de riesgo)</th>
                                <th>DOMINIO Control sobre el trabajo - Forma B (puntaje transformado)</th>
                                <th>DOMINIO Control sobre el trabajo - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Demandas ambientales y de esfuerzo físico - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Demandas ambientales y de esfuerzo físico - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Demandas emocionales - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Demandas emocionales - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Demandas cuantitativas - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Demandas cuantitativas - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Influencia del trabajo sobre el entorno extralaboral - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Influencia del trabajo sobre el entorno extralaboral - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Demandas de carga mental - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Demandas de carga mental - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Demandas de la jornada de trabajo - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Demandas de la jornada de trabajo - Forma B (nivel de riesgo)</th>
                                <th>DOMINIO Demandas del trabajo - Forma B (puntaje transformado)</th>
                                <th>DOMINIO Demandas del trabajo - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Recompensas derivadas de la pertenencia - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Recompensas derivadas de la pertenencia - Forma B (nivel de riesgo)</th>
                                <th>Dimensión: Reconocimiento y compensación - Forma B (puntaje transformado)</th>
                                <th>Dimensión: Reconocimiento y compensación - Forma B (nivel de riesgo)</th>
                                <th>DOMINIO Recompensas - Forma B (puntaje transformado)</th>
                                <th>DOMINIO Recompensas - Forma B (nivel de riesgo)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos as $fila) { ?>
                                <tr>
                                    <td><?php echo $fila['NombreCompleto']; ?></td>
                                    <td><?php echo $fila['Tipo de Cargo']; ?></td>
                                    <td><?php echo $fila['Dimensión: Características del liderazgo - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Características del liderazgo - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Relaciones sociales en el trabajo - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Relaciones sociales en el trabajo - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Retroalimentación del desempeño - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Retroalimentación del desempeño - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Relación con los colaboradores - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Relación con los colaboradores - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Liderazgo y relaciones sociales en el trabajo - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Liderazgo y relaciones sociales en el trabajo - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Claridad de rol - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Claridad de rol - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Capacitación - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Capacitación - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Participación y manejo del cambio - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Participación y manejo del cambio - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Oportunidades para el uso y desarrollo de habilidades y conocimientos - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Oportunidades para el uso y desarrollo de habilidades y conocimientos - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Control y autonomía sobre el trabajo - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Control y autonomía sobre el trabajo - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Control sobre el trabajo - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Control sobre el trabajo - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas ambientales y de esfuerzo físico - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas ambientales y de esfuerzo físico - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas emocionales - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas emocionales - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas cuantitativas - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas cuantitativas - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Influencia del trabajo sobre el entorno extralaboral - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Influencia del trabajo sobre el entorno extralaboral - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Exigencias de responsabilidad del cargo - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Exigencias de responsabilidad del cargo - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas de carga mental - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas de carga mental - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Consistencia del rol - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Consistencia del rol - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas de la jornada de trabajo - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas de la jornada de trabajo - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Demandas del trabajo - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Demandas del trabajo - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Recompensas derivadas de la pertenencia - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Recompensas derivadas de la pertenencia - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Reconocimiento y compensación - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Reconocimiento y compensación - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Recompensas - Forma A (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Recompensas - Forma A (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Características del liderazgo - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Características del liderazgo - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Relaciones sociales en el trabajo - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Relaciones sociales en el trabajo - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Retroalimentación del desempeño - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Retroalimentación del desempeño - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Liderazgo y relaciones sociales en el trabajo - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Liderazgo y relaciones sociales en el trabajo - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Claridad de rol - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Claridad de rol - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Capacitación - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Capacitación - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Participación y manejo del cambio - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Participación y manejo del cambio - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Oportunidades para el uso y desarrollo de habilidades y conocimientos - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Oportunidades para el uso y desarrollo de habilidades y conocimientos - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Control y autonomía sobre el trabajo - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Control y autonomía sobre el trabajo - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Control sobre el trabajo - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Control sobre el trabajo - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas ambientales y de esfuerzo físico - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas ambientales y de esfuerzo físico - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas emocionales - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas emocionales - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas cuantitativas - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas cuantitativas - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Influencia del trabajo sobre el entorno extralaboral - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Influencia del trabajo sobre el entorno extralaboral - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas de carga mental - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas de carga mental - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas de la jornada de trabajo - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Demandas de la jornada de trabajo - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Demandas del trabajo - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Demandas del trabajo - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Recompensas derivadas de la pertenencia - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Recompensas derivadas de la pertenencia - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Reconocimiento y compensación - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['Dimensión: Reconocimiento y compensación - Forma B (nivel de riesgo)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Recompensas - Forma B (puntaje transformado)']; ?></td>
                                    <td><?php echo $fila['DOMINIO Recompensas - Forma B (nivel de riesgo']; ?></td>
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
