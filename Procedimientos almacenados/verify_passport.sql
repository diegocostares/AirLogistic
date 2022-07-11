CREATE OR REPLACE FUNCTION verify_passport(passport VARCHAR)

RETURNS INT AS $$

DECLARE
    
    cant_passports RECORD;
    result INT; --0 inválido, 1 válido, 3 3mpty 

    -- revisar que los pasaportes ingresados son válidos
    -- revisa un pasaporte a la vez
BEGIN

    IF length(passport) = 0 THEN  -- si dato ingresado  es nulo
        RETURN 3;

    ELSE --si NO es nulo:
        SELECT COUNT(pasaporte) AS cantidad INTO cant_passports FROM persona WHERE passport = pasaporte;

        IF cant_passports.cantidad = 1 THEN --está en la bdd
            RETURN 1;

        ELSE 
            RETURN 0;

        END IF;

    END IF;


END

$$ language plpgsql