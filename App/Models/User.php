<?php
class User {
    private $db;

    public function __construct($host, $user, $pass, $dbname) {
        $this->db = new mysqli($host, $user, $pass, $dbname);
        if ($this->db->connect_error) {
            die("Conexión fallida: " . $this->db->connect_error);
        }
    }

    public function usuarioExistente($nombreUsuario) {
        $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $nombreUsuario);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function guardarUsuario($nombreUsuario, $hashedPassword, $nombre, $primerApellido, $segundoApellido, $dni) {
        $stmt = $this->db->prepare("INSERT INTO usuarios (usuario, password, nombre, primer_apellido, segundo_apellido, dni) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nombreUsuario, $hashedPassword, $nombre, $primerApellido, $segundoApellido, $dni);
        return $stmt->execute();
    }

    public function cerrarConexion() {
        $this->db->close();
    }
}
?>
