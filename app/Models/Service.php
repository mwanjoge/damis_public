<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function requestItems()
    {
        return $this->hasMany(\App\Models\RequestItem::class);
    }
}
