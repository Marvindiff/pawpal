<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'provider_id',
        'date',
        'owner_id',
        'sitter_id',
        'schedule',
        'status',
        'price',
        'provider_id',
        'is_refunded',
    'reject_reason',
    'payment_method',
    'payment_status',
    'gcash_proof',
    'payment_verified_at',
    'customer_latitude',
'customer_longitude',
        
    ];
  public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
public function provider()
{
    return $this->belongsTo(\App\Models\User::class, 'provider_id');
}
public function service()
{
    return $this->belongsTo(\App\Models\Service::class);
}
    public function sitter()
    {
        return $this->belongsTo(User::class, 'sitter_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
