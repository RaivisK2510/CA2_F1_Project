<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "favoritable_id", "favoritable_type"];

    /**
     * Get the user that owns this favorite.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the favoritable model (Driver, Team, Circuit, Season, or Race).
     */
    public function favoritable(): MorphTo
    {
        return $this->morphTo();
    }
}
