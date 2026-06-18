<?php
/**
 * Clase Database
 * Encargada de gestionar la conexión a la base de datos MySQL
 * utilizando PDO (PHP Data Objects) para mayor seguridad.
 */
class Database {
    // Parámetros de conexión
    private $host = "localhost";
    private $db_name = "auth_api";
    private $username = "root";       // Cambiar por tu usuario
    private $password = "";           // Cambiar por tu contraseña
    private $conn;

    /**
     * Método para obtener la conexión a la BD
     * @return PDO Objeto de conexión
     */
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            // Configurar PDO para lanzar excepciones en caso de error
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("SET NAMES utf8");
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>