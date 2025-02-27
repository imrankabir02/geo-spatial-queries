<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Geofence extends Model
{
    protected $fillable = [
        'name',
        'description',
        'boundary',
    ];

    protected $SpatialFields = [
        'boundary'
    ];
}
