<?php
require(dirname(__DIR__) . '/config/conection.php');
if (isset($_POST['rechazar'])) {

    foreach ($_POST['checkbox'] as $prop) {
        $id_a_rechazar = $prop;
        $query2 = "UPDATE propuestas
        SET estado='rechazado'
        WHERE id =$id_a_rechazar
        ;";

        $result = $db->prepare($query2);
        $result->execute();

        $query = "SELECT propuestas.id, a1.nombre, a2.nombre, propuestas.fecha_envio_propuesta
    FROM propuestas, datos_vuelo, aerodromos as a1, aerodromos as a2
    WHERE estado='pendiente'
    AND propuestas.id_dato_vuelo=datos_vuelo.id
    AND datos_vuelo.aerodromo_llegada_id=a1.id
    AND datos_vuelo.aerodromo_salida_id=a2.id
    ORDER BY propuestas.id
 ;";

        $result = $db->prepare($query);
        $result->execute();
        $propuestas = $result->fetchAll();
    }
} elseif (isset($_POST['aceptar'])) {
    foreach ($_POST['checkbox'] as $prop) {
        $id_a_aceptar = $prop;
        global $id_a_aceptar;
        $query2 = "UPDATE propuestas
        SET estado='aceptado'
        WHERE id =$id_a_aceptar
        ;";
        include('crear_vuelo_aprobado.php');

        $result = $db->prepare($query2);
        $result->execute();

        $query = "SELECT propuestas.id, a1.nombre, a2.nombre, propuestas.fecha_envio_propuesta
    FROM propuestas, datos_vuelo, aerodromos as a1, aerodromos as a2
    WHERE estado='pendiente'
    AND propuestas.id_dato_vuelo=datos_vuelo.id
    AND datos_vuelo.aerodromo_llegada_id=a1.id
    AND datos_vuelo.aerodromo_salida_id=a2.id
    ORDER BY propuestas.id
 ;";

        $result = $db->prepare($query);
        $result->execute();
        $propuestas = $result->fetchAll();
    }
} elseif (isset($_POST['filtrar'])) {
    $fecha_1 = $_POST['fecha1'];
    $fecha_2 = $_POST['fecha2'];

    $query = "SELECT propuestas.id, a1.nombre, a2.nombre, propuestas.fecha_envio_propuesta
    FROM propuestas, datos_vuelo, aerodromos as a1, aerodromos as a2
    WHERE estado='pendiente'
    AND propuestas.id_dato_vuelo=datos_vuelo.id
    AND datos_vuelo.aerodromo_llegada_id=a1.id
    AND datos_vuelo.aerodromo_salida_id=a2.id
    AND '$fecha_1'<= propuestas.fecha_envio_propuesta 
    AND propuestas.fecha_envio_propuesta <= '$fecha_2'
    ORDER BY propuestas.id
    ;";

    $result = $db->prepare($query);
    $result->execute();
    $propuestas = $result->fetchAll();

    //echo 'Filtrar';
} else {

    $query = "SELECT propuestas.id, a1.nombre, a2.nombre, propuestas.fecha_envio_propuesta
    FROM propuestas, datos_vuelo, aerodromos as a1, aerodromos as a2
    WHERE estado='pendiente'
    AND propuestas.id_dato_vuelo=datos_vuelo.id
    AND datos_vuelo.aerodromo_llegada_id=a1.id
    AND datos_vuelo.aerodromo_salida_id=a2.id
    ORDER BY propuestas.id
 ;";

    $result = $db->prepare($query);
    $result->execute();
    $propuestas = $result->fetchAll();
}

?>




<table class='table is-striped is-narrow is-hoverable is-fullwidth'>
    <thead>
        <tr>
            <th></th>
            <th>id</th>
            <th>aerodromo_llegada</th>
            <th>aerodromo_salida</th>
            <th>fecha_envio_propuesta</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $rownumber = 0;
        foreach ($propuestas as $prop) {
            echo "<tr> <td> <input type='checkbox' name='checkbox[$rownumber]' value='$prop[0]'> </td> <td>$prop[0]</td> <td>$prop[1]</td> <td>$prop[2]</td> <td>$prop[3]</td>";
            $rownumber = $rownumber + 1;
        }
        ?>
    </tbody>
</table>