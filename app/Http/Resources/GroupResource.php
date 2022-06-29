<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class GroupResource extends JsonResource
{

    #[ArrayShape([
        "id" => "integer",
        "teacher" => "string",
        "description" => "string",
        "academic_degree" => "string",
        "school" => "string",
    ])]
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "teacher" => $this->teacher->user->name,
            "description" => $this->description,
            "academic_degree" => $this->teacher->academic_degree,
            "school" => $this->teacher->school->name,
        ];
    }
}
