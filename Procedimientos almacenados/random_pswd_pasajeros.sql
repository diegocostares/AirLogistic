CREATE OR REPLACE FUNCTION random_pswd_pasajeros(nombre VARCHAR(30), pasaporte VARCHAR(20))

RETURNS VARCHAR(50) AS $$

DECLARE
    contrasena VARCHAR(50);
    rd_number INT;
    len_nombre INT;
    rd_len_nombre INT;
    len_pasaporte INT;
    rd_len_pasaporte INT;
    rd_pos_pasaporte INT;
    aux INT;
    pswd_nombre VARCHAR(25); 
    pswd_pasaporte VARCHAR(25); 

BEGIN

    rd_number := random_between(100, 999);
    len_nombre := LENGTH(nombre);
    len_pasaporte := LENGTH(pasaporte);
    rd_len_nombre := random_between(3, len_nombre);
    rd_len_pasaporte := random_between(3, len_pasaporte);
    aux := len_pasaporte - rd_len_pasaporte;
    rd_pos_pasaporte := random_between(1,aux); 
    pswd_nombre := SUBSTRING(nombre, 1, rd_len_nombre);
    pswd_pasaporte := SUBSTRING(pasaporte, rd_pos_pasaporte, rd_len_pasaporte);
    contrasena := CONCAT(pswd_nombre, pswd_pasaporte, rd_number);
    contrasena := REPLACE(contrasena, ' ', '');
    RETURN contrasena;

END

$$ language plpgsql