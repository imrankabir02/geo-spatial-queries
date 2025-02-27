<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    /** @use HasFactory<\Database\Factories\CrudFactory> */
    use HasFactory;

    protected $table = 'cruds';

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity'
    ];
}
