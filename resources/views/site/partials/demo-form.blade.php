@php
    $teamSizes = \App\Services\DemoRequests::TEAM_SIZES;
    $formToken = app(\App\Services\DemoRequests::class)->issueToken();
@endphp
<form class="demo-form" method="POST" action="{{ route('demo.store') }}" novalidate data-demo-form>
    @csrf
    <input type="hidden" name="form_token" value="{{ $formToken }}">

    {{-- Honeypot: invisible to people, tempting to bots. --}}
    <div class="hp" aria-hidden="true">
        <label for="contact_website">Leave this field empty</label>
        <input type="text" id="contact_website" name="contact_website" value="" tabindex="-1" autocomplete="off">
    </div>

    @if ($errors->any())
        <div class="form-alert" role="alert" id="demo-errors">
            <strong>Please check the form</strong>
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-grid">
        <div class="field">
            <label for="demo-name">Your name <span aria-hidden="true">*</span></label>
            <input id="demo-name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required maxlength="120" @error('name') aria-invalid="true" @enderror>
        </div>
        <div class="field">
            <label for="demo-email">Work email <span aria-hidden="true">*</span></label>
            <input id="demo-email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required maxlength="190" @error('email') aria-invalid="true" @enderror>
        </div>
        <div class="field">
            <label for="demo-company">Agency / company <span aria-hidden="true">*</span></label>
            <input id="demo-company" name="company" type="text" value="{{ old('company') }}" autocomplete="organization" required maxlength="150" @error('company') aria-invalid="true" @enderror>
        </div>
        <div class="field">
            <label for="demo-phone">Phone <small>(optional)</small></label>
            <input id="demo-phone" name="phone" type="tel" value="{{ old('phone') }}" autocomplete="tel" maxlength="30" @error('phone') aria-invalid="true" @enderror>
        </div>
        <div class="field field--full">
            <label for="demo-team">Team size <small>(optional)</small></label>
            <select id="demo-team" name="team_size">
                <option value="">Select…</option>
                @foreach ($teamSizes as $value => $label)
                    <option value="{{ $value }}" @selected(old('team_size') === (string) $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="field field--full">
            <label for="demo-message">What would you like to see? <small>(optional)</small></label>
            <textarea id="demo-message" name="message" rows="4" maxlength="1000" placeholder="Bookings, invoicing, a customer portal… tell us what matters most.">{{ old('message') }}</textarea>
        </div>
    </div>

    <label class="consent">
        <input type="checkbox" name="consent" value="1" @checked(old('consent')) required>
        <span>I agree that {{ config('branding.company') }} may contact me about this demo request.</span>
    </label>

    <button class="btn btn--primary btn--lg" type="submit" data-submit>
        <span>Request my demo</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/></svg>
    </button>
    <p class="form-note">We reply personally and set up demo access by hand. No account is created automatically.</p>
</form>
