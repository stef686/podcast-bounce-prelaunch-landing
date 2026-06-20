<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WaitlistController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
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
            return;
        }

        try {
            $kit = Http::withHeader('X-Kit-Api-Key', $apiSecret)
                ->baseUrl('https://api.kit.com/v4');

            $subscriberId = $kit->post('/subscribers', [
                'email_address' => $email,
                'state' => 'inactive',
            ])->throw()->json('subscriber.id');

            $kit->post("/forms/{$formId}/subscribers/{$subscriberId}")
                ->throw();

            $kit->post("/tags/{$tagId}/subscribers/{$subscriberId}")
                ->throw();
        } catch (\Exception $e) {
            Log::error('Kit API subscription failed', [
                'email' => $email,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
