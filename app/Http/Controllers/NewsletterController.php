<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class NewsletterController extends Controller
{
    /**
     * Subscribe an email address to the newsletter.
     * Accepts both AJAX (JSON) and standard form submission.
     */
    public function store(NewsletterRequest $request): JsonResponse|RedirectResponse
    {
        $subscriber = NewsletterSubscriber::firstOrCreate(
            ['email' => $request->email],
            ['subscribed_at' => now(), 'is_active' => true]
        );

        // If already existed and was unsubscribed, reactivate
        if (! $subscriber->wasRecentlyCreated && ! $subscriber->is_active) {
            $subscriber->update(['is_active' => true, 'subscribed_at' => now()]);
        }

        $message = 'Gracias por suscribirse. Pronto recibirá nuestras crónicas desde Korčula.';

        if ($request->expectsJson()) {
            return response()->json(['message' => $message]);
        }

        return back()->with('newsletter_success', $message);
    }
}
