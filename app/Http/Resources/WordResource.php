<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class WordResource extends JsonResource
{
    #[ArrayShape(['id' => 'int', 'word' => "string", 'translation' => "string", 'rating' => 'int'])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'word' => $this->word,
            'translation' => $this->translation,
            'rating' => $this->rating
        ];
    }
}
