<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WaitlistControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_waitlist_signup_subscribes_to_kit(): void
    {
        Http::fake([
            'api.kit.com/*' => Http::response(['subscriber' => ['id' => 1]], 200),
        ]);

        config([
            'services.kit.api_secret' => 'test-api-secret',
            'services.kit.form_id' => '99999',
            'services.kit.tag_id' => '12345',
        ]);

        $response = $this->post(route('waitlist.store'), [
            'email' => 'test@example.com',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('waitlist_success', true);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://api.kit.com/v4/subscribers'
                && $request['email_address'] === 'test@example.com'
                && $request->hasHeader('X-Kit-Api-Key', 'test-api-secret');
        });

        Http::assertSent(function ($request) {
            return $request->url() === 'https://api.kit.com/v4/forms/99999/subscribers/1'
                && $request->hasHeader('X-Kit-Api-Key', 'test-api-secret');
        });

        Http::assertSent(function ($request) {
            return $request->url() === 'https://api.kit.com/v4/tags/12345/subscribers/1'
                && $request->hasHeader('X-Kit-Api-Key', 'test-api-secret');
        });
    }

    public function test_waitlist_signup_succeeds_when_kit_config_missing(): void
    {
        config([
            'services.kit.api_secret' => null,
            'services.kit.form_id' => null,
            'services.kit.tag_id' => null,
        ]);

        $response = $this->post(route('waitlist.store'), [
            'email' => 'test@example.com',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('waitlist_success', true);
    }

    public function test_waitlist_signup_succeeds_when_kit_api_fails(): void
    {
        Http::fake([
            'api.kit.com/*' => Http::response(['error' => 'Unauthorized'], 401),
        ]);

        config([
            'services.kit.api_secret' => 'bad-key',
            'services.kit.form_id' => '99999',
            'services.kit.tag_id' => '12345',
        ]);

        $response = $this->post(route('waitlist.store'), [
            'email' => 'test@example.com',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('waitlist_success', true);
    }

    public function test_waitlist_signup_requires_valid_email(): void
    {
        $response = $this->post(route('waitlist.store'), [
            'email' => 'not-an-email',
        ]);

        $response->assertSessionHasErrors('email');
    }
}
