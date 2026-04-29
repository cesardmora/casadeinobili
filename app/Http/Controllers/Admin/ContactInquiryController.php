<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ContactInquiryController extends Controller
{
    private const SESSION_KEY = 'contact_inquiries_access_granted';

    public function index(Request $request): View|Response|RedirectResponse
    {
        $secretKey = (string) config('app.admin_key', env('CONTACT_INQUIRIES_KEY', 'Nobili2026Secure!'));

        if ($request->query('key') && hash_equals($secretKey, (string) $request->query('key'))) {
            $request->session()->put(self::SESSION_KEY, true);

            return redirect()->route('admin.contact-inquiries');
        }

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'access_key' => ['required', 'string'],
            ]);

            if (hash_equals($secretKey, $validated['access_key'])) {
                $request->session()->put(self::SESSION_KEY, true);

                return redirect()->route('admin.contact-inquiries');
            }

            return back()
                ->withInput()
                ->withErrors(['access_key' => 'Clave incorrecta.']);
        }

        if (! $this->isAuthorized($request)) {
            return $this->adminResponse('pages.contact-inquiries', [
                'authorized' => false,
            ], 403);
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

        if (! in_array($sort['column'], ['created_at', 'name', 'status'], true)) {
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

        return $this->adminResponse('pages.contact-inquiries', [
            'authorized' => true,
            'inquiries' => $inquiries,
            'stats' => $stats,
            'filters' => $filters,
            'properties' => $properties,
            'sort' => $sort,
        ]);
    }

    public function updateStatus(Request $request, ContactInquiry $contactInquiry): RedirectResponse
    {
        if (! $this->isAuthorized($request)) {
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
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget(self::SESSION_KEY);

        return redirect()->route('admin.contact-inquiries');
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
