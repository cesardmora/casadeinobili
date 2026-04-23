@extends('layouts.app')

@section('title', 'Private Inquiries | Case dei Nobili')
@section('meta_description', 'Private access to contact inquiries.')
@section('canonical', route('admin.contact-inquiries'))

@push('head')
  <style>
    body.admin-inquiries-page {
      background:
        radial-gradient(circle at top, rgba(184, 149, 107, 0.18), transparent 36%),
        linear-gradient(180deg, #f7f1e8 0%, #efe5d8 100%);
      color: #241d18;
    }

    body.admin-inquiries-page #mainNav {
      position: sticky;
      top: 0;
      z-index: 60;
      background: rgba(18, 28, 36, 0.96) !important;
      backdrop-filter: blur(18px);
      border-bottom: 1px solid rgba(212, 184, 150, 0.18);
      box-shadow: 0 18px 40px rgba(8, 13, 17, 0.22);
    }

    body.admin-inquiries-page #mainNav .nav-logo,
    body.admin-inquiries-page #mainNav .nav-logo-text,
    body.admin-inquiries-page #mainNav .nav-links-desktop a,
    body.admin-inquiries-page #mainNav .lang-btn,
    body.admin-inquiries-page #mainNav #mobileMenuBtn {
      opacity: 1 !important;
      color: #f4ebdc !important;
    }

    body.admin-inquiries-page #mainNav .nav-logo-shield {
      filter: brightness(1.2);
    }

    body.admin-inquiries-page #mainNav.nav-scrolled,
    body.admin-inquiries-page #mainNav.scrolled {
      background: rgba(18, 28, 36, 0.96) !important;
    }

    body.admin-inquiries-page #mainNav .nav-links-desktop a:hover,
    body.admin-inquiries-page #mainNav .lang-btn:hover,
    body.admin-inquiries-page #mainNav .lang-btn.active {
      color: #d8b487 !important;
    }

    body.admin-inquiries-page #mainNav #mobileMenuBtn svg {
      color: #f4ebdc !important;
    }

    .admin-shell {
      padding-top: 6.75rem;
      padding-bottom: 4rem;
    }

    .admin-panel {
      border: 1px solid rgba(66, 49, 33, 0.08);
      background: rgba(255, 252, 247, 0.92);
      box-shadow: 0 24px 70px rgba(78, 58, 37, 0.1);
      backdrop-filter: blur(12px);
    }

    .admin-stat {
      border: 1px solid rgba(66, 49, 33, 0.08);
      background: linear-gradient(180deg, rgba(255, 254, 251, 0.98), rgba(248, 241, 232, 0.98));
      box-shadow: 0 12px 30px rgba(78, 58, 37, 0.08);
    }

    .admin-table {
      border-collapse: separate;
      border-spacing: 0;
      width: 100%;
      table-layout: fixed;
    }

    .admin-table thead th {
      background: #1f2933;
      color: #f7f1e8;
      font-size: 0.82rem;
      letter-spacing: 0.02em;
    }

    .admin-table tbody tr:nth-child(odd) {
      background: #fffdf9;
    }

    .admin-table tbody tr:nth-child(even) {
      background: #f7f0e7;
    }

    .admin-table tbody td {
      color: #2f261f;
      border-top: 1px solid rgba(77, 59, 38, 0.08);
      vertical-align: top;
    }

    .admin-table .muted {
      color: #746454;
    }

    .admin-table .strong {
      color: #1f1915;
    }

    .admin-badge {
      display: inline-flex;
      align-items: center;
      border-radius: 999px;
      padding: 0.45rem 0.8rem;
      font-size: 0.68rem;
      font-weight: 600;
      letter-spacing: 0.18em;
      text-transform: uppercase;
    }

    .admin-status-select-wrap {
      position: relative;
      display: inline-block;
      min-width: 138px;
    }

    .admin-status-select-wrap::after {
      content: "";
      position: absolute;
      top: 50%;
      right: 0.95rem;
      transform: translateY(-35%);
      width: 0;
      height: 0;
      border-left: 5px solid transparent;
      border-right: 5px solid transparent;
      border-top: 9px solid #111111;
      pointer-events: none;
      z-index: 2;
      opacity: 1;
    }

    .admin-status-select {
      width: 100%;
      min-width: 138px;
      border: 1px solid rgba(66, 49, 33, 0.12);
      border-radius: 999px;
      background-color: #fffaf2;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      color: #241d18;
      padding: 0.55rem 2.35rem 0.55rem 0.8rem;
      font-size: 0.72rem;
      font-weight: 600;
      letter-spacing: 0.16em;
      text-transform: uppercase;
      outline: none;
      box-shadow: inset 0 0 0 999px #fffaf2;
    }

    .admin-status-select.status-pending {
      background-color: #f3e4b6;
      border-color: rgba(184, 149, 107, 0.45);
      color: #5a451d;
      box-shadow: inset 0 0 0 999px #f3e4b6;
    }

    .admin-status-select.status-replied {
      background-color: #d9ead7;
      border-color: rgba(89, 136, 92, 0.28);
      color: #24412b;
      box-shadow: inset 0 0 0 999px #d9ead7;
    }

    .admin-status-select.status-closed {
      background-color: #e4e0db;
      border-color: rgba(98, 84, 67, 0.24);
      color: #40352d;
      box-shadow: inset 0 0 0 999px #e4e0db;
    }

    .admin-sort-link {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      color: inherit;
      text-decoration: none;
    }

    .admin-sort-link:hover {
      color: #d8b487;
    }

    .admin-sort-indicator {
      font-size: 0.72rem;
      opacity: 0.8;
    }

    .admin-card {
      border: 1px solid rgba(66, 49, 33, 0.08);
      background: rgba(255, 252, 247, 0.96);
      box-shadow: 0 12px 30px rgba(78, 58, 37, 0.08);
    }

    .admin-filter-panel {
      border: 1px solid rgba(66, 49, 33, 0.08);
      background: rgba(255, 252, 247, 0.96);
      box-shadow: 0 18px 44px rgba(78, 58, 37, 0.09);
    }

    .admin-input,
    .admin-select {
      width: 100%;
      border: 1px solid rgba(66, 49, 33, 0.12);
      border-radius: 16px;
      background: #fffdf9;
      color: #241d18;
      padding: 0.95rem 1rem;
      font-size: 0.95rem;
      outline: none;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .admin-input:focus,
    .admin-select:focus {
      border-color: rgba(155, 110, 58, 0.5);
      box-shadow: 0 0 0 4px rgba(184, 149, 107, 0.12);
    }

    .admin-table-wrap {
      overflow: hidden;
      border: 1px solid rgba(66, 49, 33, 0.08);
      border-radius: 28px;
      background: rgba(255, 252, 247, 0.96);
      box-shadow: 0 24px 70px rgba(78, 58, 37, 0.1);
    }

    .admin-table .col-lead {
      width: 18%;
    }

    .admin-table .col-contact {
      width: 18%;
    }

    .admin-table .col-stay {
      width: 14%;
    }

    .admin-table .col-property {
      width: 12%;
    }

    .admin-table .col-type {
      width: 8%;
    }

    .admin-table .col-status {
      width: 10%;
    }

    .admin-table .col-message {
      width: 20%;
    }

    @media (max-width: 1279px) {
      .admin-shell {
        padding-top: 6rem;
      }
    }

    @media (max-width: 767px) {
      .admin-shell {
        padding-top: 5.25rem;
      }

      .admin-status-select-wrap {
        min-width: 100%;
      }

      .admin-status-select {
        min-width: 100%;
      }
    }
  </style>
@endpush

@section('content')
  <script>
    document.body.classList.add('admin-inquiries-page');

    const adminStatusClasses = ['status-pending', 'status-replied', 'status-closed'];

    function updateAdminStatusSelect(select) {
      if (!select) return;

      select.classList.remove(...adminStatusClasses);
      select.classList.add(`status-${select.value}`);
    }

    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.admin-status-select').forEach(updateAdminStatusSelect);
    });
  </script>

  <section class="admin-shell min-h-screen px-1 sm:px-2 lg:px-3 2xl:px-4">
    <div class="mx-auto w-full max-w-[2400px]">
      @php
        $sort = $sort ?? [
            'column' => 'created_at',
            'direction' => 'desc',
        ];

        $statusMeta = [
            'pending' => ['label' => 'Pending', 'bg' => '#f3e4b6', 'text' => '#3a3027'],
            'replied' => ['label' => 'Replied', 'bg' => '#d9ead7', 'text' => '#24412b'],
            'closed' => ['label' => 'Closed', 'bg' => '#e4e0db', 'text' => '#40352d'],
        ];

        $sortDirectionFor = function (string $column) use ($sort): string {
            if (($sort['column'] ?? 'created_at') !== $column) {
                return 'asc';
            }

            return ($sort['direction'] ?? 'desc') === 'asc' ? 'desc' : 'asc';
        };

        $sortIndicatorFor = function (string $column) use ($sort): string {
            if (($sort['column'] ?? 'created_at') !== $column) {
                return '';
            }

            return ($sort['direction'] ?? 'desc') === 'asc' ? '↑' : '↓';
        };
      @endphp

      @if(! $authorized)
        <div class="admin-panel mx-auto max-w-xl overflow-hidden rounded-[28px]">
          <div class="border-b border-black/5 px-8 py-8">
            <p class="mb-3 text-xs uppercase tracking-[0.35em]" style="color: #8f6f45;">Private access</p>
            <h1 class="font-display text-4xl font-light" style="color: #1c2530;">Contact inquiries</h1>
            <p class="mt-4 text-sm leading-7" style="color: #5b4f43;">
              Enter the access key to view the inquiries stored in the database.
            </p>
          </div>

          <form method="POST" action="{{ route('admin.contact-inquiries') }}" class="space-y-6 px-8 py-8">
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
                class="w-full rounded-2xl border px-4 py-4 text-sm outline-none transition"
                style="border-color: rgba(28,37,48,0.12); background: #fffdf9; color: #1c2530;"
                placeholder="Enter the password"
              >
              @error('access_key')
                <p class="mt-3 text-sm" style="color: #a43d2c;">{{ $message }}</p>
              @enderror
            </div>

            <button
              type="submit"
              class="inline-flex w-full items-center justify-center rounded-2xl px-6 py-4 text-xs uppercase tracking-[0.3em] text-white transition hover:opacity-90"
              style="background: #1c2530;"
            >
              Enter
            </button>

            <p class="text-xs leading-6" style="color: #7d6e5f;">
              You can also sign in once with <code>?key=YOUR_KEY</code>. If it is valid, the session is saved and the URL is cleaned automatically.
            </p>
          </form>
        </div>
      @else
        @if(session('status_updated'))
          <div class="admin-panel mb-6 rounded-[22px] px-5 py-4 text-sm" style="color: #24412b;">
            {{ session('status_updated') }}
          </div>
        @endif

        <div class="mb-10 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
          <div>
            <p class="mb-3 text-xs uppercase tracking-[0.35em]" style="color: #8f6f45;">Private dashboard</p>
            <h1 class="font-display text-4xl font-light lg:text-6xl" style="color: #1c2530;">Contact inquiries</h1>
            <p class="mt-4 max-w-2xl text-sm leading-7" style="color: #5b4f43;">
              Private view of the <code>contact_inquiries</code> table in <code>database/database.sqlite</code>.
            </p>
          </div>

          <form method="POST" action="{{ route('admin.contact-inquiries.logout') }}">
            @csrf
            <button
              type="submit"
              class="inline-flex items-center justify-center rounded-2xl border px-5 py-3 text-xs uppercase tracking-[0.25em] transition hover:bg-black/5"
              style="border-color: rgba(28,37,48,0.14); color: #1c2530;"
            >
              Log out
            </button>
          </form>
        </div>

        <div class="mb-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
          <div class="admin-stat rounded-[24px] px-6 py-5">
            <p class="text-xs uppercase tracking-[0.25em]" style="color: #8f6f45;">Total</p>
            <p class="mt-3 font-display text-4xl font-light" style="color: #1c2530;">{{ $stats['total'] }}</p>
          </div>
          <div class="admin-stat rounded-[24px] px-6 py-5">
            <p class="text-xs uppercase tracking-[0.25em]" style="color: #8f6f45;">Pending</p>
            <p class="mt-3 font-display text-4xl font-light" style="color: #1c2530;">{{ $stats['pending'] }}</p>
          </div>
          <div class="admin-stat rounded-[24px] px-6 py-5">
            <p class="text-xs uppercase tracking-[0.25em]" style="color: #8f6f45;">Replied</p>
            <p class="mt-3 font-display text-4xl font-light" style="color: #1c2530;">{{ $stats['replied'] }}</p>
          </div>
          <div class="admin-stat rounded-[24px] px-6 py-5">
            <p class="text-xs uppercase tracking-[0.25em]" style="color: #8f6f45;">Closed</p>
            <p class="mt-3 font-display text-4xl font-light" style="color: #1c2530;">{{ $stats['closed'] }}</p>
          </div>
        </div>

        <div class="mb-5 flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
          <p class="text-sm" style="color: #5b4f43;">
            Showing {{ $inquiries->firstItem() ?? 0 }}-{{ $inquiries->lastItem() ?? 0 }} of {{ $inquiries->total() }} results
          </p>
          <p class="text-xs uppercase tracking-[0.24em]" style="color: #8f6f45;">
            Sorted by {{ $sort['column'] === 'created_at' ? 'date' : $sort['column'] }} · {{ $sort['direction'] }}
          </p>
        </div>

        <form method="GET" action="{{ route('admin.contact-inquiries') }}" class="admin-filter-panel mb-8 rounded-[28px] px-5 py-5 lg:px-6">
          <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-[1.1fr_1.1fr_1fr_1fr_auto_auto]">
            <div>
              <label for="filter_status" class="mb-2 block text-[11px] uppercase tracking-[0.24em]" style="color: #8f6f45;">Status</label>
              <select id="filter_status" name="status" class="admin-select">
                <option value="">All statuses</option>
                <option value="pending" @selected(($filters['status'] ?? '') === 'pending')>Pending</option>
                <option value="replied" @selected(($filters['status'] ?? '') === 'replied')>Replied</option>
                <option value="closed" @selected(($filters['status'] ?? '') === 'closed')>Closed</option>
              </select>
            </div>

            <div>
              <label for="filter_name" class="mb-2 block text-[11px] uppercase tracking-[0.24em]" style="color: #8f6f45;">Name</label>
              <input id="filter_name" name="name" type="text" value="{{ $filters['name'] ?? '' }}" class="admin-input" placeholder="Search by name">
            </div>

            <div>
              <label for="filter_email" class="mb-2 block text-[11px] uppercase tracking-[0.24em]" style="color: #8f6f45;">Email</label>
              <input id="filter_email" name="email" type="text" value="{{ $filters['email'] ?? '' }}" class="admin-input" placeholder="Search by email">
            </div>

            <div>
              <label for="filter_property" class="mb-2 block text-[11px] uppercase tracking-[0.24em]" style="color: #8f6f45;">Property</label>
              <select id="filter_property" name="property_id" class="admin-select">
                <option value="">All properties</option>
                @foreach($properties as $property)
                  <option value="{{ $property->id }}" @selected(($filters['property_id'] ?? '') === (string) $property->id)>{{ $property->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="flex items-end">
              <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl px-5 py-4 text-xs uppercase tracking-[0.24em] text-white transition hover:opacity-90" style="background: #1c2530;">
                Filter
              </button>
            </div>

            <div class="flex items-end">
              <a href="{{ route('admin.contact-inquiries') }}" class="inline-flex w-full items-center justify-center rounded-2xl border px-5 py-4 text-xs uppercase tracking-[0.24em] transition hover:bg-black/5" style="border-color: rgba(28,37,48,0.14); color: #1c2530;">
                Reset
              </a>
            </div>
          </div>
        </form>

        <div class="admin-table-wrap mb-6 hidden xl:block">
          <table class="admin-table min-w-full text-left text-sm">
            <thead>
              <tr>
                <th class="col-lead px-6 py-5 font-medium">
                  <a class="admin-sort-link" href="{{ route('admin.contact-inquiries', array_merge(request()->query(), ['sort' => 'name', 'direction' => $sortDirectionFor('name'), 'page' => 1])) }}">
                    <span>Lead</span>
                    <span class="admin-sort-indicator">{{ $sortIndicatorFor('name') }}</span>
                  </a>
                </th>
                <th class="col-contact px-6 py-5 font-medium">Contact</th>
                <th class="col-stay px-6 py-5 font-medium">Stay</th>
                <th class="col-property px-6 py-5 font-medium">Property</th>
                <th class="col-type px-6 py-5 font-medium">Inquiry</th>
                <th class="col-status px-5 py-5 font-medium">
                  <a class="admin-sort-link" href="{{ route('admin.contact-inquiries', array_merge(request()->query(), ['sort' => 'status', 'direction' => $sortDirectionFor('status'), 'page' => 1])) }}">
                    <span>Status</span>
                    <span class="admin-sort-indicator">{{ $sortIndicatorFor('status') }}</span>
                  </a>
                </th>
                <th class="col-message px-6 py-5 font-medium">Message</th>
              </tr>
            </thead>
            <tbody>
              @forelse($inquiries as $inquiry)
                <tr id="inquiry-{{ $inquiry->id }}" class="align-top">
                  <td class="px-6 py-5">
                    <p class="muted text-xs uppercase tracking-[0.22em]">#{{ $inquiry->id }}</p>
                    <p class="strong mt-2 font-semibold">{{ $inquiry->name }}</p>
                    <p class="muted mt-3 text-xs">{{ optional($inquiry->created_at)->format('d/m/Y H:i') }}</p>
                  </td>
                  <td class="px-6 py-5">
                    <a href="mailto:{{ $inquiry->email }}" class="underline decoration-black/20 underline-offset-4">
                      {{ $inquiry->email }}
                    </a>
                    <p class="muted mt-2">{{ $inquiry->phone ?: '-' }}</p>
                  </td>
                  <td class="px-6 py-5">
                    <p><span class="muted">Arrival:</span> <span class="strong">{{ optional($inquiry->arrival_date)->format('d/m/Y') ?: '-' }}</span></p>
                    <p class="mt-2"><span class="muted">Departure:</span> <span class="strong">{{ optional($inquiry->departure_date)->format('d/m/Y') ?: '-' }}</span></p>
                    <p class="mt-2"><span class="muted">Guests:</span> <span class="strong">{{ $inquiry->guests ?: '-' }}</span></p>
                  </td>
                  <td class="px-6 py-5">
                    <p class="strong">{{ optional($inquiry->property)->name ?: 'Unassigned' }}</p>
                  </td>
                  <td class="px-6 py-5">
                    <p class="strong">{{ $inquiry->inquiry_type_label }}</p>
                  </td>
                  <td class="px-5 py-4">
                    <form method="POST" action="{{ route('admin.contact-inquiries.status', $inquiry) }}?{{ http_build_query(request()->query()) }}">
                      @csrf
                      <span class="admin-status-select-wrap">
                        <select name="status" class="admin-status-select status-{{ $inquiry->status }}" onchange="updateAdminStatusSelect(this); this.form.submit()">
                          @foreach($statusMeta as $statusValue => $meta)
                            <option value="{{ $statusValue }}" @selected($inquiry->status === $statusValue)>{{ $meta['label'] }}</option>
                          @endforeach
                        </select>
                      </span>
                    </form>
                  </td>
                  <td class="px-6 py-5 leading-7 break-words" style="color: #352b24;">
                    {{ \Illuminate\Support\Str::limit($inquiry->message, 180) }}
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="px-5 py-8 text-center" style="color: #6b5d4e;">
                    No inquiries found for the current filters.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="space-y-4 xl:hidden">
          @forelse($inquiries as $inquiry)
            <article id="inquiry-{{ $inquiry->id }}" class="admin-card rounded-[24px] p-5">
              <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div>
                  <p class="font-display text-3xl leading-none" style="color: #1f1915;">{{ $inquiry->name }}</p>
                  <p class="mt-2 text-xs uppercase tracking-[0.24em]" style="color: #8f6f45;">
                    #{{ $inquiry->id }}
                  </p>
                  <p class="mt-2 text-xs uppercase tracking-[0.18em]" style="color: #8f6f45;">
                    {{ optional($inquiry->created_at)->format('d/m/Y H:i') }}
                  </p>
                </div>
                <form method="POST" action="{{ route('admin.contact-inquiries.status', $inquiry) }}?{{ http_build_query(request()->query()) }}" class="w-full sm:w-auto">
                  @csrf
                  <span class="admin-status-select-wrap">
                    <select name="status" class="admin-status-select status-{{ $inquiry->status }}" onchange="updateAdminStatusSelect(this); this.form.submit()">
                      @foreach($statusMeta as $statusValue => $meta)
                        <option value="{{ $statusValue }}" @selected($inquiry->status === $statusValue)>{{ $meta['label'] }}</option>
                      @endforeach
                    </select>
                  </span>
                </form>
              </div>

              <div class="mt-5 grid gap-4 md:grid-cols-2">
                <div>
                  <p class="text-[11px] uppercase tracking-[0.22em]" style="color: #8f6f45;">Contact</p>
                  <p class="mt-2 font-medium text-[#1f1915]">{{ $inquiry->email }}</p>
                  <p class="mt-1 text-[#655646]">{{ $inquiry->phone ?: '-' }}</p>
                </div>
                <div>
                  <p class="text-[11px] uppercase tracking-[0.22em]" style="color: #8f6f45;">Property</p>
                  <p class="mt-2 font-medium text-[#1f1915]">{{ optional($inquiry->property)->name ?: 'Unassigned' }}</p>
                  <p class="mt-1 text-[#655646]">{{ $inquiry->inquiry_type_label }}</p>
                </div>
                <div>
                  <p class="text-[11px] uppercase tracking-[0.22em]" style="color: #8f6f45;">Stay</p>
                  <p class="mt-2 text-[#1f1915]">Arrival: {{ optional($inquiry->arrival_date)->format('d/m/Y') ?: '-' }}</p>
                  <p class="mt-1 text-[#1f1915]">Departure: {{ optional($inquiry->departure_date)->format('d/m/Y') ?: '-' }}</p>
                  <p class="mt-1 text-[#1f1915]">Guests: {{ $inquiry->guests ?: '-' }}</p>
                </div>
                <div>
                  <p class="text-[11px] uppercase tracking-[0.22em]" style="color: #8f6f45;">Message</p>
                  <p class="mt-2 leading-7 text-[#3d3229]">{{ $inquiry->message }}</p>
                </div>
              </div>
            </article>
          @empty
            <div class="admin-card rounded-[24px] px-5 py-8 text-center" style="color: #6b5d4e;">
              No inquiries found for the current filters.
            </div>
          @endforelse
        </div>

        @if($inquiries->hasPages())
          <div class="mt-8 flex justify-center">
            <div class="admin-panel rounded-[24px] px-4 py-3">
              {{ $inquiries->onEachSide(1)->links() }}
            </div>
          </div>
        @endif
      @endif
    </div>
  </section>
@endsection
