CREATE DATABASE centro_educativo;

USE centro_educativo;


-- Modificación de la tabla de butacas (opcional para estado inicial):
ALTER TABLE butacas ADD COLUMN usuario_id INT NULL;

-- Nueva tabla para gestionar las reservas:
CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    butaca_id INT NOT NULL,
    fecha_reserva TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (butaca_id) REFERENCES butacas(id)
);
drop table butacas;
CREATE TABLE butacas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero INT NOT NULL,
    fila VARCHAR(10) NOT NULL,
    estado ENUM('disponible', 'reservada') DEFAULT 'disponible'
);
ALTER TABLE usuarios

insert into butacas (fila , )
ADD COLUMN password VARCHAR(255) NOT NULL;

use centro_educativo;
ALTER TABLE butacas DELETE numero INT;


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    primer_apellido VARCHAR(50) NOT NULL,
    segundo_apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(12) NOT NULL UNIQUE,
    usuario VARCHAR(20) NOT NULL UNIQUE
);