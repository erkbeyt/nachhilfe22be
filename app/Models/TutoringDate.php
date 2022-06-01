<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TutoringDate extends Model
{
    use HasFactory;

    protected $fillable = ['tutoringdate', 'booked', 'accepted', 'status', 'user_id'];

    public function tutoring() : BelongsTo
    {
        return $this->belongsTo(Tutoring::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
