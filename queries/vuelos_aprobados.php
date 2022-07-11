<!-- Vuelos aceptados -->
<!-- para la compañia  -->
<!-- que se ha loggeado -->


<!-- Filtrado datos-->
<?php

require(dirname(__DIR__) . '/config/conection.php');

$codigo_compania = $_SESSION['username'];

$query = "SELECT v.id_vuelo, a1.nombre, a2.nombre, v.fecha_salida, v.fecha_llegada 
FROM vuelo as v, aerodromo as a1, aerodromo as a2, compania as c 
WHERE v.id_compania=c.id_compania 
AND c.codigo_compania = '$codigo_compania'
AND v.estado = '$estado' 
AND v.id_aerodromo_salida=a1.id_aerodromo 
AND v.id_aerodromo_llegada=a2.id_aerodromo
;";

$result = $db2->prepare($query);
$result->execute();
$vuelos_aprobados = $result -> fetchAll();

?>


<!-- Mostrar datos como tabla -->

<table class='table is-striped is-narrow is-hoverable is-fullwidth'>
    <thead>
        <tr>
            <th>id</th>
            <th>aerodromo_salida</th>
            <th>aerodromo_llegada</th>
            <th>fecha_salida</th>
            <th>fecha_llegada</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $rownumber = 0;
            foreach ($vuelos_aprobados as $va) {
                echo "<tr> <td>$va[0]</td> <td>$va[1]</td> <td>$va[2]</td> <td>$va[3]</td> <td>$va[4]</td>";
                $rownumber = $rownumber + 1;
            }
            ?>
    </tbody>
</table>