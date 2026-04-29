<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class SystemToolsController extends Controller
{
    private const SESSION_KEY = 'contact_inquiries_access_granted';

    public function index(Request $request): View|Response|RedirectResponse
    {
        $secretKey = (string) config('app.admin_key', env('ADMIN_TOOLS_KEY', env('CONTACT_INQUIRIES_KEY', 'Nobili2026Secure!')));

        if ($request->query('key') && hash_equals($secretKey, (string) $request->query('key'))) {
            $request->session()->put(self::SESSION_KEY, true);

            return redirect()->route('admin.system-tools');
        }

        if ($request->isMethod('post') && ! $request->has('action')) {
            $validated = $request->validate([
                'access_key' => ['required', 'string'],
            ]);

            if (hash_equals($secretKey, $validated['access_key'])) {
                $request->session()->put(self::SESSION_KEY, true);

                return redirect()->route('admin.system-tools');
            }

            return back()
                ->withInput()
                ->withErrors(['access_key' => 'Clave incorrecta.']);
        }

        if (! $this->isAuthorized($request)) {
            return $this->adminResponse('pages.admin-tools', [
                'authorized' => false,
                'tools' => $this->tools(),
            ], 403);
        }

        $runtimeInfo = [
            'app_env' => config('app.env'),
            'app_url' => config('app.url'),
            'db_connection' => config('database.default'),
            'queue_connection' => config('queue.default'),
            'cache_store' => config('cache.default'),
            'mail_mailer' => config('mail.default'),
        ];

        return $this->adminResponse('pages.admin-tools', [
            'authorized' => true,
            'tools' => $this->tools(),
            'runtimeInfo' => $runtimeInfo,
        ]);
    }

    public function run(Request $request): RedirectResponse
    {
        if (! $this->isAuthorized($request)) {
            abort(403, 'Access denied.');
        }

        $validated = $request->validate([
            'action' => ['required', 'string'],
        ]);

        $actions = $this->actions();

        if (! isset($actions[$validated['action']])) {
            return redirect()
                ->route('admin.system-tools')
                ->with('tool_status', [
                    'type' => 'error',
                    'title' => 'Accion no permitida',
                    'output' => 'La accion solicitada no esta en la lista blanca.',
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
                    'output' => $output !== '' ? $output : 'El comando termino sin salida adicional.',
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
    }

    private function tools(): array
    {
        return [
            'optimize_clear' => [
                'label' => 'Optimize Clear',
                'description' => 'Limpia las caches de configuracion, rutas, eventos, vistas y ficheros bootstrap compilados.',
                'command' => 'optimize:clear',
                'arguments' => [],
                'tone' => 'neutral',
            ],
            'config_clear' => [
                'label' => 'Config Clear',
                'description' => 'Borra la cache de configuracion para que Laravel vuelva a leer los ficheros de config y el .env.',
                'command' => 'config:clear',
                'arguments' => [],
                'tone' => 'neutral',
            ],
            'config_cache' => [
                'label' => 'Config Cache',
                'description' => 'Regenera la cache de configuracion para produccion despues de tocar config o el .env.',
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
                'description' => 'Vacia la cache de aplicacion configurada en Laravel.',
                'command' => 'cache:clear',
                'arguments' => [],
                'tone' => 'neutral',
            ],
            'migrate_force' => [
                'label' => 'Run Migrations',
                'description' => 'Ejecuta las migraciones pendientes en el servidor de forma segura para produccion.',
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
                'description' => 'Crea el enlace simbolico public/storage si todavia no existe.',
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
    }

    private function actions(): array
    {
        return collect($this->tools())
            ->map(fn (array $tool): array => [
                'command' => $tool['command'],
                'arguments' => $tool['arguments'],
            ])
            ->all();
    }

    private function isAuthorized(Request $request): bool
    {
        return (bool) $request->session()->get(self::SESSION_KEY, false);
    }

    private function adminResponse(string $view, array $data, int $status = 200): Response
    {
        return response()
            ->view($view, $data, $status)
            ->header('X-Robots-Tag', 'noindex, nofollow, noarchive');
    }
}
