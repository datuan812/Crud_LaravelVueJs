<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'khoahocs';

    use HasFactory;
    protected $fillable = [
        'name',

    ];
}
