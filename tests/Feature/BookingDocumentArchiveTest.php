<?php

use App\Models\Booking;
use App\Models\BookingDocument;
use App\Models\Customer;
use App\Models\Tenant;
use App\Services\BookingDocumentArchive;
use App\Support\TenantContext;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

function archiveBooking(): Booking
{
    app(TenantContext::class)->set(Tenant::query()->create(['name' => 'Archive Agency', 'slug' => 'archive-agency']));

    return Booking::query()->create([
        'customer_id' => Customer::factory()->create()->id,
        'trip_name' => 'Archive trip',
    ]);
}

test('the document archive zips booking and traveller files and skips unreadable ones', function () {
    Storage::fake('local');
    $booking = archiveBooking();
    $traveler = $booking->travelers()->create(['name' => 'Asha Rao', 'document_status' => 'pending']);

    Storage::disk('local')->put('booking-documents/private/passport.pdf', 'passport-bytes');
    Storage::disk('local')->put('booking-documents/private/visa.pdf', 'visa-bytes');

    foreach ([['passport', 'passport.pdf', $traveler->id], ['visa', 'visa.pdf', null], ['insurance', 'missing.pdf', null]] as [$type, $file, $travelerId]) {
        BookingDocument::query()->create([
            'booking_id' => $booking->id,
            'booking_traveler_id' => $travelerId,
            'doc_type' => $type,
            'file_path' => 'booking-documents/private/'.$file,
            'status' => 'pending',
            'uploaded_by' => 'agent@example.com',
        ]);
    }

    $zipPath = app(BookingDocumentArchive::class)->build($booking);

    expect($zipPath)->not->toBeNull();

    $zip = new ZipArchive;
    $zip->open($zipPath);

    expect($zip->numFiles)->toBe(2)
        ->and($zip->getFromName('Asha Rao/passport-1-passport.pdf'))->toBe('passport-bytes')
        ->and($zip->getFromName('Booking/visa-2-visa.pdf'))->toBe('visa-bytes');

    $zip->close();
    unlink($zipPath);
});

test('the document archive returns null when no document file can be read', function () {
    Storage::fake('local');
    $booking = archiveBooking();

    BookingDocument::query()->create([
        'booking_id' => $booking->id,
        'doc_type' => 'passport',
        'file_path' => 'booking-documents/private/gone.pdf',
        'status' => 'pending',
        'uploaded_by' => 'agent@example.com',
    ]);

    expect(app(BookingDocumentArchive::class)->build($booking))->toBeNull();
});
