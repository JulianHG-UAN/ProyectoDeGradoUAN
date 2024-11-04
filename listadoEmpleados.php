<?php require_once "vistas_user/parte_sup.php"?>

<!-- Conexion Base de Datos -->
<?php
include_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Consulta 1: Obtener datos de 'employees'
$consulta = "SELECT
        e.employee_Id,
        e.company_id,
        e.employee_Name,
        e.employee_Secondname,
        e.employee_Lastname,
        e.employee_Secondlastname,
        e.employee_Genero,
        e.employee_Birthdate,
        e.employee_EstadoCivil,
        e.employee_UltimoNivelEstudio,
        e.employee_Ocupacion,
        e.employee_ResidenciaDepartamento,
        e.employee_ResidenciaCuidad,
        e.employee_EstratoSocial,
        e.employee_TipoVivienda,
        e.employee_PersonasACargo,
        e.employee_TrabajoDepartamento,
        e.employee_TrabajoCuidad,
        e.employee_TiempoEnEmpresa,
        e.employee_NombreCargo,
        e.employee_TipoCargo,
        e.employee_TiempoEnCargo,
        e.employee_NombreArea,
        e.employee_TipoContrato,
        e.employee_HorasLaborales,
        e.employee_TipoSalario,
        c.company_name,
        g.genero,
        ec.estado_civil,
        ne.nivel_estudio,
        rd.departamento as residencia_departamento,
        rc.ciudad as residencia_ciudad,
        es.estrato,
        tv.tipo_vivienda,
        td.departamento,
        tc.ciudad,
        tcg.tipo_cargo,
        tco.tipo_contrato,
        ts.tipo_salario
    FROM employees e
    LEFT JOIN companies c ON e.company_id = c.company_id
    LEFT JOIN opciones_genero g ON e.employee_Genero = g.id
    LEFT JOIN opciones_estado_civil ec ON e.employee_EstadoCivil = ec.id
    LEFT JOIN opciones_nivel_estudio ne ON e.employee_UltimoNivelEstudio = ne.id
    LEFT JOIN opciones_departamento rd ON e.employee_ResidenciaDepartamento = rd.id
    LEFT JOIN opciones_ciudad rc ON e.employee_ResidenciaCuidad = rc.id
    LEFT JOIN opciones_estrato es ON e.employee_EstratoSocial = es.id
    LEFT JOIN opciones_tipo_vivienda tv ON e.employee_TipoVivienda = tv.id
    LEFT JOIN opciones_departamento td ON e.employee_TrabajoDepartamento = td.id
    LEFT JOIN opciones_ciudad tc ON e.employee_TrabajoCuidad = tc.id
    LEFT JOIN opciones_tipo_cargo tcg ON e.employee_TipoCargo = tcg.id
    LEFT JOIN opciones_tipo_contrato tco ON e.employee_TipoContrato = tco.id
    LEFT JOIN opciones_tipo_salario ts ON e.employee_TipoSalario = ts.id";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

// Consulta 2: Obtener datos de companies
$consulta2 = "SELECT * FROM companies";
$resultado2 = $conexion->prepare($consulta2);
$resultado2->execute();
$companies = $resultado2->fetchAll(PDO::FETCH_ASSOC);

// Consulta 3: Obtener datos de opciones_genero
$consulta3 = "SELECT * FROM opciones_genero";
$resultado3 = $conexion->prepare($consulta3);
$resultado3->execute();
$generos = $resultado3->fetchAll(PDO::FETCH_ASSOC);

// Consulta 4: Obtener datos de opciones_estado_civil
$consulta4 = "SELECT * FROM opciones_estado_civil";
$resultado4 = $conexion->prepare($consulta4);
$resultado4->execute();
$estados_civiles = $resultado4->fetchAll(PDO::FETCH_ASSOC);

// Consulta 5: Obtener datos de opciones_nivel_estudio
$consulta5 = "SELECT * FROM opciones_nivel_estudio";
$resultado5 = $conexion->prepare($consulta5);
$resultado5->execute();
$niveles_estudio = $resultado5->fetchAll(PDO::FETCH_ASSOC);

// Consulta 6: Obtener datos de opciones_departamento
$consulta6 = "SELECT * FROM opciones_departamento";
$resultado6 = $conexion->prepare($consulta6);
$resultado6->execute();
$departamentos = $resultado6->fetchAll(PDO::FETCH_ASSOC);

// Consulta 7: Obtener datos de opciones_ciudad
$consulta7 = "SELECT * FROM opciones_ciudad";
$resultado7 = $conexion->prepare($consulta7);
$resultado7->execute();
$ciudades = $resultado7->fetchAll(PDO::FETCH_ASSOC);

