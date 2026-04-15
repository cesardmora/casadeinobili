<?php
// PROTECCIÓN: accede con ?key=TU_CLAVE
$SECRET_KEY = 'Nobili2026Secure!';
if (!isset($_GET['key']) || $_GET['key'] !== $SECRET_KEY) {
    http_response_code(403);
    die('Acceso denegado. Necesitas la clave de acceso.');
}

// 1. Intentar cargar las variables del .env manualmente
$env = parse_ini_file(__DIR__ . '/.env');

// CAMBIO CRUCIAL: Si es localhost, usamos 127.0.0.1 para evitar el error de socket
$host = ($env['DB_HOST'] === 'localhost') ? '127.0.0.1' : $env['DB_HOST'];
$db   = $env['DB_DATABASE'];
$user = $env['DB_USERNAME'];
$pass = $env['DB_PASSWORD'];
$port = $env['DB_PORT'] ?? '3306'; // Añadimos el puerto por si acaso

try {
    // Especificamos el host y el puerto directamente
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexión establecida exitosamente con 127.0.0.1...<br>";

    // ... (el resto del código de los updates que te pasé antes igual)
 

    // Datos a actualizar (Traducciones del PropertySeeder)
    $updates = [
        'ca-serenissima' => [
            'name' => 'Ca Serenissima',
            'century' => '15th Century',
            'tagline' => 'The origin of the collection',
            'description' => 'The crown jewel of medieval Korčula. Original Gothic arches, limestone courtyards, and views of the cathedral bell tower.'
        ],
        'palacio-arneri' => [
            'name' => 'Arneri Palace',
            'century' => '17th Century',
            'tagline' => 'Baroque grandeur on the edge of the Adriatic',
            'description' => 'A testament to Venetian opulence in Dalmatia. Double-height ceilings, original frescoes, and a terrace overlooking the Adriatic.'
        ],
        'casa-renacentista' => [
            'name' => 'Renaissance House',
            'century' => '16th Century',
            'tagline' => 'Renaissance elegance with channel views',
            'description' => 'Renaissance elegance overlooking the Korčula channel. Perfect proportions, a private garden, and the unique light of the Adriatic.'
        ]
    ];

    foreach ($updates as $slug => $data) {
        $sql = "UPDATE properties SET 
                name = :name, 
                century = :century, 
                tagline = :tagline, 
                description = :description 
                WHERE slug = :slug";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'        => $data['name'],
            ':century'     => $data['century'],
            ':tagline'     => $data['tagline'],
            ':description' => $data['description'],
            ':slug'        => $slug
        ]);
        echo "Actualizado: $slug<br>";
    }

    echo "<h3 style='color:green;'>¡Traducciones aplicadas con éxito!</h3>";

} catch (Exception $e) {
    echo "<h3 style='color:red;'>Error: " . $e->getMessage() . "</h3>";
}