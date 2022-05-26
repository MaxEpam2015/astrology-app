<?php

namespace App\Http\Controllers;

use App\Action\{AstrologerIndex, AstrologerShow};
use Illuminate\Http\JsonResponse;

class AstrologerController extends Controller
{
    public function index(AstrologerIndex $astrologerIndex): JsonResponse
    {
        $astrologers = $astrologerIndex->perform();

        return new JsonResponse($astrologers);
    }

    public function show(string $uuid, AstrologerShow $astrologerShow): JsonResponse
    {
        $astrologer = $astrologerShow->perform($uuid);

        return new JsonResponse($astrologer);
    }
}
