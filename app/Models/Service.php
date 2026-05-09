<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'provider_id',
        'title',
        'description',
        'price'
    ];

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
}