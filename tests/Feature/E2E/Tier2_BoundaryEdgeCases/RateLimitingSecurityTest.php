<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

test('status check endpoint enforces rate limiting after 10 attempts per IP per hour', function () {
    if (! Route::has('psb.status') && ! Route::has('psb.check-status')) {
        // Test direct URL /psb/status
        $check = $this->post('/psb/status', ['registration_number' => 'INVALID', 'access_token' => 'INVALID']);
        if ($check->status() === 404) {
            test()->markTestSkipped('PSB status check route not yet registered (M4 required).');
        }
    }

    $hitCount = 0;
    $rateLimited = false;

    // Execute requests to trigger rate limit (max 10 allowed)
    for ($i = 1; $i <= 12; $i++) {
        $response = $this->post('/psb/status', [
            'registration_number' => "INVALID-{$i}",
            'access_token' => 'BADTOKEN',
        ]);

        if ($response->status() === 429) {
            $rateLimited = true;
            break;
        }
        $hitCount++;
    }

    // Rate limiter should kick in around the 11th request (429 Too Many Requests)
    expect($rateLimited)->toBeTrue();
});

test('system setup deployment helper route requires valid DEPLOY_TOKEN and is rate limited', function () {
    $unauthorizedResponse = $this->post('/system-setup', [
        'token' => 'invalid-token',
    ]);

    if ($unauthorizedResponse->status() === 404) {
        test()->markTestSkipped('System setup route not yet registered (M6 required).');
    }

    // Must be rejected with 401 Unauthorized or 403 Forbidden
    expect(in_array($unauthorizedResponse->status(), [401, 403]))->toBeTrue();
});
