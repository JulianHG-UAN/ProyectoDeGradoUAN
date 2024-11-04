<?php require_once "vistas_admin/parte_sup.php" ?>

<!-- INICIO contenido principal -->
<button onclick="history.back()" class="btn btn-dark">Volver</button>
<div>
    <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Función para contar los niveles de riesgo en las columnas pares a partir de la cuarta
    function countRiskLevels(data) {
        let riskLevels = {
            "Sin Riesgo": 0,
            "Riesgo bajo": 0,
            "Riesgo medio": 0,
            "Riesgo Alto": 0,
            "Riesgo Muy alto": 0
        };

        // Procesar cada fila de datos
        $(data).find('tr').each(function() {
            $(this).find('td:nth-child(even):gt(2)').each(function() { // Seleccionar columnas pares desde la 4ta en adelante
                let risk = $(this).text().trim();
                if (riskLevels[risk] !== undefined) {
                    riskLevels[risk]++;
                }
            });
        });

        return riskLevels;
    }

    // Cargar los datos de la tabla desde el archivo "resultadosDatos.php" y actualizar el gráfico
    $(document).ready(function() {
        $.ajax({
            url: 'resultadosDatos.php', // Ruta del archivo PHP que genera la tabla
            method: 'GET',
            success: function(response) {
                // Insertar los datos en un div oculto para poder procesarlos
                let tableData = $('<div>').html(response).find('#lp-tablaDatos tbody');

                // Contar los niveles de riesgo
                const riskCounts = countRiskLevels(tableData);

                // Crear el gráfico con los datos procesados
                const ctx = document.getElementById('myChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(riskCounts), // "Sin Riesgo", "Riesgo bajo", etc.
                        datasets: [{
                            label: 'Cantidad de riesgos',
                            data: Object.values(riskCounts), // Cantidades de cada nivel de riesgo
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    });
</script>

<!-- FIN contenido principal -->

<?php require_once "vistas_admin/parte_inf.php" ?>
