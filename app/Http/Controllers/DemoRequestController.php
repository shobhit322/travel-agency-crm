<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

/**
 * Handles "Request a Demo" form submissions from the login page.
 * Validates the input, rate-limits by IP, and logs the request so a
 * Super Admin can provision demo access manually — no automatic account
 * creation occurs here.
 */
class DemoRequestController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $key = 'demo-request:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return response()->json([
                'success' => false,
                'message' => 'Too many requests. Please try again later.',
            ], 429);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:1000'],
        ]);

        RateLimiter::hit($key, 3600);

        Log::channel('stack')->info('Demo access requested', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company' => $validated['company'] ?? null,
            'message' => $validated['message'] ?? null,
            'ip' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your demo request has been received. Our team will contact you shortly.',
        ]);
    }
}
