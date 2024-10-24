<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function card(): BelongsTo
    {
    return $this->belongsTo(Card::class);
    }
}
