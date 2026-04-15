<?php
// PROTECCIÓN: accede con ?key=TU_CLAVE
$SECRET_KEY = 'Nobili2026Secure!';
if (!isset($_GET['key']) || $_GET['key'] !== $SECRET_KEY) {
    http_response_code(403);
    die('Acceso denegado. Necesitas la clave de acceso.');
}

// force-db.php
use App\Models\Property;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

echo "<h2>Actualizando base de datos manualmente...</h2>";

try {
    // Definimos los datos exactos que queremos (Traducción del PropertySeeder)
    $data = [
        'ca-serenissima' => [
            'name' => 'Ca Serenissima',
            'century' => '15th Century',
            'tagline' => 'The origin of the collection',
            'description' => 'The crown jewel of medieval Korčula. Original Gothic arches, limestone courtyards, and views of the cathedral bell tower.',
            'amenities' => ['Private courtyard', 'High-speed Wi-Fi', 'Fully equipped kitchen', 'Cathedral views', 'Air conditioning', 'Fireplace'],
        ],
        'palacio-arneri' => [
            'name' => 'Arneri Palace',
            'century' => '17th Century',
            'tagline' => 'Baroque grandeur on the edge of the Adriatic',
            'description' => 'A testament to Venetian opulence in Dalmatia. Double-height ceilings, original frescoes, and a terrace overlooking the Adriatic.',
            'amenities' => ['Adriatic-front terrace', 'Event hall', 'Original frescoes', 'Wi-Fi', "Chef's kitchen", 'Concierge service'],
        ],
        'casa-renacentista' => [
            'name' => 'Renaissance House',
            'century' => '16th Century',
            'tagline' => 'Renaissance elegance with channel views',
            'description' => 'Renaissance elegance overlooking the Korčula channel. Perfect proportions, a private garden, and the unique light of the Adriatic.',
            'amenities' => ['Private garden', 'Channel views', 'Wi-Fi', 'Fully equipped kitchen', 'Air conditioning', 'Private parking'],
        ]
    ];

    foreach ($data as $slug => $fields) {
        $property = Property::where('slug', $slug)->first();
        if ($property) {
            $property->update($fields);
            echo "Actualizada: $slug [OK]<br>";
        } else {
            echo "No se encontró la propiedad con slug: $slug<br>";
        }
    }

    echo "<h3 style='color:green;'>Base de datos actualizada correctamente.</h3>";

} catch (\Exception $e) {
    echo "<h3 style='color:red;'>Error: " . $e->getMessage() . "</h3>";
}