<?php
require_once __DIR__ . '/../Models/LoginU.php';

session_start();

class LoginController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new UsuarioL("localhost", "root", "", "centro_educativo"); // Conexión a la base de datos
    }

    public function login($nombreUsuario, $password) {
        if (empty($nombreUsuario) || empty($password)) {
            return "Por favor, completa todos los campos.";
        }
    
        // Verificar credenciales mediante el modelo
        if ($this->usuarioModel->autenticarUsuario($nombreUsuario, $password)) {
            $_SESSION['usuario'] = $nombreUsuario; // Iniciar sesión
            header("Location: ../View/butacas.php"); // Redirigir a la página de butacas
            exit();
        } else {
            return "Nombre de usuario o contraseña incorrectos.";
        }
    }


    public function __destruct() {
        $this->usuarioModel->cerrarConexion();
    }
}

// Procesar la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = $_POST['nombre_usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    $loginController = new LoginController();
    $error = $loginController->login($nombreUsuario, $password);

    if ($error) {
        // Si hay un error, redirigir a la página de inicio de sesión con el mensaje
        header("Location: ../View/login.php?error=" . urlencode($error));
        exit();
    }
}
?>
