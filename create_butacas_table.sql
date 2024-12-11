CREATE TABLE butacas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero INT NOT NULL,
    fila VARCHAR(10) NOT NULL,
    estado ENUM('disponible', 'reservada') DEFAULT 'disponible'
);
