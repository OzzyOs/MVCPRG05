<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function rating(): BelongsTo
    {
        return $this->hasMany(Rating::class);
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
