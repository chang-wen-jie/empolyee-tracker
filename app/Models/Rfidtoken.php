<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfidtoken extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'aa_status',
        'name',
    ];
}
