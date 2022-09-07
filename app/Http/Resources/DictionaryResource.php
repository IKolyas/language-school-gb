<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class DictionaryResource extends JsonResource
{

    #[ArrayShape(['id' => 'int', 'dictionary_name' => "string", 'creator' => "string", 'created_at' => 'string'])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'dictionary_name' => $this->dictionary_name,
            'creator' => $this->creator->name,
            'created_at' => $this->created_at,
        ];
    }

}
