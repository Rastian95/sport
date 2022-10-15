<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'events_details';

    protected $fillable = [
        'event_id',
        'player_id',
        'name',
        'rating',
        'active',
    ];
}
