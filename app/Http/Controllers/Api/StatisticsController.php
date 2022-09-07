<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\StatisticsPutRequest;
use App\Http\Resources\StatisticsResource;
use App\Models\Statistics;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
    public function getStatistics(int $user_id): StatisticsResource
    {
        return new StatisticsResource(Statistics::firstOrCreate(['user_id' => $user_id]));
    }

    public function saveStatistics(StatisticsPutRequest $request, int $user_id)
    {
        $validated = $request->validated();
        $statistics = Statistics::updateOrCreate(
            ['user_id' => $user_id],
            $validated
        );
        if (!$statistics) return response()->json(['status' => 'error', 'message' => "saveStatistics"]);
        return response()->json(['status' => 'success', 'statistics' => $statistics->id]);
    }
}
