CREATE OR REPLACE FUNCTION importar_usuarios()

RETURNS void AS $$

DECLARE
    pasajero RECORD;
    compania RECORD;
    pasajero_contrasena VARCHAR(50);
    pasajero_nombre VARCHAR (60);
    compania_contrasena VARCHAR(15);
    var_admin RECORD;
    var_user RECORD;
    var_company RECORD;
    

BEGIN
    -- reminder: Usuarios atributo id es tipo SERIAL


    -- ser capaz de verificar si es que el usuario ya existe en la base de datos 
    -- del grupo impar antes de crearlo


    SELECT * INTO var_admin FROM usuarios WHERE usuarios.tipo = 'Admin DGAC';
    -- agregar admin
    IF var_admin IS NULL THEN
        INSERT INTO usuarios(username, contrasena, tipo) values('DGAC', 'admin', 'Admin DGAC');
    END IF;



    SELECT * INTO var_user FROM usuarios WHERE usuarios.tipo = 'pasajero';
    -- agregar pasajeros
    IF var_user IS NULL THEN
        FOR pasajero IN (SELECT * FROM persona) LOOP
            -- crear random pswd
            pasajero_contrasena := random_pswd_pasajeros(pasajero.nombre, pasajero.pasaporte);
            INSERT INTO usuarios(username, contrasena, tipo) 
            values(pasajero.pasaporte, pasajero_contrasena, 'pasajero');
        END LOOP;
    END IF;



    SELECT * INTO var_company FROM usuarios WHERE usuarios.tipo = 'compania';
    -- agregar compañia: 
    IF var_company IS NULL THEN
        FOR compania IN (SELECT * FROM compania) LOOP
            compania_contrasena := random_between(100000000,999999999);
            INSERT INTO usuarios(username, contrasena, tipo)
            values(compania.codigo_compania, compania_contrasena, 'compania');
        END LOOP;
    END IF;


END

$$ language plpgsql