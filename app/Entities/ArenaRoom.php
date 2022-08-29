<?php

namespace App\Entities;

use App\Models\User;

class ArenaRoom
{
    public string $id;
    public User $owner;
    public User $invite;


    public function __construct(User $owner, User $invite)
    {
        $this->owner = $owner;
        $this->invite = $invite;
        $this->id = $owner->id . "_" . $invite->id;
    }
}
