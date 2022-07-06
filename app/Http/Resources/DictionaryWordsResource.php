<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class DictionaryWordsResource extends JsonResource
{

    #[ArrayShape(['id' => 'int', 'dictionary_name' => "string", 'creator' => "string", 'creator_id' => "int", 'created_at' => 'string', 'words' => 'array'])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'creator_id' => $this->creator->id,
            'dictionary_name' => $this->dictionary_name,
            'creator' => $this->creator->name,
            'created_at' => $this->created_at,
//            'words' => WordResource::collection($this->words),
        ];
    }

}
