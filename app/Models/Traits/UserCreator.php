<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserCreator
{
    public function userCreator(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_creator','id');
    }
}