// Consulta 8: Obtener datos de opciones_estrato
$consulta8 = "SELECT * FROM opciones_estrato";
$resultado8 = $conexion->prepare($consulta8);
$resultado8->execute();
$estratos = $resultado8->fetchAll(PDO::FETCH_ASSOC);

// Consulta 9: Obtener datos de opciones_tipo_vivienda
$consulta9 = "SELECT * FROM opciones_tipo_vivienda";
$resultado9 = $conexion->prepare($consulta9);
$resultado9->execute();
$tipos_vivienda = $resultado9->fetchAll(PDO::FETCH_ASSOC);

// Consulta 10: Obtener datos de opciones_tipo_cargo
$consulta10 = "SELECT * FROM opciones_tipo_cargo";
$resultado10 = $conexion->prepare($consulta10);
$resultado10->execute();
$tipos_cargo = $resultado10->fetchAll(PDO::FETCH_ASSOC);

// Consulta 11: Obtener datos de opciones_tipo_contrato
$consulta11 = "SELECT * FROM opciones_tipo_contrato";
$resultado11 = $conexion->prepare($consulta11);
$resultado11->execute();
$tipos_contrato = $resultado11->fetchAll(PDO::FETCH_ASSOC);

// Consulta 12: Obtener datos de opciones_tipo_salario
$consulta12 = "SELECT * FROM opciones_tipo_salario";
$resultado12 = $conexion->prepare($consulta12);
$resultado12->execute();
$tipos_salario = $resultado12->fetchAll(PDO::FETCH_ASSOC);

?>


<!-- INICIO contenido principal -->

