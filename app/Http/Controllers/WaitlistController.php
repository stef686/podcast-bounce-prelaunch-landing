<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WaitlistController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'website' => ['max:0'],
        ]);

        $this->subscribeToKit($validated['email']);

        return back()->with('waitlist_success', true);
    }

    private function subscribeToKit(string $email): void
    {
        $apiSecret = config('services.kit.api_secret');
        $formId = config('services.kit.form_id');
        $tagId = config('services.kit.tag_id');

        if (! $apiSecret || ! $formId || ! $tagId) {
            Log::warning('Kit API config missing — waitlist signup skipped', ['email' => $email]);

            return;
        }

        try {
            $kit = Http::withHeader('X-Kit-Api-Key', $apiSecret)
                ->baseUrl('https://api.kit.com/v4');

            $response = $kit->post('/subscribers', [
                'email_address' => $email,
                'state' => 'inactive',
            ]);

            if ($response->status() === 422) {
                $subscriberId = $kit->get('/subscribers', [
                    'email_address' => $email,
                ])->throw()->json('subscribers.0.id');
            } else {
                $subscriberId = $response->throw()->json('subscriber.id');
            }

            if (! $subscriberId) {
                Log::error('Kit API: could not resolve subscriber ID', ['email' => $email]);

                return;
            }

            $kit->post("/forms/{$formId}/subscribers/{$subscriberId}")
                ->throw();

            $kit->post("/tags/{$tagId}/subscribers/{$subscriberId}")
                ->throw();
        } catch (RequestException $e) {
            Log::error('Kit API subscription failed', [
                'email' => $email,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
