<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Club;
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getClubNameFromID(Request $request): JsonResponse
    {
        $club_id = $request->input('club_id');
        $club = Club::query()->find($club_id);

        if (is_null($club)) return response()->json([
            'success' => false,
            'errors' => ['Invalid Club ID.'],
        ]);

        return response()->json([
            'success' => true,
            'data' => $club->name,
        ]);
    }
}
