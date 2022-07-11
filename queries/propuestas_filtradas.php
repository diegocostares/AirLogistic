<?php
require("../config/conection.php");
include('../templates/header.php');
include('../templates/navbar.php');

$fecha = $_POST["fecha"];
$query = "SELECT p.pasaporte, l.fecha_habilitacion, l.fecha_termino
FROM licencias as l, licencias_asignadas as l_as, puestos_trabajo as p
WHERE l.id=l_as.licencia_id
AND l_as.puesto_id =p.id
AND l.fecha_habilitacion < '$fecha'
AND l.fecha_termino > '$fecha'
AND p.tipo='piloto'
ORDER BY p.pasaporte
 ;";

$result = $db->prepare($query);
$result->execute();
$propuestas = $result->fetchAll();


?>

<div align='center' class='box'>
    <table class='table'>
        <thead>
            <tr>

                <th>pasaporte</th>
                <th>fecha_habilitacion</th>
                <th>fecha_termino</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($propuestas as $prop) {
                echo "<tr> <td>$prop[0]</td> <td>$prop[1]</td> <td>$prop[2]</td> 
                ";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('../templates/footer.php'); ?>