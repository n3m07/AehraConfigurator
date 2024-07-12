<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaintSpecialistAppointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullName',
        'email',
        'phoneNumber',
    ];
}
