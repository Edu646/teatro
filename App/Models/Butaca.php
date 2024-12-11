<?php

// Include the BaseDatos class
require_once __DIR__ . '/../Lib/BaseDatos.php';

class Butaca {
    private $db;

    // Constructor para establecer la conexión a la base de datos
    public function __construct() {
        $this->db = new \App\Lib\BaseDatos(); // Create an instance of BaseDatos
    }

    // Obtener todas las butacas
    public function obtenerTodasLasButacas() {
        try {
            $this->db->consulta("SELECT * FROM butacas ORDER BY fila, numero");
            return $this->db->extraer_todos();
        } catch (PDOException $e) {
            error_log("Error al obtener las butacas: " . $e->getMessage());
            return [];
        }
    }

    // Actualizar el estado de una butaca a reservada
    public function reservarButaca($butacaId, $usuarioId) {
        try {
            $stmt = $this->db->prepare("UPDATE butacas SET estado = 'reservada', usuario_id = :usuario_id WHERE id = :butaca_id");
            $stmt->bindParam(':usuario_id', $usuarioId);
            $stmt->bindParam(':butaca_id', $butacaId);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al reservar la butaca: " . $e->getMessage());
            return false;
        }
    }
}
