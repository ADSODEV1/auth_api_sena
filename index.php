<?php
/**
 * index.php - Router principal del servicio web
 * 
 * Este archivo actúa como punto de entrada para todas las peticiones
 * y enruta las solicitudes al controlador correspondiente según
 * el método HTTP y la URL solicitada.
 * 
 * Endpoints disponibles:
 * - POST /JOEL_CASTRO_AA5_EV01/register  -> Registrar usuario
 * - POST /JOEL_CASTRO_AA5_EV01/login     -> Iniciar sesión
 */

// Configurar cabeceras para permitir peticiones CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Manejar peticiones OPTIONS (preflight CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Incluir el controlador de autenticación
require_once __DIR__ . '/controllers/AuthController.php';

// Obtener la URI de la petición
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', trim($uri, '/'));

// Crear instancia del controlador
$authController = new AuthController();

// Determinar el endpoint (último segmento de la URL)
$endpoint = end($uri_segments);

// Enrutamiento basado en el método HTTP y el endpoint
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Ruta: /JOEL_CASTRO_AA5_EV01/register
    if ($endpoint === 'register') {
        $authController->registrar();
        exit();
    }
    
    // Ruta: /JOEL_CASTRO_AA5_EV01/login
    if ($endpoint === 'login') {
        $authController->login();
        exit();
    }
}

// Si se accede por GET a la raíz, mostrar información de la API
if ($_SERVER['REQUEST_METHOD'] === 'GET' && ($endpoint === 'JOEL_CASTRO_AA5_EV01' || $endpoint === '')) {
    http_response_code(200);
    echo json_encode([
        "estado" => "exitoso",
        "mensaje" => "API de Autenticación - GA7-220501096-AA5-EV01",
        "autor" => "Joel Castro",
        "endpoints" => [
            "registro" => "POST http://localhost/JOEL_CASTRO_AA5_EV01/register",
            "login" => "POST http://localhost/JOEL_CASTRO_AA5_EV01/login"
        ]
    ]);
    exit();
}

// Si la ruta no existe, devolver error 404
http_response_code(404);
echo json_encode([
    "estado" => "error",
    "mensaje" => "Endpoint no encontrado",
    "endpoints_disponibles" => [
        "POST /JOEL_CASTRO_AA5_EV01/register",
        "POST /JOEL_CASTRO_AA5_EV01/login"
    ]
]);
?>