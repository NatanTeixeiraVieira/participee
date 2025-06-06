<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected $fillable = [
        'name',
        'description',
        'state',
        'city',
        'neighborhood',
        'street',
        'zipcode',
        'number',
        'complement',
        'date',
        'created_by'
    ];

    public function participants() {
        return $this->belongsToMany(User::class, 'event_user')->withTimestamps();
    }
}
