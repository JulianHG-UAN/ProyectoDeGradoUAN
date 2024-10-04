<?php require_once "vistas_admin/parte_sup.php"?>

<!-- INICIO contenido principal -->

<!-- Conexion Base de Datos -->
<?php
include_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

?>

<!-- Tabla -->
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <button onclick="history.back()" class="btn btn-dark">Volver</button>
                    <table id="lp-tablaDatos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Empleado</th>
                                <th>Dimensión: Características del liderazgo - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Características del liderazgo - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Relaciones sociales en el trabajo - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Relaciones sociales en el trabajo - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Retroalimentación del desempeño - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Retroalimentación del desempeño - Forma A (nivel de riesgo)</th>
                                <th>Dimensión: Relación con los colaboradores  - Forma A (puntaje transformado)</th>
                                <th>Dimensión: Relación con los colaboradores - Forma A (nivel de riesgo)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Juan Gonzalez</td>
                                <td>13,4</td>
                                <td>Sin Riesgo</td>
                                <td>12,6</td>
                                <td>Sin Riesgo</td>
                                <td>19,6</td>
                                <td>Riesgo Medio</td>
                                <td>19,6</td>
                                <td>Riesgo Medio</td>
                            </tr>
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>  
    </div> 
</div>

<!-- FIN contenido principal -->

<?php require_once "vistas_admin/parte_inf.php"?>