<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class DictionaryWordsResource extends JsonResource
{

    #[ArrayShape([
        'id' => 'int',
        'dictionary_name' => "string",
        'creator' => "string",
        'creator_id' => 'integer',
        'created_at' => 'string',
        'words' => 'array',
    ])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'dictionary_name' => $this->dictionary_name,
            'creator' => $this->creator->name,
            'creator_id' => $this->creator->id,
            'created_at' => $this->created_at,
            'words' => WordResource::collection($this->words),
        ];
    }

}
