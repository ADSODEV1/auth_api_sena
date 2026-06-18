# Servicio Web de Autenticación - GA7-220501096-AA5-EV01

## Descripción
Servicio web (API REST) desarrollado en PHP para el registro e inicio 
de sesión de usuarios, como parte de la evidencia de aprendizaje 
GA7-220501096-AA5-EV01 del programa Análisis y Desarrollo de Software (SENA).

## Requisitos
- PHP 7.4 o superior
- MySQL / MariaDB
- Servidor Apache (XAMPP, WAMP, Laragon)

## Instalación
1. Importar el archivo `sql/auth_api.sql` en phpMyAdmin
2. Configurar credenciales en `config/database.php`
3. Copiar el proyecto a la carpeta `htdocs` (XAMPP)

## Endpoints

### Registro de usuario
- **URL:** `POST http://localhost/auth_api/register`
- **Body (JSON):**
{
  "usuario": "Juan",
  "password": "juan123"
}

### Inicio de sesión
- **URL:** `POST http://localhost/auth_api/login`
- **Body (JSON):**
{
  "usuario": "Juan",
  "password": "juan123"
}

## Autor
[Tu Nombre]