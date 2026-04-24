@extends('layouts.app')

@section('title', 'System Tools | Case dei Nobili')
@section('meta_description', 'Private server maintenance tools.')
@section('canonical', route('admin.system-tools'))

@push('head')
  <style>
    body.admin-tools-page {
      background:
        radial-gradient(circle at top, rgba(184, 149, 107, 0.18), transparent 36%),
        linear-gradient(180deg, #f7f1e8 0%, #efe5d8 100%);
      color: #241d18;
    }

    body.admin-tools-page #mainNav {
      position: sticky;
      top: 0;
      z-index: 60;
      background: rgba(18, 28, 36, 0.96) !important;
      backdrop-filter: blur(18px);
      border-bottom: 1px solid rgba(212, 184, 150, 0.18);
      box-shadow: 0 18px 40px rgba(8, 13, 17, 0.22);
    }

    body.admin-tools-page #mainNav .nav-logo,
    body.admin-tools-page #mainNav .nav-logo-text,
    body.admin-tools-page #mainNav .nav-links-desktop a,
    body.admin-tools-page #mainNav .lang-btn,
    body.admin-tools-page #mainNav #mobileMenuBtn {
      opacity: 1 !important;
      color: #f4ebdc !important;
    }

    .admin-shell {
      padding-top: 6.75rem;
      padding-bottom: 4rem;
    }

    .admin-panel,
    .admin-card,
    .admin-stat {
      border: 1px solid rgba(66, 49, 33, 0.08);
      background: rgba(255, 252, 247, 0.94);
      box-shadow: 0 18px 48px rgba(78, 58, 37, 0.09);
      backdrop-filter: blur(12px);
    }

    .admin-input {
      width: 100%;
      border: 1px solid rgba(66, 49, 33, 0.12);
      border-radius: 16px;
      background: #fffdf9;
      color: #241d18;
      padding: 0.95rem 1rem;
      font-size: 0.95rem;
      outline: none;
    }

    .admin-input:focus {
      border-color: rgba(155, 110, 58, 0.5);
      box-shadow: 0 0 0 4px rgba(184, 149, 107, 0.12);
    }

    .tool-button {
      display: inline-flex;
      width: 100%;
      align-items: center;
      justify-content: center;
      border-radius: 18px;
      padding: 0.95rem 1.1rem;
      font-size: 0.72rem;
      letter-spacing: 0.24em;
      text-transform: uppercase;
      transition: opacity 0.2s ease, transform 0.2s ease, background 0.2s ease;
    }

    .tool-button:hover {
      opacity: 0.92;
      transform: translateY(-1px);
    }

    .tool-button-neutral {
      border: 1px solid rgba(28, 37, 48, 0.14);
      background: transparent;
      color: #1c2530;
    }

    .tool-button-accent {
      background: #1c2530;
      color: #ffffff;
    }

    .tool-output {
      white-space: pre-wrap;
      word-break: break-word;
      border: 1px solid rgba(66, 49, 33, 0.08);
      background: #fffdf9;
    }
  </style>
@endpush

