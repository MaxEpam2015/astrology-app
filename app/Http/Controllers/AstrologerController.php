<?php

namespace App\Http\Controllers;

use App\Repository\{AstrologerRepository, AstrologerShow};
use Illuminate\Http\JsonResponse;

class AstrologerController extends Controller
{
    public function __construct(protected AstrologerRepository $astrologerRepository)
    {
    }

    public function index(): JsonResponse
    {
        $astrologers = $this->astrologerRepository->index();

        return new JsonResponse($astrologers);
    }

    public function show(string $uuid): JsonResponse
    {
        $astrologer = $this->astrologerRepository->show($uuid);

        return new JsonResponse($astrologer);
    }
}
