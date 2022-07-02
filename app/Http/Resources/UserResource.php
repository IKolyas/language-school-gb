<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class UserResource extends JsonResource
{

    #[ArrayShape([
        'id' => 'integer',
        'name' => "string",
        'lastname' => "string",
        'email' => "string",
        'tasks' => "mixed",
        'dictionaries' => 'array',
        'groups' => 'array',
    ])]
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'tasks' => $this->tasks,
            'dictionaries' => DictionaryResource::collection($this->dictionaries),
            'groups' => GroupResource::collection($this->groups),
        ];
    }
}
