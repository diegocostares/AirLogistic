<div class='has-text-centered'>
</div>

<?php

require(dirname(__DIR__) . '/config/conection.php');

$user_passport = $_SESSION['username']; 

//Verificamos que lo ingresado no es vacío 
if ((!empty($_POST['pasaporte1']) or !empty($_POST['pasaporte2']) or !empty($_POST['pasaporte3'])) and isset($_POST['radio'])){

    $pasaporte1 =  $_POST['pasaporte1'];
    $pasaporte2 =  $_POST['pasaporte2'];
    $pasaporte3 =  $_POST['pasaporte3'];
    $id_vuelo =  $_POST['radio'];

    echo $pasaporte1;
    echo $pasaporte2;
    echo $pasaporte3;
    echo $id_vuelo;


    // Recuperamos el "id_persona" desde tabla "personas" en bdd g47 de la 
    // persona que hace la reserva mediante su pasaporte
    $query_id_usuario ="SELECT id_persona 
    FROM persona
    WHERE pasaporte ='$user_passport';";

    $result = $db2 -> prepare($query_id_usuario);
    $result -> execute();
    $id_array = $result -> fetchAll();
    $id_usuario= $id_array[0]['id_persona'];

    
    // Llamar al procedimiento almacenado "reserva.sql" que verifica validez de los datos
    // y hace la reserva:

        // P.A. reserva.sql llama a:
        // verify_passport.sql: para revisar que los pasaportes ingresados son válidos
        // verify_flight.sql: para revisar que usuario(s) no poseen otros vuelos que topen temporalmente

        // para finalmente modificar bdd XXXX agregando las nuevas reservas

    $query = "SELECT * FROM reserva('$pasaporte1', '$pasaporte2', '$pasaporte3', '$id_vuelo', '$id_usuario');";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $success = $result -> fetchAll();

    if (count($success)==0){
        echo '<h2>Los pasaportes ingresados no son válidos o posee topes con otros vuelos</h2>';
    }
}

else{
    echo "<h4 class='has-text-info title is-4'>Ingrese al menos un número de pasaporte</h4>";
}

?>