<?php

namespace App\Http\Controllers;

use App\Models\Astrologer;
use Illuminate\Http\JsonResponse;

class AstrologerController extends Controller
{
    const PER_PAGE = 3;
    private array $hiddenAstrologersColumns = ['biography', 'email', 'uuid'];
    private array $shownAstrologersColumns = ['name', 'biography', 'photo', 'uuid'];

    private string $servicesIndexColumns = 'name';
    private string $servicesShowColumns = 'name,price';

    public function index(): JsonResponse
    {
        $astrologers = Astrologer::query()->with(['services:' . $this->servicesIndexColumns])
            ->cursorPaginate(self::PER_PAGE);
        $astrologers->setCollection($astrologers->getCollection()
            ->makeHidden($this->hiddenAstrologersColumns));

        return new JsonResponse($astrologers);
    }


    public function show(Astrologer $astrologer): JsonResponse
    {
        $astrologer = $astrologer->with(['services:' . $this->servicesShowColumns])
            ->first($this->shownAstrologersColumns);
        unset($astrologer->uuid);

        return new JsonResponse($astrologer);
    }


}
