<?php require_once "vistas_admin/parte_sup.php"?>

<!-- INICIO contenido principal -->

<body>
    <!-- Contenedor principal de bienvenida -->
    <div style="max-width: 800px; margin: 20px auto; font-family: Arial, sans-serif; color: #333;">
        <!-- Mensaje de bienvenida -->
        <section style="padding: 20px; background-color: #f0f4f8; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h1 style="color: #4a90e2; font-size: 28px;">Bienvenido a <b>Psymetrics</b></h1>
            <p style="font-size: 16px; line-height: 1.6;">
                Nos complace darle la bienvenida al sistema <b>Psymetrics</b>, un entorno diseñado para facilitar la gestión y análisis de las Evaluaciones de Riesgo psicosocial.
                Este aplicativo le ayudará a los profesionales de la salud a organizar, evaluar y visualizar los resultados de manera eficiente y segura.
            </p>
        </section>

        <!-- Información sobre el rol de usuario -->
        <section style="margin-top: 20px; padding: 15px; background-color: #fff8e1; border: 1px solid #ffe0b2; border-radius: 8px;">
            <h2 style="color: #ff9800; font-size: 22px;">Aviso de rol de usuario</h2>
            <p style="font-size: 15px; line-height: 1.6;">
                Actualmente, ha iniciado sesión como un <strong>Usuario Administrador</strong>. Como Administrador, tiene acceso a funciones de gestión de Compañias y de Usuarios.
                Sin embargo, algunas opciones como la gestión de Empleados y la Visualización de datos solo están disponibles para los <strong>Usuarios Operadores</strong>.
            </p>
        </section>

        <!-- Instrucciones de uso -->
        <section style="margin-top: 30px;">
            <h2 style="color: #4a90e2; font-size: 24px; margin-bottom: 10px;">Guía de uso</h2>
            <p style="font-size: 15px; line-height: 1.6;">
                A continuación, le ofrecemos una guía rápida para que aproveche al máximo las funciones principales de Psymetrics.
            </p>
            
            <div style="margin-top: 20px;">
                <h3 style="font-size: 18px; color: #4a90e2;">1. Navegación del Menú Principal</h3>
                <p style="margin-left: 15px;">
                    El menú principal se encuentra en la parte izquierda de la pantalla. Desde allí puede acceder a las siguientes secciones:
                    <ul style="margin-left: 30px; list-style-type: circle;">
                        <li><strong>Compañias:</strong> Realize la gestion de las compañias a las cuales los Usuarios Operadores podran realizar sus Evaluaciones.</li>
                        <li><strong>Usuarios:</strong> Gestión de usuarios, con opciones para agregar, editar o eliminar perfiles.</li>
                    </ul>
                </p>
            </div>
            
            <div style="margin-top: 20px;">
                <h3 style="font-size: 18px; color: #4a90e2;">2. Gestión de Compañias</h3>
                <p style="margin-left: 15px;">
                    Para ingresar a la Gestión de las compañias, diríjase a la sección <strong>Compañias - Listado compañias</strong>.
                    <br /><br />Aquí puede visualizar el listado completo de compañias y realizar las acciones de Crear, Editar o Eliminar.
                    En la parte superior de la Tabla encontrará el Botón de crear Nueva Compañia, el cual le permitirá agregar una nueva compañia al ingresar
                    el nombre de la compañia, la direccion y si se encuentra activa en el sistema. Psymetrics tiene la opcion de no eliminar de compañias, sino de desactivarlas, para que no se pierda la informacion.
                    <br /><br />Tenga en cuenta que estas acciones afectaran a los Usuarios Operadores.
                </p>
            </div>
            
            <div style="margin-top: 20px;">
                <h3 style="font-size: 18px; color: #4a90e2;">3. Gestión de Usuarios</h3>
                <p style="margin-left: 15px;">
                    En la sección <strong>Gestión de Usuarios</strong>, la cual encontrará en la encontrará la sección <strong>Usuarios - Listado Usuarios</strong>.
                    <br /><br />En este sección podran visualizar el listado completo de usuarios que ingresan al aplicativo y podrán realizar acciones de Crear, Editar o Eliminar.
                    En la parte superior de la Tabla encontrará el Botón de crear Nuevos Usuarios, donde tendran que ingresar su nombre completo, correo electrónico con el que van a
                    ingresar al igual que su contraseña y el rol.
                    <br /><br />Tenga en cuenta que el rol de usuario afecta las acciones que podran realizar en el sistema.
                </p>
            </div>

        <!-- Mensaje de apoyo -->
        <section style="margin-top: 30px; padding: 15px; background-color: #e8f5e9; border-radius: 8px;">
            <p style="font-size: 15px; color: #388e3c;">
                Si tiene alguna pregunta o necesita asistencia adicional, no dude en contactar al diseñador y programador de Psymetrics.
                ¡Estamos aquí para ayudarle!
            </p>
        </section>
    </div>
</body>

<!-- FIN contenido principal -->

<?php require_once "vistas_admin/parte_inf.php"?>