<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'model',
        'interiorColor',
        'interiorMaterial',
        'exteriorColor',
        'rims',
        'brakes',
    ];

    protected $casts = [
        'interiorColor' => 'array',
        'interiorMaterial' => 'array',
        'exteriorColor' => 'array',
        'rims' => 'array',
        'brakes' => 'array',
    ];
}
