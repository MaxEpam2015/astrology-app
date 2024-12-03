<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Revolution\Google\Sheets\Facades\Sheets;
use Throwable;

class Payment implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @param array<int, array{email: string, user_name: string, astrologer_name: string}> $payload
     */
    public function __construct(
        private readonly array $payload
    ) {
    }

    public function handle(): void
    {
        try {
            Sheets::spreadsheet(config('google.post_spreadsheet_id'))
                ->range('A1')
                ->sheetById(config('google.post_sheet_id'))
                ->append($this->payload);
        } catch (Throwable $e) {
            Log::error('Exception occurred: ' . $e->getMessage() . ' ' . $e->getTraceAsString());
        }
    }
}
