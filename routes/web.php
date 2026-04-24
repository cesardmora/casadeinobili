<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PropertyController;
use App\Models\ContactInquiry;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AboutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Main landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// About
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Properties
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');

// Contact form submission
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

// Newsletter subscription
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

// Static pages
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');

// Cambia .name('inquiry.store') por:
// Route::post('/inquiry', [InquiryController::class, 'store'])->name('contact.store');
// Ruta para procesar el formulario
Route::post('/inquiry', [ContactController::class, 'store'])->name('inquiry.store');

// Ruta para la página de agradecimiento (ESTA ES LA QUE FALTA)
Route::get('/gracias', [ContactController::class, 'thanks'])->name('contact.thanks');

Route::match(['get', 'post'], '/admin/contact-inquiries', function (Request $request) {
    $secretKey = env('CONTACT_INQUIRIES_KEY', 'Nobili2026Secure!');
    $sessionKey = 'contact_inquiries_access_granted';

    if ($request->query('key') && hash_equals($secretKey, (string) $request->query('key'))) {
        $request->session()->put($sessionKey, true);

        return redirect()->route('admin.contact-inquiries');
    }

    if ($request->isMethod('post')) {
        $validated = $request->validate([
            'access_key' => ['required', 'string'],
        ]);

        if (hash_equals($secretKey, $validated['access_key'])) {
            $request->session()->put($sessionKey, true);

            return redirect()->route('admin.contact-inquiries');
        }

        return back()
            ->withInput()
            ->withErrors(['access_key' => 'Clave incorrecta.']);
    }

    $authorized = (bool) $request->session()->get($sessionKey, false);

    if (! $authorized) {
        return response()
            ->view('pages.contact-inquiries', [
                'authorized' => false,
            ], 403)
            ->header('X-Robots-Tag', 'noindex, nofollow, noarchive');
    }

    $stats = [
        'total' => ContactInquiry::count(),
        'pending' => ContactInquiry::where('status', 'pending')->count(),
        'replied' => ContactInquiry::where('status', 'replied')->count(),
        'closed' => ContactInquiry::where('status', 'closed')->count(),
    ];

    $filters = [
        'status' => (string) $request->query('status', ''),
        'name' => trim((string) $request->query('name', '')),
        'email' => trim((string) $request->query('email', '')),
        'property_id' => (string) $request->query('property_id', ''),
    ];

    $sort = [
        'column' => (string) $request->query('sort', 'created_at'),
        'direction' => (string) $request->query('direction', 'desc'),
    ];

    $allowedSorts = ['created_at', 'name', 'status'];

    if (! in_array($sort['column'], $allowedSorts, true)) {
        $sort['column'] = 'created_at';
    }

    if (! in_array($sort['direction'], ['asc', 'desc'], true)) {
        $sort['direction'] = 'desc';
    }

    $inquiries = ContactInquiry::query()
        ->with('property')
        ->when($filters['status'] !== '', function ($query) use ($filters) {
            $query->where('status', $filters['status']);
        })
        ->when($filters['name'] !== '', function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        })
        ->when($filters['email'] !== '', function ($query) use ($filters) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        })
        ->when($filters['property_id'] !== '', function ($query) use ($filters) {
            $query->where('property_id', $filters['property_id']);
        })
        ->orderBy($sort['column'], $sort['direction'])
        ->orderBy('id', 'desc')
        ->paginate(12)
        ->withQueryString();

    $properties = Property::query()
        ->orderBy('name')
        ->get(['id', 'name']);

    return response()
        ->view('pages.contact-inquiries', [
            'authorized' => true,
            'inquiries' => $inquiries,
            'stats' => $stats,
            'filters' => $filters,
            'properties' => $properties,
            'sort' => $sort,
        ])
        ->header('X-Robots-Tag', 'noindex, nofollow, noarchive');
})->name('admin.contact-inquiries');

Route::post('/admin/contact-inquiries/{contactInquiry}/status', function (Request $request, ContactInquiry $contactInquiry) {
    if (! $request->session()->get('contact_inquiries_access_granted', false)) {
        abort(403, 'Access denied.');
    }

    $validated = $request->validate([
        'status' => ['required', 'in:pending,replied,closed'],
    ]);

    $contactInquiry->update([
        'status' => $validated['status'],
    ]);

    return redirect()
        ->to(route('admin.contact-inquiries', $request->query()) . '#inquiry-' . $contactInquiry->id)
        ->with('status_updated', 'Inquiry status updated.');
})->name('admin.contact-inquiries.status');

Route::post('/admin/contact-inquiries/logout', function (Request $request) {
    $request->session()->forget('contact_inquiries_access_granted');

    return redirect()->route('admin.contact-inquiries');
})->name('admin.contact-inquiries.logout');

