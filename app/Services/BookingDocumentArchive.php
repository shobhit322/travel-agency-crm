<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

/**
 * Builds the "download all documents" zip for a booking.
 *
 * Files are copied from the private disk through streams, so it works the same whether that disk is
 * the local filesystem or an S3-compatible bucket (OBJECT_STORAGE=s3, see config/filesystems.php).
 * Disk::path() only exists on local disks, so it must not be used here.
 */
class BookingDocumentArchive
{
    /**
     * Writes the zip to a temporary file and returns its path, or null when the booking has no
     * readable documents. The caller owns the file and must delete it after sending it.
     */
    public function build(Booking $booking): ?string
    {
        $disk = Storage::disk('local');
        $zipPath = tempnam(sys_get_temp_dir(), 'booking-docs');
        $zip = new ZipArchive;
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // ZipArchive reads added files when close() runs, so the temporary copies live until then.
        $temporaryFiles = [];

        foreach ($booking->documents()->with('traveler')->orderBy('id')->get() as $index => $document) {
            $stream = $disk->exists($document->file_path) ? $disk->readStream($document->file_path) : null;

            if (! is_resource($stream)) {
                continue;
            }

            $copyPath = tempnam(sys_get_temp_dir(), 'booking-doc');
            $copy = fopen($copyPath, 'wb');
            stream_copy_to_stream($stream, $copy);
            fclose($copy);
            fclose($stream);

            $temporaryFiles[] = $copyPath;
            $folder = $document->traveler?->name ?? 'Booking';
            $zip->addFile($copyPath, sprintf('%s/%s-%d-%s', $folder, $document->doc_type, $index + 1, basename($document->file_path)));
        }

        $closed = $temporaryFiles !== [] && $zip->close();

        foreach ($temporaryFiles as $copyPath) {
            @unlink($copyPath);
        }

        if (! $closed) {
            @unlink($zipPath);

            return null;
        }

        return $zipPath;
    }
}
