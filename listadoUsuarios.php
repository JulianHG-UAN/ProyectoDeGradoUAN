<?php require_once "vistas/parte_sup.php"?>

<!-- Conexion Base de Datos -->
<?php
include_once './bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM employees";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
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
                                <th>employee_Id</th>
                                <th>company_id</th>
                                <th>employee_Name</th>
                                <th>employee_Secondname</th>
                                <th>employee_Lastname</th>
                                <th>employee_Secondlastname</th>
                                <th>employee_Genero</th>
                                <th>employee_Birthdate</th>
                                <th>employee_EstadoCivil</th>
                                <th>employee_UltimoNivelEstudio</th>
                                <th>employee_Ocupacion</th>
                                <th>employee_ResidenciaDepartamento</th>
                                <th>employee_ResidenciaCuidad</th>
                                <th>employee_EstratoSocial</th>
                                <th>employee_TipoVivienda</th>
                                <th>employee_PersonasACargo</th>
                                <th>employee_TrabajoDepartamento</th>
                                <th>employee_TrabajoCuidad</th>
                                <th>employee_TiempoEnEmpresa</th>
                                <th>employee_NombreCargo</th>
                                <th>employee_TipoCargo</th>
                                <th>employee_TiempoEnCargo</th>
                                <th>employee_NombreArea</th>
                                <th>employee_TipoContrato</th>
                                <th>employee_HorasLaborales</th>
                                <th>employee_TipoSalario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['employee_Id'] ?></td>
                                <td><?php echo $dat['company_id'] ?></td>
                                <td><?php echo $dat['employee_Name'] ?></td>
                                <td><?php echo $dat['employee_Secondname'] ?></td>
                                <td><?php echo $dat['employee_Lastname'] ?></td>
                                <td><?php echo $dat['employee_Secondlastname'] ?></td>
                                <td><?php echo $dat['employee_Genero'] ?></td>
                                <td><?php echo $dat['employee_Birthdate'] ?></td>
                                <td><?php echo $dat['employee_EstadoCivil'] ?></td>
                                <td><?php echo $dat['employee_UltimoNivelEstudio'] ?></td>
                                <td><?php echo $dat['employee_Ocupacion'] ?></td>
                                <td><?php echo $dat['employee_ResidenciaDepartamento'] ?></td>
                                <td><?php echo $dat['employee_ResidenciaCuidad'] ?></td>
                                <td><?php echo $dat['employee_EstratoSocial'] ?></td>
                                <td><?php echo $dat['employee_TipoVivienda'] ?></td>
                                <td><?php echo $dat['employee_PersonasACargo'] ?></td>
                                <td><?php echo $dat['employee_TrabajoDepartamento'] ?></td>
                                <td><?php echo $dat['employee_TrabajoCuidad'] ?></td>
                                <td><?php echo $dat['employee_TiempoEnEmpresa'] ?></td>
                                <td><?php echo $dat['employee_NombreCargo'] ?></td>
                                <td><?php echo $dat['employee_TipoCargo'] ?></td>
                                <td><?php echo $dat['employee_TiempoEnCargo'] ?></td>
                                <td><?php echo $dat['employee_NombreArea'] ?></td>
                                <td><?php echo $dat['employee_TipoContrato'] ?></td>
                                <td><?php echo $dat['employee_HorasLaborales'] ?></td>
                                <td><?php echo $dat['employee_TipoSalario'] ?></td>
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
                <div class="form-group">
                <label for="company_id" class="col-form-label">Id de la compañia:</label>
                <input type="number" class="form-control" id="company_id">
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
                <label for="employee_Genero" class="col-form-label">Genero:</label>
                <input type="number" class="form-control" id="employee_Genero">
                </div>

                <div class="form-group">
                <label for="employee_Birthdate" class="col-form-label">Fecha de nacimiento:</label>
                <input type="date" class="form-control" id="employee_Birthdate">
                </div>

                <div class="form-group">
                <label for="employee_EstadoCivil" class="col-form-label">Estado civil:</label>
                <input type="number" class="form-control" id="employee_EstadoCivil">
                </div>

                <div class="form-group">
                <label for="employee_UltimoNivelEstudio" class="col-form-label">Ultimo nivel de estudio:</label>
                <input type="number" class="form-control" id="employee_UltimoNivelEstudio">
                </div>

                <div class="form-group">
                <label for="employee_Ocupacion" class="col-form-label">Ocupacion:</label>
                <input type="text" class="form-control" id="employee_Ocupacion">
                </div>

                <div class="form-group">
                <label for="employee_ResidenciaDepartamento" class="col-form-label">Departamento de residencia:</label>
                <input type="number" class="form-control" id="employee_ResidenciaDepartamento">
                </div>

                <div class="form-group">
                <label for="employee_ResidenciaCuidad" class="col-form-label">Ciudad de residencia:</label>
                <input type="number" class="form-control" id="employee_ResidenciaCuidad">
                </div>

                <div class="form-group">
                <label for="employee_EstratoSocial" class="col-form-label">Estrato social:</label>
                <input type="number" class="form-control" id="employee_EstratoSocial">
                </div>

                <div class="form-group">
                <label for="employee_TipoVivienda" class="col-form-label">Tipo de vivienda:</label>
                <input type="number" class="form-control" id="employee_TipoVivienda">
                </div>

                <div class="form-group">
                <label for="employee_PersonasACargo" class="col-form-label">Personas a cargo:</label>
                <input type="number" class="form-control" id="employee_PersonasACargo">
                </div>

                <div class="form-group">
                <label for="employee_TrabajoDepartamento" class="col-form-label">Departamento de trabajo:</label>
                <input type="number" class="form-control" id="employee_TrabajoDepartamento">
                </div>

                <div class="form-group">
                <label for="employee_TrabajoCuidad" class="col-form-label">Ciudad de trabajo:</label>
                <input type="number" class="form-control" id="employee_TrabajoCuidad">
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
                <input type="number" class="form-control" id="employee_TipoCargo">
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
                <input type="number" class="form-control" id="employee_TipoContrato">
                </div>

                <div class="form-group">
                <label for="employee_HorasLaborales" class="col-form-label">Horas laborales:</label>
                <input type="number" class="form-control" id="employee_HorasLaborales">
                </div>

                <div class="form-group">
                <label for="employee_TipoSalario" class="col-form-label">Tipo de salario:</label>
                <input type="number" class="form-control" id="employee_TipoSalario">
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

</div>

<!-- FIN contenido principal -->

<?php require_once "vistas/parte_inf.php"?>