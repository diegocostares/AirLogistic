-- Eliminar tablas preexistentes
DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios(
    id SERIAL PRIMARY KEY NOT NULL,
    username VARCHAR(200) NOT NULL,
    contrasena VARCHAR(200) NOT NULL,
    tipo VARCHAR(10) NOT NULL
);

-- Poblar tablas archivos .csv
--\ COPY usuarios
--FROM
--    '~/Entrega3/csv/usuarios.csv' DELIMITER ',' CSV HEADER;