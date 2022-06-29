<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class WordResource extends JsonResource
{
    #[ArrayShape(['id' => 'int', 'word' => "string", 'translation' => "string"])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'word' => $this->word,
            'translation' => $this->translation,
        ];
    }
}
