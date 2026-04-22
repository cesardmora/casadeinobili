<?php
// PROTECCIÓN: accede con ?key=Nobili2026Secure!
$SECRET_KEY = 'Nobili2026Secure!';
if (!isset($_GET['key']) || $_GET['key'] !== $SECRET_KEY) {
    http_response_code(403 );
    die('Acceso denegado.');
}

// Ir a la raíz del proyecto (un nivel arriba de public)
$rootPath = dirname(__DIR__);

// 1. Limpiar Caché de Laravel (como ya tenías)
try {
    require $rootPath . '/vendor/autoload.php';
    $app = require $rootPath . '/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->call('config:clear');
    $kernel->call('route:clear');
    $kernel->call('view:clear');
    echo "✓ Caché de Laravel limpiada.  
";
} catch (\Exception $e) {
    echo "⚠ Error limpiando caché: " . $e->getMessage() . "  
";
}

// 2. Arreglar Permisos de Carpetas Críticas
$pathsToFix = [
    $rootPath . '/storage',
    $rootPath . '/bootstrap/cache',
    $rootPath . '/database', // Carpeta de la base de datos
];

foreach ($pathsToFix as $path) {
    if (is_dir($path)) {
        chmod($path, 0775);
        echo "✓ Permisos 775 aplicados a: $path  
";
    }
}

// 3. Arreglar Permiso del archivo SQLite
$sqliteFile = $rootPath . '/database/database.sqlite';
if (file_exists($sqliteFile)) {
    chmod($sqliteFile, 0666); // 666 permite lectura/escritura para todos
    echo "✓ Permisos 666 aplicados a la base de datos SQLite.  
";
} else {
    echo "⚠ No se encontró el archivo database.sqlite en $sqliteFile  
";
}

echo "  
<b>Proceso finalizado. Intenta enviar el formulario ahora.</b>";
