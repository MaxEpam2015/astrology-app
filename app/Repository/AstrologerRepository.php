<?php

namespace App\Repository;

use App\Models\Astrologer;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Collection;

class AstrologerRepository
{
    private string $servicesShowColumns = 'name,price';
    public const PER_PAGE = 3;
    /**
     * @var array|string[]
     */
    private array $hiddenAstrologersColumns = ['biography', 'email', 'uuid'];
    private string $servicesIndexColumns = 'name';

    /**
     * @return CursorPaginator
     */
    public function index(): CursorPaginator
    {
        /**
//         * @var Collection $astrologers
         */
        $astrologers = Astrologer::query()->with(['services:' . $this->servicesIndexColumns])
            ->cursorPaginate(self::PER_PAGE);
        $astrologers->setCollection($astrologers->getCollection()
            ->makeHidden($this->hiddenAstrologersColumns));

        return $astrologers;
    }

    public function show(string $uuid): Astrologer
    {
        $astrologer = Astrologer::where('uuid', $uuid)->with(['services:' . $this->servicesShowColumns])
            ->firstOrFail();
        unset($astrologer->uuid);

        return $astrologer;
    }
}
