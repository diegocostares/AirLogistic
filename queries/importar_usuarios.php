<!-- Query para mostrar resultado de clickear sobre-->
<!-- IMPORTAR USUARIOS-->

<!-- Asegurarse que esto se ejecuta en la bdd g47-->
<!-- y la modifica (de ser necesario)-->

<!-- Filtrado datos-->
<?php

require(dirname(__DIR__) . '/config/conection.php');


// (ANOTA EN READ ME).
// Se asume que tabla usuarios, la estructura,
// ya existe en la bdd

$query1 = "SELECT * FROM importar_usuarios();"; //Se crea la consulta (correr fx almacenada)
$query2 = "SELECT * FROM usuarios;"; 


$result = $db2->prepare($query2);
$result->execute();
$usuarios_importados = $result -> fetchAll();


$query_admin = "SELECT * FROM usuarios WHERE usuarios.tipo = 'Admin DGAC';"; 
$query_passenger = "SELECT * FROM usuarios WHERE usuarios.tipo = 'pasajero';"; 
$query_company = "SELECT * FROM usuarios WHERE usuarios.tipo = 'compania';"; 

$result = $db2->prepare($query_admin);
$result->execute();
$admin_importado = $result -> fetchAll();

$result = $db2->prepare($query_passenger);
$result->execute();
$pasajeros_importados = $result -> fetchAll();

$result = $db2->prepare($query_company);
$result->execute();
$companias_importados = $result -> fetchAll();


?>


<?php
    if (count($admin_importado) == 1) {
        $admin_response = "El administrador ha sido importado correctamente";
    } 

    if (count($pasajeros_importados) == 90) {
        $pasajeros_response = "Todos los pasajeros han sido importados correctamente";
    } 
    

    if (count($companias_importados) == 20) {
        $compania_response = "Todas las compañias aéreas han sido importadas correctamente";
    }

?>



<!-- Mostrar datos como tabla -->

<div align='center' class='content'>
    <li><?php echo "$admin_response" ?></li>
    <li><?php echo "$pasajeros_response" ?></li>
    <li><?php echo "$compania_response" ?></li>
</div>


<table class='table is-striped is-narrow is-hoverable is-fullwidth'>
    <thead>
        <tr>
            <th>id</th>
            <th>username</th>
            <th>contraseña</th>
            <th>tipo</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $rownumber = 0;
            foreach ($usuarios_importados as $ui) {
                echo "<tr> <td>$ui[0]</td> <td>$ui[1]</td> <td>$ui[2]</td> <td>$ui[3]</td>";
                $rownumber = $rownumber + 1;
            }
            ?>
    </tbody>
</table>