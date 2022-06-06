<?php

namespace App\Repository;

use App\Models\Astrologer;
use Illuminate\Contracts\Pagination\CursorPaginator;

class AstrologerIndex
{
    const PER_PAGE = 3;
    private array $hiddenAstrologersColumns = ['biography', 'email', 'uuid'];
    private string $servicesIndexColumns = 'name';

    public function perform(): CursorPaginator
    {
        $astrologers = Astrologer::query()->with(['services:' . $this->servicesIndexColumns])
            ->cursorPaginate(self::PER_PAGE);
        $astrologers->setCollection($astrologers->getCollection()
            ->makeHidden($this->hiddenAstrologersColumns));

        return $astrologers;
    }
}
