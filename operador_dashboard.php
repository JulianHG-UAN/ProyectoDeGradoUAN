<?php require_once "vistas_user/parte_sup.php"?>

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
                Actualmente, ha iniciado sesión como un <strong>Usuario Operador</strong>. Como Operador, tiene acceso a funciones básicas de gestión de empleados
                y visualización de resultados. Sin embargo, algunas opciones de administración y configuración de compañias o de usuarios solo están disponibles para
                los <strong>Usuarios Administradores</strong>.
            </p>
            <p style="font-size: 15px; line-height: 1.6;">
                Si necesita solicitar la creación de nuevas compañias, comuníquese con un Administrador del sistema.
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
                        <li><strong>Empleados:</strong> Desde esta sección se realiza la gestion de las empleados y la visualizacion de los Datos adquiridos.</li>
                    </ul>
                </p>
            </div>
            
            <div style="margin-top: 20px;">
                <h3 style="font-size: 18px; color: #4a90e2;">2. Gestión de Empleados</h3>
                <p style="margin-left: 15px;">
                    Para ingresar a la Gestión de los Empleados, diríjase a la sección <strong>Empleados - Listado empleados</strong>.
                    <br /><br />Desde aquís se puede visualizar el listado completo de Empleados que el usuario Operador podrá gestionar y se podrán realizar las acciones de Crear, Editar o Eliminar.
                    En la parte superior de la Tabla encontrará el Botón de crear Nuevos Empleados, en donde tendran que ingresar toda la Información base de los empleados.
                    <br /><br />Una vez los datos base esten diligenciados, para continuar con la Evaluación, dar clic en el boton "Preguntas".
                </p>
            </div>
            
            <div style="margin-top: 20px;">
                <h3 style="font-size: 18px; color: #4a90e2;">3. Gestión de Preguntas</h3>
                <p style="margin-left: 15px;">
                    En la sección <strong>Gestión de Preguntas</strong>, la cual se encuentra al dar clic en <strong>Preguntas</strong> al costado derecho de la Tabla de Empleados podran gestionar al completo
                    las preguntas de la Evaluación de Riesgo Psicosocial.<br /><br />Aquí podran visualizar el listado completo de preguntas y diligenciarla al completo.
                    Esta tabla se muestra en 50 preguntas por pagina, por lo que una vez diligenciada la primera pagina, dar clic en "Guardar" y continuar con la siguiente pagina.
                    Finalizadas las preguntas, para visualizar los resultados de la Evaluación por favor dirigirse a la sección "Visualización de Datos".
                </p>
            </div>

            <div style="margin-top: 20px;">
                <h3 style="font-size: 18px; color: #4a90e2;">4. Visualización de Datos</h3>
                <p style="margin-left: 15px;">
                    En la sección <strong>Visualización de Datos</strong>, que se encuentra en la sección <strong>Empleados - Visualización de Datos</strong> se prodran vizualizar todos los datos ya
                    analizados y procesados por cada uno de los empleados. Aquí se podran visualizar los resultados de la Evaluación de Riesgo Psicosocial en base a los Dominios y Dimensiones que las Baterias de
                    Riesgo Psicosocial aconsejan.
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

<?php require_once "vistas_user/parte_inf.php"?>