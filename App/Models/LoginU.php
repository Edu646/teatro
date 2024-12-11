<?php
class UsuarioL {
    private $db;

    public function __construct($host, $user, $pass, $dbname) {
        $this->db = new mysqli($host, $user, $pass, $dbname);

        if ($this->db->connect_error) {
            die("Error de conexión: " . $this->db->connect_error);
        }
    }

    public function autenticarUsuario($nombreUsuario, $password) {
       // Ejemplo de consulta para obtener el password del usuario
    $stmt = $this->db->prepare("SELECT password FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $nombreUsuario); // Vincula el nombre de usuario al parámetro
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    // Compara la contraseña ingresada con la almacenada
    if (password_verify($password, $hashedPassword)) {
        return true; // Autenticación exitosa
    }
}


        return false; // Usuario no encontrado o contraseña incorrecta
    }

    public function cerrarConexion() {
        $this->db->close();
    }
}
?>
