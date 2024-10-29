<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Card extends Model
{
    protected $fillable =['name','description', 'type_id'];

    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class);
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