Route::match(['get', 'post'], '/admin/system-tools', function (Request $request) {
    $secretKey = env('ADMIN_TOOLS_KEY', env('CONTACT_INQUIRIES_KEY', 'Nobili2026Secure!'));
    $sessionKey = 'contact_inquiries_access_granted';

    if ($request->query('key') && hash_equals($secretKey, (string) $request->query('key'))) {
        $request->session()->put($sessionKey, true);

        return redirect()->route('admin.system-tools');
    }

    if ($request->isMethod('post') && ! $request->has('action')) {
        $validated = $request->validate([
            'access_key' => ['required', 'string'],
        ]);

        if (hash_equals($secretKey, $validated['access_key'])) {
            $request->session()->put($sessionKey, true);

            return redirect()->route('admin.system-tools');
        }

        return back()
            ->withInput()
            ->withErrors(['access_key' => 'Clave incorrecta.']);
    }

    $authorized = (bool) $request->session()->get($sessionKey, false);

    $tools = [
        'optimize_clear' => [
            'label' => 'Optimize Clear',
            'description' => 'Limpia las cachés de configuración, rutas, eventos, vistas y ficheros bootstrap compilados.',
            'command' => 'optimize:clear',
            'arguments' => [],
            'tone' => 'neutral',
        ],
        'config_clear' => [
            'label' => 'Config Clear',
            'description' => 'Borra la caché de configuración para que Laravel vuelva a leer los ficheros de config y el .env.',
            'command' => 'config:clear',
            'arguments' => [],
            'tone' => 'neutral',
        ],
        'config_cache' => [
            'label' => 'Config Cache',
            'description' => 'Regenera la caché de configuración para producción después de tocar config o el .env.',
            'command' => 'config:cache',
            'arguments' => [],
            'tone' => 'accent',
        ],
        'view_clear' => [
            'label' => 'View Clear',
            'description' => 'Borra las vistas Blade compiladas.',
            'command' => 'view:clear',
            'arguments' => [],
            'tone' => 'neutral',
        ],
        'view_cache' => [
            'label' => 'View Cache',
            'description' => 'Precompila las vistas Blade para acelerar la primera carga.',
            'command' => 'view:cache',
            'arguments' => [],
            'tone' => 'accent',
        ],
        'cache_clear' => [
            'label' => 'Cache Clear',
            'description' => 'Vacía la caché de aplicación configurada en Laravel.',
            'command' => 'cache:clear',
            'arguments' => [],
            'tone' => 'neutral',
        ],
        'migrate_force' => [
            'label' => 'Run Migrations',
            'description' => 'Ejecuta las migraciones pendientes en el servidor de forma segura para producción.',
            'command' => 'migrate',
            'arguments' => ['--force' => true],
            'tone' => 'accent',
        ],
        'seed_properties_force' => [
            'label' => 'Seed Properties',
            'description' => 'Sincroniza la tabla properties con el contenido actual de PropertySeeder.',
            'command' => 'db:seed',
            'arguments' => ['--class' => 'PropertySeeder', '--force' => true],
            'tone' => 'accent',
        ],
        'storage_link' => [
            'label' => 'Storage Link',
            'description' => 'Crea el enlace simbólico public/storage si todavía no existe.',
            'command' => 'storage:link',
            'arguments' => [],
            'tone' => 'neutral',
        ],
        'about' => [
            'label' => 'About',
            'description' => 'Muestra un resumen del entorno, drivers activos y estado general del proyecto.',
            'command' => 'about',
            'arguments' => [],
            'tone' => 'neutral',
        ],
    ];

    if (! $authorized) {
        return response()
            ->view('pages.admin-tools', [
                'authorized' => false,
                'tools' => $tools,
            ], 403)
            ->header('X-Robots-Tag', 'noindex, nofollow, noarchive');
    }

    $runtimeInfo = [
        'app_env' => config('app.env'),
        'app_url' => config('app.url'),
        'db_connection' => config('database.default'),
        'queue_connection' => config('queue.default'),
        'cache_store' => config('cache.default'),
        'mail_mailer' => config('mail.default'),
    ];

    return response()
        ->view('pages.admin-tools', [
            'authorized' => true,
            'tools' => $tools,
            'runtimeInfo' => $runtimeInfo,
        ])
        ->header('X-Robots-Tag', 'noindex, nofollow, noarchive');
})->name('admin.system-tools');

Route::post('/admin/system-tools/run', function (Request $request) {
    if (! $request->session()->get('contact_inquiries_access_granted', false)) {
        abort(403, 'Access denied.');
    }

    $validated = $request->validate([
        'action' => ['required', 'string'],
    ]);

    $actions = [
        'optimize_clear' => ['command' => 'optimize:clear', 'arguments' => []],
        'config_clear' => ['command' => 'config:clear', 'arguments' => []],
        'config_cache' => ['command' => 'config:cache', 'arguments' => []],
        'view_clear' => ['command' => 'view:clear', 'arguments' => []],
        'view_cache' => ['command' => 'view:cache', 'arguments' => []],
        'cache_clear' => ['command' => 'cache:clear', 'arguments' => []],
        'migrate_force' => ['command' => 'migrate', 'arguments' => ['--force' => true]],
        'seed_properties_force' => ['command' => 'db:seed', 'arguments' => ['--class' => 'PropertySeeder', '--force' => true]],
        'storage_link' => ['command' => 'storage:link', 'arguments' => []],
        'about' => ['command' => 'about', 'arguments' => []],
    ];

    if (! isset($actions[$validated['action']])) {
        return redirect()
            ->route('admin.system-tools')
            ->with('tool_status', [
                'type' => 'error',
                'title' => 'Acción no permitida',
                'output' => 'La acción solicitada no está en la lista blanca.',
            ]);
    }

    $action = $actions[$validated['action']];

    try {
        $exitCode = Artisan::call($action['command'], $action['arguments']);
        $output = trim(Artisan::output());

        return redirect()
            ->route('admin.system-tools')
            ->with('tool_status', [
                'type' => $exitCode === 0 ? 'success' : 'error',
                'title' => sprintf('%s ejecutado', $action['command']),
                'output' => $output !== '' ? $output : 'El comando terminó sin salida adicional.',
            ]);
    } catch (\Throwable $e) {
        return redirect()
            ->route('admin.system-tools')
            ->with('tool_status', [
                'type' => 'error',
                'title' => sprintf('Error al ejecutar %s', $action['command']),
                'output' => $e->getMessage(),
            ]);
    }
})->name('admin.system-tools.run');
