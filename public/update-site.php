<?php
// PROTECCIÓN: accede con ?key=TU_CLAVE
$SECRET_KEY = 'Nobili2026Secure!';
if (!isset($_GET['key']) || $_GET['key'] !== $SECRET_KEY) {
    http_response_code(403);
    die('Acceso denegado. Necesitas la clave de acceso.');
}

// Limpieza manual de archivos de caché si Artisan falla
function cleanDir($dir) {
    if (!is_dir($dir)) return;
    $files = glob($dir . '/*');
    foreach ($files as $file) {
        if (is_file($file) && basename($file) !== '.gitignore') {
            unlink($file);
        }
    }
}

echo "Limpiando vistas manualmente... ";
cleanDir(__DIR__ . '/storage/framework/views');
echo "Hecho.<br>";

echo "Limpiando caché de rutas y config... ";
cleanDir(__DIR__ . '/storage/framework/cache/data');
@unlink(__DIR__ . '/bootstrap/cache/config.php');
@unlink(__DIR__ . '/bootstrap/cache/routes-v7.php');
echo "Hecho.<br>";

echo "<b>Ahora intenta cargar tu web de nuevo.</b>";