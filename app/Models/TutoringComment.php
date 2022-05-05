<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TutoringComment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'tutoring_id', 'user_id'];

    public function tutoring() : BelongsTo
    {
        return $this->belongsTo(Tutoring::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
