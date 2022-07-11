<?php

require(dirname(__DIR__) . '/config/conection.php');

if (isset($_POST['origen']) && isset($_POST['destino']) && isset($_POST['fecha_despegue'])){

    $origen = $_POST['origen'];
    $destino = $_POST['destino']; 
    $fecha = $_POST['fecha_despegue'];

    $query_vuelo = "WITH
            ciudad_llegada AS
            (SELECT id_ciudad
            FROM ciudad
            WHERE '$destino' = nombre_ciudad),

            ciudad_salida AS
            (SELECT id_ciudad
            FROM ciudad
            WHERE '$origen' = nombre_ciudad),

            aero_llegada AS
            (SELECT id_aerodromo
            FROM aerodromo, ciudad_llegada
            WHERE ciudad_llegada.id_ciudad = aerodromo.id_ciudad),

            aero_salida AS
            (SELECT id_aerodromo
            FROM aerodromo, ciudad_salida
            WHERE ciudad_salida.id_ciudad = aerodromo.id_ciudad)

            SELECT *
            FROM vuelo, aero_salida, aero_llegada
            WHERE aero_salida.id_aerodromo = vuelo.id_aerodromo_salida
            AND aero_llegada.id_aerodromo = vuelo.id_aerodromo_llegada
            AND DATE(vuelo.fecha_salida) = '$fecha'
            AND vuelo.estado = 'aceptado'
            ;";

    $result = $db2 -> prepare($query_vuelo);
    $result -> execute();
    $vuelos = $result -> fetchAll();

}
?>


<div class='has-text-centered'>
        <?php

        if (count($vuelos) == 0){
            echo "<h4 class='has-text-info title is-4'>No se encontraron vuelos programados</h4>";
        }

        else{
            echo "<form method='post'>";
            echo "<h4 class='has-text-info title is-4'>Vuelos disponibles</h4>
                    <br>
                    <table class='table'>
                    <thead>
                    <tr>
                    <th></th>
                    <th>Id Vuelo</th>
                    <th>Código Vuelo</th>
                    <th>Fecha de salida</th>
                    <th>Fecha de llegada</th>
                    <th>Velocidad</th>
                    <th>Altitud</th>
                    </tr>
                    </thead>
                    <tbody>";
            foreach ($vuelos as $v) {
                echo "<tr class='vuelo-tr'> 
                <td><input type='radio' name='radio' onClick='RedirectReservar(this)' value='$v[0]'></td> 
                <td name='id_vuelo'>$v[0]</td> 
                <td>$v[1]</td> 
                <td>$v[2]</td> 
                <td>$v[3]</td> 
                <td>$v[4]</td> 
                <td>$v[5]</td></tr>";
            }
            echo "</tbody>
                </table>";
        }
        ?>
        <div class='block'>
            <div class='columns has-text-centered' id="holder">
            </div>
        </div>
</div>

<script>
    function RedirectReservar(x) {
        var reserva_data = document.getElementById("reservar").innerHTML;
        document.getElementById("holder").innerHTML = reserva_data;
    }
</script>

<script id="reservar" type="form/template">
        <div class='columns'>
            <div class="column">
                <input name='pasaporte1' class="input is-link" type="text" placeholder="Pasaporte #1">
            </div>
            <div class="column">
                <input name='pasaporte2' class="input is-link" type="text" placeholder="Pasaporte #2">
                <br><br>
                <button name="reservar_boton" class="button is-centered is-fullwidth is-primary is-rounded is-small">Reservar</button>
            </div>
            <div class="column">
                <input name='pasaporte3' class="input is-link" type="text" placeholder="Pasaporte #3">
            </div>
        </div>
    </form>
</script>


