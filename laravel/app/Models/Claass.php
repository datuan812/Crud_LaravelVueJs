<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claass extends Model
{
    protected $table = 'lophocs';

    use HasFactory;
    protected $fillable = [
        'name'
    ];
}
