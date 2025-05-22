<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserEvents extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
    ];
}
