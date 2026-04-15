<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactInquiry;
use App\Mail\ContactNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Store a new contact inquiry from the landing page form.
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        // Save to database
        $inquiry = ContactInquiry::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'phone'           => $request->phone,
            'property_id'     => $request->property_id,
            'arrival_date'    => $request->arrival_date,
            'departure_date'  => $request->departure_date,
            'guests'          => $request->guests,
            'message'         => $request->message,
            'inquiry_type'    => $request->inquiry_type ?? 'rental',
            'ip_address'      => $request->ip(),
        ]);

        // Send admin notification email
        try {
            Mail::to(config('mail.admin_email', env('ADMIN_EMAIL')))
                ->send(new ContactNotification($inquiry));
        } catch (\Exception $e) {
            // Log but don't fail the user request
            logger()->error('Contact mail failed: ' . $e->getMessage());
        }

        return redirect()
            ->route('contact.thanks')
            ->with('success', 'Hemos recibido su consulta. Le contactaremos en menos de 48 horas.');
    }

    /**
     * Show the thank-you page after form submission.
     */
    public function thanks(): View
    {
        return view('pages.contact-thanks');
    }
}
