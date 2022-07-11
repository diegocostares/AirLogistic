CREATE
OR REPLACE FUNCTION reserva(
    p1 VARCHAR,
    p2 VARCHAR,
    p3 VARCHAR,
    id_vuelo INT,
    id_usuario INT
) 

RETURNS RECORD AS $$ 

DECLARE 

pasaportes RECORD;
var_ok_passport INT;
row_passport RECORD;
var_ok_horario INT;

BEGIN CREATE TABLE passports(
    pasaporte VARCHAR(100) NOT NULL,
    ok_passport INT, -- 0 invalid 1 valid 3 empty
    ok_horario INT,
);

INSERT INTO passports VALUES (p1, 0, 0);
INSERT INTO passports VALUES (p2, 0, 0);
INSERT INTO passports VALUES (p3, 0, 0);

-- actualizar tabla "passports" con resultados de verificación 
-- de los pasaportes de input
FOR row_passport IN (SELECT * FROM passports) LOOP 
    var_ok_passport := verify_passport(row_passport.pasaporte);
    
    UPDATE passports 
    SET ok_passport = var_ok_passport
    WHERE row_passport.pasaporte = passports.pasaporte

END LOOP;

-- borrar nulos de tabla
DELETE FROM passports
WHERE ok_passport = 3;


-- actualizar tabla "passports" con resultados de verificación
-- tope de horario SOLO para pasaportes válidos
FOR row_passport IN (SELECT * FROM passports) LOOP 
    IF (row_passport.ok_passport = 1) THEN
        var_ok_horario := verify_flight(row_passport.pasaporte, id_vuelo)
    
        UPDATE passports 
        SET ok_horario = var_ok_horario
        WHERE row_passport.pasaporte = passports.pasaporte
    
    END IF;
END LOOP;


-- no se reserva si hay pasaportes inválidos o topes de horario
FOR passport IN (SELECT * FROM passport) LOOP 
    IF (passport.ok_passport = 0 OR passport.ok_horario = 0) THEN 
        SELECT * INTO pasaportes FROM passports;
        DROP TABLE IF EXISTS passports;
        RETURN pasaportes; -- en reservar.php queremos ver tabla con los resultados
        -- P1. MANEJAR ESTO EN reservar.php para MOSTRAR MSJE (especifico) DE ERROR
    END IF;
END LOOP;


-- efectuar reserva
 -- actualizar tabla grupo impar
FOR passport IN (SELECT * FROM passport) LOOP
    pasaportes := SELECT * FROM passports;
    DROP TABLE IF EXISTS passports;
    RETURN pasaportes;
END LOOP;

END 

 $$ language plpgsql