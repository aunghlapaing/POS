<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'protected_id',
        'action'
    ];
}
