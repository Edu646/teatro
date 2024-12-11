<?php

class ButacasController {
    public function mostrar() {
        require_once 'App/Model/Butaca.php';
        $butacaModel = new Butaca();

        // Obtener todas las butacas
        $butacas = $butacaModel->obtenerTodasLasButacas();

        require_once 'App/View/butacas.php';
    }

    public function reservar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once 'App/Model/Butaca.php';
            $butacaModel = new Butaca();

            $butacasSeleccionadas = $_POST['butacas']; // IDs de las butacas seleccionadas
            $usuarioId = $_SESSION['usuario_id']; // ID del usuario logueado

            foreach ($butacasSeleccionadas as $butacaId) {
                $butacaModel->reservarButaca($butacaId, $usuarioId);
            }

            header('Location: index.php?action=mostrarButacas');
        }
    }
}
