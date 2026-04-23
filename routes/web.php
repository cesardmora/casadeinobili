<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PropertyController;
use App\Models\ContactInquiry;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
