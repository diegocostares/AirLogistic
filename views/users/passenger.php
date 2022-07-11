<?php 
session_start();
include(dirname(__FILE__, 3) . '/views/templates/header.php');
include(dirname(__FILE__, 3) . '/views/templates/navbar.php');

if (!isset($_SESSION['username'])) { 
                header("Location: {$HOME}");}

require(dirname(__FILE__, 3) . '/config/conection.php');
$user = $_SESSION['username'];
$query = "SELECT nombre
        FROM persona
        WHERE pasaporte = '$user'
        ;";
$result = $db2 -> prepare($query);
$result -> execute();
$data = $result -> fetchAll();
$nombre = $data[0][0];

// Obteniendo ciudades de origen
$query_origen = "WITH 
                vuelos_aprobados AS 
                (SELECT id_dato_vuelo 
                FROM propuestas
                WHERE estado = 'aceptado'),

                ids_aerodromos AS
                (SELECT aerodromo_llegada_id, aerodromo_salida_id
                FROM datos_vuelo, vuelos_aprobados
                WHERE vuelos_aprobados.id_dato_vuelo = datos_vuelo.id),

                id_ciudades_salida AS
                (SELECT id_ciudad
                FROM aerodromos, ids_aerodromos
                WHERE aerodromos.id = ids_aerodromos.aerodromo_salida_id)

                SELECT DISTINCT nombre
                FROM ciudades, id_ciudades_salida
                WHERE ciudades.id = id_ciudades_salida.id_ciudad
                ORDER BY nombre ASC
                ;";
$result = $db -> prepare($query_origen);
$result -> execute();
$ciudades_origen = $result -> fetchAll();

// Obteniendo ciudades de destino
$query_destino = "WITH 
                vuelos_aprobados AS 
                (SELECT id_dato_vuelo 
                FROM propuestas
                WHERE estado = 'aceptado'),

                ids_aerodromos AS
                (SELECT aerodromo_llegada_id, aerodromo_salida_id
                FROM datos_vuelo, vuelos_aprobados
                WHERE vuelos_aprobados.id_dato_vuelo = datos_vuelo.id),

                id_ciudades_llegada AS
                (SELECT id_ciudad
                FROM aerodromos, ids_aerodromos
                WHERE aerodromos.id = ids_aerodromos.aerodromo_llegada_id)

                SELECT DISTINCT nombre
                FROM ciudades, id_ciudades_llegada
                WHERE ciudades.id = id_ciudades_llegada.id_ciudad
                ORDER BY nombre ASC
                ;";
$result = $db -> prepare($query_destino);
$result -> execute();
$ciudades_destino = $result -> fetchAll();
?>


<section class="hero is-fullheight">
    <!--"container"-->
    <div class="columns is-multiline is-centered is-mobile">
        <div class="column is-11 is-responsive register login">
            <div class="columns">
                <div class="row">
                    <div class="column left">
                        <h1 class="title is-1"> Bienvenide!</h1>
                        <h2 class="subtitle colored is-4">En qué podemos ayudarte <?php echo "$nombre";?>?</h2>
                        <h3 class="subtitle colored is-4">Pasaporte: <?php echo "$user";?> </h3>
                        <form role="form" action="" method="post">

                            <h5 class="subtitle is-5"> Ciudad de Origen:</h5>
                            <div class="select is-info is-rounded is-normal">
                                <select name='origen'>
                                    <?php foreach($ciudades_origen as $c){
                                        echo "<option>$c[0]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <br><br>

                            <h6 class="subtitle is-5"> Ciudad de Destino:</h6>
                            <div class="select is-info is-rounded is-normal">
                                <select name='destino'>
                                    <?php foreach($ciudades_destino as $c){
                                            echo "<option>$c[0]</option>";
                                    }?>
                                </select>
                            </div>
                            <br><br>

                            <h6 class="subtitle is-5"> Fecha de despegue:</h6>
                            <div class="field">
                                <div class="control">
                                    <input class="input is-rounded is-normal" name="fecha_despegue" type="date"
                                        placeholder="01/01/2000">
                                </div>
                            </div>
                            <button name="ver-vuelos"
                                class="button is-centered is-fullwidth is-primary is-rounded is-medium">Ver
                                Vuelos</button>
                        </form>
                        <button onClick="window.location.href=window.location.href" name="mis-reservas"
                            class="button is-centered is-fullwidth is-primary is-rounded is-medium">Mis
                            Reservas
                        </button>

                        <!-- <br>
                        <form role="form" action="<?php //echo $HOME; ?>queries/destinos_fav.php" method="post">
                            <button type="submit"
                                class="button is-centered is-fullwidth is-primary is-rounded is-medium">
                                Destinos favoritos</button>
                        </form> -->




                    </div>
                </div>
                <div class="row">
                    <div class="column is-centered">

                        <form role="form" action="" method="post">
                            <?php include(dirname(__FILE__, 3) . '/queries/destinos_fav.php') ?>
                        </form>


                        <br>
                        <?php

                        if (isset($_POST["ver-vuelos"])){
                            include(dirname(__FILE__, 3) . '/queries/ver_vuelos.php');
                        }
                        
                        elseif (isset($_POST["reservar_boton"])){
                            include(dirname(__FILE__, 3) . '/queries/reservar.php');
                        }

                        else{
                            include(dirname(__FILE__, 3) . '/queries/mis_vuelos.php');
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>

</section>
<br><br>

<?php include(dirname(__FILE__, 3) . '/views/templates/footer.php'); ?>