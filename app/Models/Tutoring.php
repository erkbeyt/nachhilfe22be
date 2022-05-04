<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tutoring extends Model
{
    use HasFactory;

    protected $fillable = ['subject','description'];

    //M:n
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function tutoringdates(): HasMany
    {
        return $this->hasMany(TutoringDate::class);
    }

    public function tutoringcomments(): HasMany
    {
        return $this->hasMany(TutoringComment::class);
    }
}
