<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'booking_id',
        'reporter_id',
        'user_id',   
        'reported_id',
        'reason',
        'description',
        'status',
        'severity',
        'admin_note'
    ];

    // ✅ REPORTER (the one who reported)
    public function reporter()
    {
        return $this->belongsTo(User::class, 'user_id'); // ✅ FIXED
    }

    // ✅ REPORTED USER (sitter/provider)
    public function reported()
    {
        return $this->belongsTo(User::class, 'reported_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}