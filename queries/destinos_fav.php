<?php
require(dirname(__DIR__) . '/config/conection.php');

    $query = "SELECT DISTINCT COUNT(v.id_aerodromo_llegada), c.nombre_ciudad
    FROM vuelo as v, aerodromo as a, ciudad as c
    WHERE v.id_aerodromo_llegada = a.id_aerodromo
    AND a.id_ciudad = c.id_ciudad
    GROUP BY c.nombre_ciudad
    ORDER BY COUNT(v.id_aerodromo_llegada) DESC
    LIMIT 8;";

    $result = $db2->prepare($query);
    $result->execute();
    $propuestas = $result->fetchAll();


    foreach ($propuestas as $propuesta) {
        $dataPoints[] = array("y" => $propuesta[0], "label" => $propuesta[1]); // echo
    }
 ?>


<script>
window.onload = function() {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: "Mejores destinos"
        },
        axisY: {
            title: "Cantidad de vuelos"
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.## Vuelos",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

}
</script>


<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>