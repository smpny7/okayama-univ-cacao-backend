<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getClubName(Request $request): JsonResponse
    {
        $club_name = $request->user()->name;
        return response()->json([
            'success' => true,
            'data' => $club_name,
        ]);
    }
}
