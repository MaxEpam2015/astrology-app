<?php

namespace App\Http\Controllers;

use App\Models\Astrologer;
use Illuminate\Http\JsonResponse;

class AstrologerController extends Controller
{
    public function __construct(protected Astrologer $astrologer)
    {
    }

    public function index(): JsonResponse
    {
        $astrologers = $this->astrologer->list();

        return new JsonResponse($astrologers);
    }

    public function show(string $uuid): JsonResponse
    {
        $astrologer = $this->astrologer->show($uuid);

        return new JsonResponse($astrologer);
    }
}
