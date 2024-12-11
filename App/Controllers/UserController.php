<?php

require_once __DIR__ . '/../Models/User.php';

class UserController {

    
    private $userModel;

    public function __construct() {
        $this->userModel = new User("localhost", "root", "", "centro_educativo"); // Conexión a la base de datos
    }


    public function register($nombre, $primerApellido, $segundoApellido, $dni, $password, $confirmPassword) {
        // Verificar que las contraseñas coincidan
        if ($password !== $confirmPassword) {
            header("Location: /prueba_teatrillo/App/View/register.php?error=Las contraseñas no coinciden");
            exit;
        }

        // Validar que no haya campos vacíos
        if (empty($nombre) || empty($primerApellido) || empty($segundoApellido) || empty($dni) || empty($password)) {
            header("Location: /prueba_teatrillo/App/View/register.php?error=Por favor, completa todos los campos");
            exit;
        }

        // Generar nombre de usuario según las reglas: primera letra del nombre, 3 primeras letras de los apellidos y los 3 últimos dígitos del DNI
        $nombreUsuario = strtolower(substr($nombre, 0, 1) . substr($primerApellido, 0, 3) . substr($segundoApellido, 0, 3) . substr($dni, -3));

        // Verificar si el nombre de usuario ya existe
        if ($this->userModel->usuarioExistente($nombreUsuario)) {
            header("Location: /prueba_teatrillo/App/View/register.php?error=El nombre de usuario ya existe");
            exit;
        }

        // Encriptar la contraseña antes de guardarla
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Guardar el usuario en la base de datos
        if ($this->userModel->guardarUsuario($nombreUsuario, $hashedPassword, $nombre, $primerApellido, $segundoApellido, $dni)) {
            header("Location: /prueba_teatrillo/App/View/register.php?success=Usuario creado exitosamente&username=$nombreUsuario");
        } else {
            header("Location: /prueba_teatrillo/App/View/register.php?error=Error al crear el usuario");
        }
        exit;
    }

    public function __destruct() {
        $this->userModel->cerrarConexion();
    }
}

// Procesar la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $primerApellido = $_POST['primer_apellido'] ?? '';
    $segundoApellido = $_POST['segundo_apellido'] ?? '';
    $dni = $_POST['dni'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    $userController = new UserController();
    $userController->register($nombre, $primerApellido, $segundoApellido, $dni, $password, $confirmPassword);
}
?>
