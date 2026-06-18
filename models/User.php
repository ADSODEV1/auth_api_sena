<?php
/**
 * Clase User
 * Modelo que representa la entidad Usuario y sus operaciones
 * en la base de datos (registro y consulta).
 */
class User {
    private $conn;
    private $table_name = "usuarios";

    // Propiedades del usuario
    public $id;
    public $usuario;
    public $password;

    /**
     * Constructor: recibe la conexión a la BD
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Registrar un nuevo usuario en la base de datos
     * La contraseña se almacena hasheada con password_hash()
     * @return bool true si el registro fue exitoso
     */
    public function registrar() {
        // Consulta SQL con parámetros preparados (previene SQL Injection)
        $query = "INSERT INTO " . $this->table_name . 
                 " (usuario, password) VALUES (:usuario, :password)";
        
        $stmt = $this->conn->prepare($query);

        // Hashear la contraseña antes de guardarla (seguridad)
        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);

        // Bind de parámetros
        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":password", $hashed_password);

        // Ejecutar la consulta
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Buscar un usuario por su nombre de usuario
     * @return array|false Datos del usuario o false si no existe
     */
    public function buscarPorUsuario() {
        $query = "SELECT id, usuario, password FROM " . $this->table_name . 
                 " WHERE usuario = :usuario LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>