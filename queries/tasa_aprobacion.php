<?php
require(dirname(__DIR__) . '/config/conection.php');

$codigo_compania = $_SESSION['username'];

// CONSULTA CANTIDAD DE ACEPTADOS
$query = "SELECT v.id_vuelo
FROM vuelo as v, aerodromo as a1, aerodromo as a2, compania as c 
WHERE v.id_compania=c.id_compania 
AND c.codigo_compania = '$codigo_compania'
AND v.estado = 'aceptado' 
AND v.id_aerodromo_salida=a1.id_aerodromo 
AND v.id_aerodromo_llegada=a2.id_aerodromo
GROUP BY v.id_vuelo
;";

$result = $db2->prepare($query);
$result->execute();
$N_aprobados = count($result -> fetchAll());

// CONSULTA CANTIDAD DE RECHAZOS
$query = "SELECT v.id_compania
FROM vuelo as v, aerodromo as a1, aerodromo as a2, compania as c 
WHERE v.id_compania=c.id_compania 
AND c.codigo_compania = '$codigo_compania'
AND v.estado = 'rechazado' 
AND v.id_aerodromo_salida=a1.id_aerodromo 
AND v.id_aerodromo_llegada=a2.id_aerodromo
GROUP BY v.id_vuelo
;";

$result = $db2->prepare($query);
$result->execute();
$N_rechazados = count($result -> fetchAll());



// --FIN CONSULTAS--
$totalVisitors = $N_aprobados + $N_rechazados;
 
$newVsReturningVisitorsDataPoints = array(
	array("y"=> $N_aprobados, "name"=> "Aprobados", "color"=> "#008000"),
	array("y"=> $N_rechazados, "name"=> "Rechazados", "color"=> "#FF0000")
);
 
$newVisitorsDataPoints = array(
	array("x"=> 1420050600000 , "y"=> 33000),
	array("x"=> 1422729000000 , "y"=> 35960),
	array("x"=> 1425148200000 , "y"=> 42160),
	array("x"=> 1427826600000 , "y"=> 42240),
	array("x"=> 1430418600000 , "y"=> 43200),
	array("x"=> 1433097000000 , "y"=> 40600),
	array("x"=> 1435689000000 , "y"=> 42560),
	array("x"=> 1438367400000 , "y"=> 44280),
	array("x"=> 1441045800000 , "y"=> 44800),
	array("x"=> 1443637800000 , "y"=> 48720),
	array("x"=> 1446316200000 , "y"=> 50840),
	array("x"=> 1448908200000 , "y"=> 51600)
);
 
$returningVisitorsDataPoints = array(
	array("x"=> 1420050600000 , "y"=> 22000),
	array("x"=> 1422729000000 , "y"=> 26040),
	array("x"=> 1425148200000 , "y"=> 25840),
	array("x"=> 1427826600000 , "y"=> 23760),
	array("x"=> 1430418600000 , "y"=> 28800),
	array("x"=> 1433097000000 , "y"=> 29400),
	array("x"=> 1435689000000 , "y"=> 33440),
	array("x"=> 1438367400000 , "y"=> 37720),
	array("x"=> 1441045800000 , "y"=> 35200),
	array("x"=> 1443637800000 , "y"=> 35280),
	array("x"=> 1446316200000 , "y"=> 31160),
	array("x"=> 1448908200000 , "y"=> 34400)
);
 
?>


<script>
window.onload = function() {

    var totalVisitors = <?php echo $totalVisitors ?>;
    var visitorsData = {
        "Tasa de aprobados": [{
            click: visitorsChartDrilldownHandler,
            cursor: "pointer",
            explodeOnClick: false,
            innerRadius: "75%",
            legendMarkerType: "square",
            name: "Tasa de aprobados",
            radius: "100%",
            showInLegend: true,
            startAngle: 90,
            type: "doughnut",
            dataPoints: <?php echo json_encode($newVsReturningVisitorsDataPoints, JSON_NUMERIC_CHECK); ?>
        }],
        "Aprobados": [{
            color: "#E7823A",
            name: "Aprobados",
            type: "column",
            xValueType: "dateTime",
            dataPoints: <?php echo json_encode($newVisitorsDataPoints, JSON_NUMERIC_CHECK); ?>
        }],
        "Rechazados": [{
            color: "#546BC1",
            name: "Rechazados",
            type: "column",
            xValueType: "dateTime",
            dataPoints: <?php echo json_encode($returningVisitorsDataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    };

    var newVSReturningVisitorsOptions = {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: "Tasa de aprobación"
        },
        legend: {
            fontFamily: "calibri",
            fontSize: 14,
            itemTextFormatter: function(e) {
                return e.dataPoint.name + ": " + Math.round(e.dataPoint.y / totalVisitors * 100) + "%";
            }
        },
        data: []
    };

    var visitorsDrilldownedChartOptions = {
        animationEnabled: true,
        theme: "light2",
        axisX: {
            labelFontColor: "#717171",
            lineColor: "#a2a2a2",
            tickColor: "#a2a2a2"
        },
        axisY: {
            gridThickness: 0,
            includeZero: false,
            labelFontColor: "#717171",
            lineColor: "#a2a2a2",
            tickColor: "#a2a2a2",
            lineThickness: 1
        },
        data: []
    };

    var chart = new CanvasJS.Chart("chartContainer", newVSReturningVisitorsOptions);
    chart.options.data = visitorsData["Tasa de aprobados"];
    chart.render();

    function visitorsChartDrilldownHandler(e) {
        chart = new CanvasJS.Chart("chartContainer", visitorsDrilldownedChartOptions);
        chart.options.data = visitorsData[e.dataPoint.name];
        chart.options.title = {
            text: e.dataPoint.name
        }
        chart.render();
        $("#backButton").toggleClass("invisible");
    }

    $("#backButton").click(function() {
        $(this).toggleClass("invisible");
        chart = new CanvasJS.Chart("chartContainer", newVSReturningVisitorsOptions);
        chart.options.data = visitorsData["Tasa de aprobados"];
        chart.render();
    });

}
</script>



<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>