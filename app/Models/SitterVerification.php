<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitterVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'verified_at',
        // add other columns you want here
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}