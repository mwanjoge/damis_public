<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestItem extends Model
{
    /** @use HasFactory<\Database\Factories\RequestItemFactory> */
    use HasFactory;

    protected $fillable = ['request_id', 'service_id', 'service_provider_id', 'certificate_holder_name', 'certificate_index_number', 'account_id', 'attachment'];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
