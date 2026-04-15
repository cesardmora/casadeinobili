<?php
// PROTECCIÓN: accede con ?key=TU_CLAVE
$SECRET_KEY = 'Nobili2026Secure!';
if (!isset($_GET['key']) || $_GET['key'] !== $SECRET_KEY) {
    http_response_code(403);
    die('Acceso denegado. Necesitas la clave de acceso.');
}

phpinfo();
