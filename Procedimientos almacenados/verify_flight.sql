CREATE OR REPLACE FUNCTION verify_flight(passport VARCHAR(30), id_vuelo_input INT)

RETURNS INT AS $$

DECLARE
    
    var_horario RECORD;
    var_flight RECORD;
    var_ticket RECORD; 
    
-- revisar que usuario(s) no poseen otros vuelos que topen temporalmente
BEGIN
    
    -- horario del vuelo que se quiere reservar:
    SELECT fecha_salida, fecha_llegada INTO var_horario FROM vuelo WHERE id_vuelo = id_vuelo_input;


    FOR var_ticket IN (SELECT * FROM ticket, persona WHERE persona.id_persona = ticket.id_persona
    AND persona.pasaporte = passport) LOOP

        -- fechas vuelo de un ticket. 
        SELECT fecha_salida, fecha_llegada INTO var_flight FROM vuelo WHERE var_ticket.id_vuelo = vuelo.id_vuelo;

        IF (var_flight.fecha_salida <= var_horario.fecha_salida 
        AND var_horario.fecha_salida <= var_flight.fecha_llegada) 
        OR 
        (var_flight.fecha_salida <= var_horario.fecha_llegada
        AND var_horario.fecha_llegada <= var_flight.fecha_llegada) 
        THEN
            RETURN 0;
        END IF;
        
    END LOOP;

    RETURN 1; -- No hay tope temporal new_vuelo respecto los vuelos previamente reservados.

END

$$ language plpgsql