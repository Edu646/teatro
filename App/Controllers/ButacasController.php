<?php

// Updated ButacasController.php
class ButacasController {
    public function mostrar() {
        require_once 'App/Models/Butaca.php'; // Fixed file path
        $butacaModel = new Butaca();

        // Obtener todas las butacas
        $butacas = $butacaModel->obtenerTodasLasButacas();
        if (!$butacas) {
            error_log("No se obtuvieron butacas desde la base de datos.");
            $butacas = []; // Ensuring the variable is initialized
        }

        require_once 'App/View/butacas.php';
    }

    public function reservar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once 'App/Models/Butaca.php'; // Fixed file path
            $butacaModel = new Butaca();

            $butacasSeleccionadas = isset($_POST['butacas']) ? $_POST['butacas'] : []; // Validating input
            $usuarioId = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

            if ($usuarioId && !empty($butacasSeleccionadas)) {
                foreach ($butacasSeleccionadas as $butacaId) {
                    $butacaModel->reservarButaca($butacaId, $usuarioId);
                }
            }

            header('Location: index.php?action=mostrarButacas');
            exit;
        }
    }
}
