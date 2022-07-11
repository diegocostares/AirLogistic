
<?php

require(dirname(__DIR__) . '/config/conection.php');

$id_aprobado = $id_a_aceptar;
//datos_Vuelo
$query_datos1 = "SELECT dv.codigo, dv.fecha_salida, dv.fecha_llegada, f.velocidad, f.altitud, p.estado, c.codigo_compania as id_compania, a.codigo as codigo_aeronave, ra.id_ruta ,dv.aerodromo_llegada_id, dv.aerodromo_salida_id
FROM propuestas as p, datos_vuelo as dv, fpl as f, companias_asignadas as c, rutas_asignadas as ra, aeronaves as a
WHERE p.id= $id_aprobado
AND p.id_dato_vuelo= dv.id
AND dv.id= f.id_dato_vuelo
AND c.id_dato_vuelo= dv.id
AND ra.id_fpl=f.id
AND dv.id_aeronave= a.id
;";
$result = $db->prepare($query_datos1);
$result->execute();
$datos_vuelo = $result->fetchAll();

//Buscamos piloto
$query_datos2 = "SELECT pt.pasaporte
FROM propuestas as p, datos_vuelo as dv, fpl as f, puestos_trabajo as pt, puestos_asignados as pa
WHERE p.id= $id_aprobado
AND p.id_dato_vuelo= dv.id
AND dv.id= f.id_dato_vuelo
AND pa.id_puesto= pt.id
AND pa.id_fpl= f.id
AND pt.tipo LIKE 'piloto' 
;";
$result = $db->prepare($query_datos2);
$result->execute();
$piloto = $result->fetchAll();

$piloto_1 = $piloto[0]['pasaporte'];

$query_piloto_b47 = "SELECT t.id_trabajador
FROM trabajador as t
WHERE t.pasaporte= '$piloto_1'
;";
$result = $db2->prepare($query_piloto_b47);
$result->execute();
$piloto = $result->fetchAll();



//Buscamos copiloto
$query_datos3 = "SELECT pt.pasaporte
FROM propuestas as p, datos_vuelo as dv, fpl as f, puestos_trabajo as pt, puestos_asignados as pa
WHERE p.id= $id_aprobado
AND p.id_dato_vuelo= dv.id
AND dv.id= f.id_dato_vuelo
AND pa.id_puesto= pt.id
AND pa.id_fpl= f.id
AND pt.tipo LIKE 'copiloto'
;";
$result = $db->prepare($query_datos3);
$result->execute();
$copiloto = $result->fetchAll();
$cant_copiloto = count($copiloto);

//Rectificamos el id de la aeronave
$codigo_aeronave = $datos_vuelo[0]['codigo_aeronave'];
$query_aeronave_b47 = "SELECT a.id_aeronave
FROM aeronave as a
WHERE a.codigo_aeronave= '$codigo_aeronave'
;";
$result = $db2->prepare($query_aeronave_b47);
$result->execute();
$aeronave = $result->fetchAll();
$id_aeronave= $aeronave[0]['id_aeronave'];

//Buscamos el id más grande de vuelo, para no crear id's ya existentes, pero consecutivos
$query4 = " SELECT id_vuelo
FROM vuelo
ORDER BY id_vuelo DESC
LIMIT 1
;";
$result = $db2->prepare($query4);
$result->execute();
$vuelo = $result->fetchAll();
$id_vuelo = $vuelo[0]['id_vuelo'] + 1;

//////////////////////
$codigo = $datos_vuelo[0]['codigo'];
$fecha_salida = $datos_vuelo[0]['fecha_salida'];
$fecha_llegada = $datos_vuelo[0]['fecha_llegada'];
$velocidad = $datos_vuelo[0]['velocidad'];
$altitud = $datos_vuelo[0]['altitud'];
$estado = $datos_vuelo[0]['estado'];
$piloto_1 = $piloto[0]['id_trabajador'];
$id_compania = $datos_vuelo[0]['id_compania'];
$id_ruta = $datos_vuelo[0]['id_ruta'];
$id_aerodromo_llegada = $datos_vuelo[0]['aerodromo_llegada_id'];
$id_aerodromo_salida = $datos_vuelo[0]['aerodromo_salida_id'];

///////////Obtenemos el valor del id de la compañía especificado en la base de datos del grupo 47

$query_compania = " SELECT id_compania
FROM compania
WHERE codigo_compania= '$id_compania'
;";
$result = $db2->prepare($query_compania);
$result->execute();
$compania = $result->fetchAll();
$id_compania = $compania[0]['id_compania'];

///// Id piloto correcto



///// Subimos el nuevo vuelo a la base de datos del grupo47
if ($cant_copiloto == 0) {
    $query_4 = "INSERT INTO vuelo
    VALUES ($id_vuelo, '$codigo' ,'$fecha_salida', '$fecha_llegada', $velocidad, $altitud, '$estado', $piloto_1, NULL, $id_compania , $id_aeronave, $id_ruta,$id_aerodromo_llegada , $id_aerodromo_salida)
    ;";
} else {
    $copiloto_1 = $copiloto[0]['pasaporte'];

    $query_copiloto_b47 = "SELECT t.id_trabajador
    FROM trabajador as t
    WHERE t.pasaporte= '$copiloto_1'
    ;";
    $result = $db2->prepare($query_copiloto_b47);
    $result->execute();
    $copiloto = $result->fetchAll();
    $copiloto_1 = $copiloto[0]['id_trabajador'];


    $query_4 = "INSERT INTO vuelo
    VALUES ($id_vuelo, '$codigo' ,'$fecha_salida', '$fecha_llegada', $velocidad, $altitud, '$estado', $piloto_1, $copiloto_1, $id_compania , $id_aeronave, $id_ruta,$id_aerodromo_llegada , $id_aerodromo_salida)
    ;";
};
$result = $db2->prepare($query_4);
$result->execute();
?>