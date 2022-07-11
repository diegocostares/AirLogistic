<?php
    //session_start();
    require(dirname(__DIR__) . '/config/conection.php');
    $user = $_SESSION['username'];
    $query = "SELECT id_persona
            FROM persona
            WHERE pasaporte = '$user'
            ;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    $id_user = $data[0][0];

    $query2 = "SELECT id_reserva, codigo_reserva
            FROM reserva
            WHERE id_persona = '$id_user'
            ;";
    $result = $db2 -> prepare($query2);
    $result -> execute();
    $reservas = $result -> fetchAll();
?>

<div class='has-text-centered'>
<h4 class='title is-2 has-text-info is-centered'>Mis vuelos</h4>
</div>

<?php
    foreach ($reservas as $rs){
        echo "<br>";
        echo "<h5 class='title is-4'>Id de Reserva: $rs[0]</h5>";
        echo "<h6 class='subtitle is-5'>Código de Reserva: $rs[1]</h6>";
        $query3 = "SELECT *
                FROM ticket
                WHERE id_reserva = '$rs[0]'
                ;";
        $result = $db2 -> prepare($query3);
        $result -> execute();
        $tickets = $result -> fetchAll();
        echo "<div align='center' class='box'>";
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr>
                <th># Ticket</th>
                <th># Asiento</th>
                <th>Clase</th>
                <th>Incluye comida y maleta</th>
                <th>Id Vuelo</th>
            </tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($tickets as $t){
            echo "<tr><td>$t[1]</td> <td>$t[2]</td> <td>$t[3]</td> <td>$t[4]</td> <td>$t[5]</td>";
        }
        echo "</tbody>
            </table>
            </div>";
    }
?>