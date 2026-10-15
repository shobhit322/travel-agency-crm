<?php

namespace App\Services;

use App\Models\SaasLead;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

/**
 * Turns a public "Request a demo" form submission into a SaaS lead (Super Admin → SaaS Leads).
 * It never creates a demo or manager account — a person follows up and sets those up by hand.
 *
 * Leads are unique by email, so a repeat request adds a dated entry to the existing lead's notes
 * instead of failing or overwriting anything, and the visitor is never told whether the email was
 * already known.
 */
class DemoRequests
{
    public const SOURCE = 'Website demo request';

    /** Seconds a person needs to fill the form in; faster submissions are treated as bots. */
    public const MIN_FILL_SECONDS = 3;

    /** Seconds after which a rendered form is considered stale. */
    public const MAX_FORM_AGE_SECONDS = 7200;

    private const MAX_NOTES_LENGTH = 6000;

    /** @var array<string, string> */
    public const TEAM_SIZES = [
        '1-5' => '1–5 people',
        '6-20' => '6–20 people',
        '21-50' => '21–50 people',
        '51+' => 'More than 50 people',
    ];

    /**
     * @param  array{name: string, email: string, company: string, phone?: ?string, team_size?: ?string, message?: ?string}  $data
     */
    public function record(array $data): SaasLead
    {
        $email = Str::lower($data['email']);
        $entry = $this->entry($data);

        $lead = $this->find($email);

        if ($lead === null) {
            try {
                return SaasLead::query()->create([
                    'name' => $data['name'],
                    'email' => $email,
                    'company' => $data['company'],
                    'status' => 'new',
                    'source' => self::SOURCE,
                    'notes' => $entry,
                ]);
            } catch (UniqueConstraintViolationException) {
                // Two requests for the same email raced each other; treat the second as a repeat.
                $lead = $this->find($email);
            }
        }

        if ($lead !== null && Str::length((string) $lead->notes) < self::MAX_NOTES_LENGTH) {
            $lead->update(['notes' => trim(($lead->notes ?? '')."\n\n".$entry)]);
        }

        return $lead ?? new SaasLead;
    }

    /**
     * A tamper-proof timestamp rendered into the form, used to reject instant (bot) submissions
     * and stale pages without needing a session.
     */
    public function issueToken(): string
    {
        return Crypt::encryptString((string) now()->getTimestamp());
    }

    public function tokenIsAcceptable(?string $token): bool
    {
        if (blank($token)) {
            return false;
        }

        try {
            $issuedAt = (int) Crypt::decryptString($token);
        } catch (DecryptException) {
            return false;
        }

        $age = now()->getTimestamp() - $issuedAt;

        return $age >= self::MIN_FILL_SECONDS && $age <= self::MAX_FORM_AGE_SECONDS;
    }

    private function find(string $email): ?SaasLead
    {
        return SaasLead::query()->whereRaw('lower(email) = ?', [$email])->first();
    }

    /**
     * @param  array{name: string, email: string, company: string, phone?: ?string, team_size?: ?string, message?: ?string}  $data
     */
    private function entry(array $data): string
    {
        $lines = array_filter([
            'Phone: '.($data['phone'] ?? ''),
            'Team size: '.(self::TEAM_SIZES[$data['team_size'] ?? ''] ?? ''),
            'Message: '.($data['message'] ?? ''),
        ], fn (string $line): bool => ! str_ends_with($line, ': '));

        return implode("\n", ['Demo request — '.now()->utc()->format('Y-m-d H:i').' UTC', ...$lines]);
    }
}
