<?php

namespace App\Http\Controllers;

use App\Services\DemoRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * The public "Request a demo" form (homepage section and /request-demo, linked from the Super
 * Admin sign-in screen). Unauthenticated, so it is throttled per IP (see the demo-request limiter),
 * CSRF-protected, validated, guarded by a honeypot and a minimum-fill-time token, and it only
 * records a lead — no accounts are created.
 */
class DemoRequestController extends Controller
{
    public function create(): View
    {
        return view('site.demo');
    }

    public function store(Request $request, DemoRequests $demoRequests): RedirectResponse
    {
        // Real visitors never see or fill the hidden field; bots do. Answer exactly like a success.
        if (filled($request->input('contact_website'))) {
            return redirect()->route('demo.thanks');
        }

        $request->merge(collect($request->only(['name', 'email', 'company', 'phone', 'team_size', 'message']))
            ->map(fn (mixed $value): mixed => is_string($value) ? trim((string) preg_replace('/[^\P{Cc}\n]+/u', '', $value)) : $value)
            ->all());

        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'min:2', 'max:120'],
                'email' => ['required', 'email:rfc', 'max:190'],
                'company' => ['required', 'string', 'min:2', 'max:150'],
                'phone' => ['nullable', 'string', 'max:30', 'regex:/^[0-9+()\-.\s]{6,30}$/'],
                'team_size' => ['nullable', 'string', Rule::in(array_keys(DemoRequests::TEAM_SIZES))],
                'message' => ['nullable', 'string', 'max:1000'],
                'consent' => ['accepted'],
            ], [
                'consent.accepted' => 'Please confirm that we may contact you about your demo.',
                'phone.regex' => 'Please enter a valid phone number, for example +1 555 123 4567.',
            ]);
        } catch (ValidationException $exception) {
            // The homepage form and the login-screen link both post here; errors are shown on the full form page.
            throw $exception->redirectTo(route('demo.create'));
        }

        if (! $demoRequests->tokenIsAcceptable($request->input('form_token'))) {
            return redirect()->route('demo.create')
                ->withInput($request->except('form_token'))
                ->withErrors(['form_token' => 'That took a little too long or was too quick. Please check your details and send the request again.']);
        }

        $demoRequests->record($data);

        return redirect()->route('demo.thanks');
    }

    public function thanks(): View
    {
        return view('site.demo-thanks');
    }
}