<!-- Tabla -->
<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaEmpleados" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id del empleado</th>
                                <th>Nombre de la compañia</th>
                                <th>Nombre</th>
                                <th>Segundo nombre</th>
                                <th>Apellido</th>
                                <th>Segundo apellido</th>
                                <th>Género</th>
                                <th>Fecha de nacimiento</th>
                                <th>Estado civil</th>
                                <th>Último nivel de estudio</th>
                                <th>Ocupación</th>
                                <th>Departamento de residencia</th>
                                <th>Ciudad de residencia</th>
                                <th>Estrato social</th>
                                <th>Tipo de vivienda</th>
                                <th>Personas a cargo</th>
                                <th>Departamento de trabajo</th>
                                <th>Ciudad de trabajo</th>
                                <th>Tiempo en la empresa (meses)</th>
                                <th>Nombre del cargo</th>
                                <th>Tipo de cargo</th>
                                <th>Tiempo en el cargo (meses)</th>
                                <th>Nombre del área</th>
                                <th>Tipo de contrato</th>
                                <th>Horas laborales</th>
                                <th>Tipo de salario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {
                            ?>
                            <tr>
                                <td><?php echo $dat['employee_Id'] ?></td>
                                <td data-company-id="<?php echo $dat['company_id']; ?>"><?php echo $dat['company_name']; ?></td>
                                <td><?php echo $dat['employee_Name'] ?></td>
                                <td><?php echo $dat['employee_Secondname'] ?></td>
                                <td><?php echo $dat['employee_Lastname'] ?></td>
                                <td><?php echo $dat['employee_Secondlastname'] ?></td>
                                <td data-genero-id="<?php echo $dat['employee_Genero']; ?>"><?php echo $dat['genero']; ?></td>
                                <td><?php echo $dat['employee_Birthdate'] ?></td>
                                <td data-estadoCivil-id="<?php echo $dat['employee_EstadoCivil']; ?>"><?php echo $dat['estado_civil']; ?></td>
                                <td data-nivelEstudio-id="<?php echo $dat['employee_UltimoNivelEstudio']; ?>"><?php echo $dat['nivel_estudio']; ?></td>
                                <td><?php echo $dat['employee_Ocupacion'] ?></td>
                                <td data-residenciaDepartamento-id="<?php echo $dat['employee_ResidenciaDepartamento']; ?>"><?php echo $dat['residencia_departamento']; ?></td>
                                <td data-residenciaCiudad-id="<?php echo $dat['employee_ResidenciaCuidad']; ?>"><?php echo $dat['residencia_ciudad']; ?></td>
                                <td data-estrato-id="<?php echo $dat['employee_EstratoSocial']; ?>"><?php echo $dat['estrato']; ?></td>
                                <td data-tipoVivienda-id="<?php echo $dat['employee_TipoVivienda']; ?>"><?php echo $dat['tipo_vivienda']; ?></td>
                                <td><?php echo $dat['employee_PersonasACargo'] ?></td>
                                <td data-trabajoDepartamento-id="<?php echo $dat['employee_TrabajoDepartamento']; ?>"><?php echo $dat['departamento']; ?></td>
                                <td data-trabajoCuidad-id="<?php echo $dat['employee_TrabajoCuidad']; ?>"><?php echo $dat['ciudad']; ?></td>
                                <td><?php echo $dat['employee_TiempoEnEmpresa'] ?></td>
                                <td><?php echo $dat['employee_NombreCargo'] ?></td>
                                <td data-tipoCargo-id="<?php echo $dat['employee_TipoCargo']; ?>"><?php echo $dat['tipo_cargo']; ?></td>
                                <td><?php echo $dat['employee_TiempoEnCargo'] ?></td>
                                <td><?php echo $dat['employee_NombreArea'] ?></td>
                                <td data-tipoContrato-id="<?php echo $dat['employee_TipoContrato']; ?>"><?php echo $dat['tipo_contrato']; ?></td>
                                <td><?php echo $dat['employee_HorasLaborales'] ?></td>
                                <td data-tipoSalario-id="<?php echo $dat['employee_TipoSalario']; ?>"><?php echo $dat['tipo_salario']; ?></td>
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
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formEmpleados">    
            <div class="modal-body">
                <input type="hidden" id="employee_Id" name="employee_Id" value="<?= $employee['employee_Id'] ?? '' ?>">

                <div class="form-group">
                <label for="company_id" class="col-form-label">Id de la compañia:</label>
                <select class="form-control" id="company_id" name="company_id">
                    <option value="" selected disabled>Selecciona una compañía</option> <!-- Opción vacía por defecto -->
                    <?php foreach ($companies as $company): ?>
                        <option value="<?= $company['company_id'] ?>"><?= $company['company_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="form-group">
                <label for="employee_Name" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="employee_Name">
                </div>

                <div class="form-group">
                <label for="employee_Secondname" class="col-form-label">Segundo nombre:</label>
                <input type="text" class="form-control" id="employee_Secondname">
                </div>

                <div class="form-group">
                <label for="employee_Lastname" class="col-form-label">Apellido:</label>
                <input type="text" class="form-control" id="employee_Lastname">
                </div>

                <div class="form-group">
                <label for="employee_Secondlastname" class="col-form-label">Segundo apellido:</label>
                <input type="text" class="form-control" id="employee_Secondlastname">
                </div>

                <div class="form-group">
                <label for="employee_Genero" class="col-form-label">Género:</label>
                <select class="form-control" id="employee_Genero" name="employee_Genero">
                    <option value="" selected disabled>Selecciona un género</option> <!-- Opción vacía por defecto -->
                    <?php foreach ($generos as $genero): ?>
                        <option value="<?= $genero['id'] ?>"><?= $genero['genero'] ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                <label for="employee_Birthdate" class="col-form-label">Fecha de nacimiento:</label>
                <input type="date" class="form-control" id="employee_Birthdate">
                </div>

                <div class="form-group">
                <label for="employee_EstadoCivil" class="col-form-label">Estado civil:</label>
                <select class="form-control" id="employee_EstadoCivil" name="employee_EstadoCivil">
                    <option value="" selected disabled>Selecciona el estado civil:</option> <!-- Opción vacía por defecto -->
                    <?php foreach ($estados_civiles as $estado_civil): ?>
                        <option value="<?= htmlspecialchars($estado_civil['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($estado_civil['estado_civil'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="form-group">
                <label for="employee_UltimoNivelEstudio" class="col-form-label">Ultimo nivel estudio:</label>
                <select class="form-control" id="employee_UltimoNivelEstudio" name="employee_UltimoNivelEstudio">
                    <option value="" selected disabled>Selecciona el ultimo nivel estudio:</option> <!-- Opción vacía por defecto -->
                    <?php foreach ($niveles_estudio as $nivel_estudio): ?>
                        <option value="<?= htmlspecialchars($nivel_estudio['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($nivel_estudio['nivel_estudio'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="form-group">
                <label for="employee_Ocupacion" class="col-form-label">Ocupacion:</label>
                <input type="text" class="form-control" id="employee_Ocupacion">
                </div>

                <div class="form-group">
                <label for="employee_ResidenciaDepartamento" class="col-form-label">Departamento de residencia:</label>
                <select class="form-control" id="employee_ResidenciaDepartamento" name="employee_ResidenciaDepartamento">
                    <option value="" selected disabled>Selecciona el departamento de residencia:</option> <!-- Opción vacía por defecto -->
                    <?php foreach ($departamentos as $departamento): ?>
                        <option value="<?= htmlspecialchars($departamento['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($departamento['departamento'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                <label for="employee_ResidenciaCuidad" class="col-form-label">Ciudad de residencia:</label>
                <select class="form-control" id="employee_ResidenciaCuidad" name="employee_ResidenciaCuidad">
                    <option value="" selected disabled>Selecciona la ciudad de residencia:</option> <!-- Opción vacía por defecto -->
                    <?php foreach ($ciudades as $ciudad): ?>
                        <option value="<?= htmlspecialchars($ciudad['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($ciudad['ciudad'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                <label for="employee_EstratoSocial" class="col-form-label">Estrato social:</label>
                <select class="form-control" id="employee_EstratoSocial" name="employee_EstratoSocial">
                    <option value="" selected disabled>Selecciona el estrato social:</option> <!-- Opción vacía por defecto -->
                    <?php foreach ($estratos as $estrato): ?>
                        <option value="<?= htmlspecialchars($estrato['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($estrato['estrato'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                <label for="employee_TipoVivienda" class="col-form-label">Tipo de vivienda:</label>
                <select class="form-control" id="employee_TipoVivienda" name="employee_TipoVivienda">
                    <option value="" selected disabled>Selecciona el tipo de vivienda:</option> <!-- Opción vacía por defecto -->
                    <?php foreach ($tipos_vivienda as $tipo_vivienda): ?>
                        <option value="<?= htmlspecialchars($tipo_vivienda['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($tipo_vivienda['tipo_vivienda'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                <label for="employee_PersonasACargo" class="col-form-label">Personas a cargo:</label>
                <input type="number" class="form-control" id="employee_PersonasACargo">
                </div>

                <div class="form-group">
                <label for="employee_TrabajoDepartamento" class="col-form-label">Departamento de trabajo:</label>
                <select class="form-control" id="employee_TrabajoDepartamento" name="employee_TrabajoDepartamento">
                    <option value="" selected disabled>Selecciona el departamento de trabajo:</option> <!-- Opción vacía por defecto -->
                    <?php foreach ($departamentos as $departamento): ?>
                        <option value="<?= htmlspecialchars($departamento['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($departamento['departamento'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                <label for="employee_TrabajoCuidad" class="col-form-label">Ciudad de trabajo:</label>
                <select class="form-control" id="employee_TrabajoCuidad" name="employee_TrabajoCuidad">
                    <option value="" selected disabled>Selecciona la ciudad de trabajo:</option> <!-- Opción vacía por defecto -->
                    <?php foreach ($ciudades as $ciudad): ?>
                        <option value="<?= htmlspecialchars($ciudad['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($ciudad['ciudad'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                <label for="employee_TiempoEnEmpresa" class="col-form-label">Tiempo en la empresa (meses):</label>
                <input type="number" class="form-control" id="employee_TiempoEnEmpresa">
                </div>

                <div class="form-group">
                <label for="employee_NombreCargo" class="col-form-label">Nombre del cargo:</label>
                <input type="text" class="form-control" id="employee_NombreCargo">
                </div>

                <div class="form-group">
                <label for="employee_TipoCargo" class="col-form-label">Tipo de cargo:</label>
                <select class="form-control" id="employee_TipoCargo" name="employee_TipoCargo">
                    <option value="" selected disabled>Selecciona el tipo de cargo:</option> <!-- Opción vacía por defecto -->
                    <?php foreach ($tipos_cargo as $tipo_cargo): ?>
                        <option value="<?= htmlspecialchars($tipo_cargo['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($tipo_cargo['tipo_cargo'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                <label for="employee_TiempoEnCargo" class="col-form-label">Tiempo en el cargo (meses):</label>
                <input type="number" class="form-control" id="employee_TiempoEnCargo">
                </div>

                <div class="form-group">
                <label for="employee_NombreArea" class="col-form-label">Nombre del área:</label>
                <input type="text" class="form-control" id="employee_NombreArea">
                </div>
                
                <div class="form-group">
                <label for="employee_TipoContrato" class="col-form-label">Tipo de contrato:</label>
                <select class="form-control" id="employee_TipoContrato" name="employee_TipoContrato">
                    <option value="" selected disabled>Selecciona el tipo de contrato:</option> <!-- Opción vacía por defecto -->
                    <?php foreach ($tipos_contrato as $tipo_contrato): ?>
                        <option value="<?= htmlspecialchars($tipo_contrato['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($tipo_contrato['tipo_contrato'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                <label for="employee_HorasLaborales" class="col-form-label">Horas laborales:</label>
                <input type="number" class="form-control" id="employee_HorasLaborales">
                </div>

                <div class="form-group">
                <label for="employee_TipoSalario" class="col-form-label">Tipo de salario:</label>
                <select class="form-control" id="employee_TipoSalario" name="employee_TipoSalario">
                    <option value="" selected disabled>Selecciona el tipo de salario:</option> <!-- Opción vacía por defecto -->
                    <?php foreach ($tipos_salario as $tipo_salario): ?>
                        <option value="<?= htmlspecialchars($tipo_salario['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($tipo_salario['tipo_salario'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div> 



<!-- FIN contenido principal -->

<?php require_once "vistas_user/parte_inf.php"?>