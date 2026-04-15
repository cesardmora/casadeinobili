<?php
// PROTECCIÓN: accede con ?key=TU_CLAVE
$SECRET_KEY = 'Nobili2026Secure!';
if (!isset($_GET['key']) || $_GET['key'] !== $SECRET_KEY) {
    http_response_code(403);
    die('Acceso denegado. Necesitas la clave de acceso.');
}

chdir(dirname(__DIR__));
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Property;

Property::find(5)->delete();
echo 'Propiedad duplicada borrada ✓';