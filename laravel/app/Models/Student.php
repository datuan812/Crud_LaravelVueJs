<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'sinhviens';

    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'lophoc_id',
        'khoahoc_id'
    ];
}