@section('content')
  <script>
    document.body.classList.add('admin-tools-page');
  </script>

  <section class="admin-shell min-h-screen px-1 sm:px-2 lg:px-3 2xl:px-4">
    <div class="mx-auto w-full max-w-[1800px]">
      @if(! $authorized)
        <div class="admin-panel mx-auto max-w-xl overflow-hidden rounded-[28px]">
          <div class="border-b border-black/5 px-8 py-8">
            <p class="mb-3 text-xs uppercase tracking-[0.35em]" style="color: #8f6f45;">Private access</p>
            <h1 class="font-display text-4xl font-light" style="color: #1c2530;">System tools</h1>
            <p class="mt-4 text-sm leading-7" style="color: #5b4f43;">
              Enter the access key to run curated maintenance tasks on the server.
            </p>
          </div>

          <form method="POST" action="{{ route('admin.system-tools') }}" class="space-y-6 px-8 py-8">
            @csrf

            <div>
              <label for="access_key" class="mb-2 block text-xs uppercase tracking-[0.25em]" style="color: #6b5d4e;">
                Access key
              </label>
              <input
                id="access_key"
                name="access_key"
                type="password"
                required
                autofocus
                class="admin-input"
                placeholder="Enter the password"
              >
              @error('access_key')
                <p class="mt-3 text-sm" style="color: #a43d2c;">{{ $message }}</p>
              @enderror
            </div>

            <button type="submit" class="tool-button tool-button-accent">
              Enter
            </button>
          </form>
        </div>
      @else
        <div class="mb-10 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
          <div>
            <p class="mb-3 text-xs uppercase tracking-[0.35em]" style="color: #8f6f45;">Private dashboard</p>
            <h1 class="font-display text-4xl font-light lg:text-6xl" style="color: #1c2530;">System tools</h1>
            <p class="mt-4 max-w-3xl text-sm leading-7" style="color: #5b4f43;">
              Curated maintenance actions for the server. This panel intentionally exposes only a safe whitelist of commands.
            </p>
          </div>

          <div class="flex flex-col gap-3 sm:flex-row">
            <a
              href="{{ route('admin.contact-inquiries') }}"
              class="tool-button tool-button-neutral"
              style="max-width: 240px;"
            >
              Contact dashboard
            </a>
            <form method="POST" action="{{ route('admin.contact-inquiries.logout') }}">
              @csrf
              <button
                type="submit"
                class="tool-button tool-button-neutral"
                style="max-width: 240px;"
              >
                Log out
              </button>
            </form>
          </div>
        </div>

        @if(session('tool_status'))
          @php($toolStatus = session('tool_status'))
          <div class="admin-panel mb-8 rounded-[24px] px-5 py-5">
            <div class="flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">
              <div>
                <p class="text-xs uppercase tracking-[0.24em]" style="color: {{ ($toolStatus['type'] ?? '') === 'success' ? '#376543' : '#9a3d2d' }};">
                  {{ ($toolStatus['type'] ?? '') === 'success' ? 'Success' : 'Error' }}
                </p>
                <h2 class="mt-2 font-display text-3xl font-light" style="color: #1c2530;">{{ $toolStatus['title'] ?? 'Result' }}</h2>
              </div>
            </div>
            <div class="tool-output mt-4 rounded-[20px] px-4 py-4 text-sm leading-7" style="color: #3d3229;">
              {{ $toolStatus['output'] ?? '' }}
            </div>
          </div>
        @endif

        <div class="mb-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
          <div class="admin-stat rounded-[24px] px-6 py-5">
            <p class="text-xs uppercase tracking-[0.25em]" style="color: #8f6f45;">Environment</p>
            <p class="mt-3 font-display text-3xl font-light" style="color: #1c2530;">{{ $runtimeInfo['app_env'] ?? '-' }}</p>
          </div>
          <div class="admin-stat rounded-[24px] px-6 py-5">
            <p class="text-xs uppercase tracking-[0.25em]" style="color: #8f6f45;">Database</p>
            <p class="mt-3 font-display text-3xl font-light" style="color: #1c2530;">{{ $runtimeInfo['db_connection'] ?? '-' }}</p>
          </div>
          <div class="admin-stat rounded-[24px] px-6 py-5">
            <p class="text-xs uppercase tracking-[0.25em]" style="color: #8f6f45;">Queue</p>
            <p class="mt-3 font-display text-3xl font-light" style="color: #1c2530;">{{ $runtimeInfo['queue_connection'] ?? '-' }}</p>
          </div>
        </div>

        <div class="mb-6 admin-card rounded-[24px] px-6 py-5">
          <p class="text-xs uppercase tracking-[0.25em]" style="color: #8f6f45;">Current runtime</p>
          <div class="mt-4 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            <div>
              <p class="text-[11px] uppercase tracking-[0.2em]" style="color: #8f6f45;">App URL</p>
              <p class="mt-2 text-sm leading-7" style="color: #3d3229;">{{ $runtimeInfo['app_url'] ?? '-' }}</p>
            </div>
            <div>
              <p class="text-[11px] uppercase tracking-[0.2em]" style="color: #8f6f45;">Cache store</p>
              <p class="mt-2 text-sm leading-7" style="color: #3d3229;">{{ $runtimeInfo['cache_store'] ?? '-' }}</p>
            </div>
            <div>
              <p class="text-[11px] uppercase tracking-[0.2em]" style="color: #8f6f45;">Mail mailer</p>
              <p class="mt-2 text-sm leading-7" style="color: #3d3229;">{{ $runtimeInfo['mail_mailer'] ?? '-' }}</p>
            </div>
          </div>
        </div>

        <div class="grid gap-5 lg:grid-cols-2 xl:grid-cols-3">
          @foreach($tools as $key => $tool)
            <article class="admin-card rounded-[24px] p-6">
              <p class="text-xs uppercase tracking-[0.26em]" style="color: #8f6f45;">{{ str_replace('_', ' ', $key) }}</p>
              <h2 class="mt-3 font-display text-3xl font-light" style="color: #1c2530;">{{ $tool['label'] }}</h2>
              <p class="mt-3 text-sm leading-7" style="color: #5b4f43;">{{ $tool['description'] }}</p>

              <form method="POST" action="{{ route('admin.system-tools.run') }}" class="mt-6">
                @csrf
                <input type="hidden" name="action" value="{{ $key }}">
                <button
                  type="submit"
                  class="tool-button {{ ($tool['tone'] ?? 'neutral') === 'accent' ? 'tool-button-accent' : 'tool-button-neutral' }}"
                >
                  Run now
                </button>
              </form>
            </article>
          @endforeach
        </div>

        <div class="admin-panel mt-8 rounded-[24px] px-6 py-5">
          <p class="text-xs uppercase tracking-[0.25em]" style="color: #8f6f45;">Notes</p>
          <div class="mt-4 space-y-3 text-sm leading-7" style="color: #5b4f43;">
            <p>`route:cache` no está incluido porque este proyecto usa varias rutas con closures y Laravel fallaría al cachearlas.</p>
            <p>`migrate:fresh`, `phpinfo()`, scripts de permisos o cambios SQL manuales tampoco están expuestos aquí para no abrir acciones destructivas desde web.</p>
            <p>Si ejecutas `config:cache` después de cambiar el `.env`, recarga esta página para confirmar que los valores de runtime se han actualizado.</p>
          </div>
        </div>
      @endif
    </div>
  </section>
@endsection
