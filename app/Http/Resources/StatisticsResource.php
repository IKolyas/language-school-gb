<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatisticsResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'user_id' => $this->user_id,
            'training_days' => $this->training_days,
            'training_days_strike' => $this->training_days_strike,
            'max_training_days_strike' => $this->max_training_days_strike,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }

}
