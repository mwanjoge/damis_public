<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embassy extends Model
{
    /** @use HasFactory<\Database\Factories\EmbassyFactory> */
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'type',
        'is_active',
        'synced',
    ];
}
