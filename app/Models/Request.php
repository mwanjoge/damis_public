<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    /** @use HasFactory<\Database\Factories\RequestFactory> */
    use HasFactory;

    protected $fillable = [
        'account_id',
        'service_id',
        'embassy_id',
        'member_id',
        'country_id',
        'type',
        'tracking_number',
        'total_cost',
        'service_provider_id',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function requestItems()
    {
        return $this->hasMany(RequestItem::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
