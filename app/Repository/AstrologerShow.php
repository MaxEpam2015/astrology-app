<?php

namespace App\Repository;

use App\Models\Astrologer;

class AstrologerShow
{
    private string $servicesShowColumns = 'name,price';

    public function perform(string $uuid): Astrologer
    {
        $astrologer = Astrologer::where('uuid', $uuid)->with(['services:' . $this->servicesShowColumns])
            ->firstOrFail();
        unset($astrologer->uuid);

        return $astrologer;
    }
}
