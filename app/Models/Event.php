<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

   protected $fillable = [
        'client_name',
        'email',
        'date',
        'time',
        'rate',
        'heading',
        'address',
        'entry',
        'others',
    ];
}
