<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Championship extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'position',
        'points',
        'wins',
        'podiums',
        'pole_positions',
        'fastest_laps',
        'races_participated',
        'races_completed',
        'notes',
        'season_id',
        'championable_type',
        'championable_id',
    ];

    protected $casts = [
        'position' => 'integer',
        'points' => 'integer',
        'wins' => 'integer',
        'podiums' => 'integer',
        'pole_positions' => 'integer',
        'fastest_laps' => 'integer',
        'races_participated' => 'integer',
        'races_completed' => 'integer',
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function championable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeDrivers($query)
    {
        return $query->where('type', 'drivers');
    }

    public function scopeConstructors($query)
    {
        return $query->where('type', 'constructors');
    }

    public function scopeBySeason($query, int $seasonYear)
    {
        return $query->whereHas('season', function ($q) use ($seasonYear) {
            $q->where('year', $seasonYear);
        });
    }

    public function scopePodium($query)
    {
        return $query->whereIn('position', [1, 2, 3]);
    }

    public function scopeWinner($query)
    {
        return $query->where('position', 1);
    }

    public function getCompletionRateAttribute(): float
    {
        if ($this->races_participated === 0) {
            return 0;
        }

        return round(($this->races_completed / $this->races_participated) * 100, 2);
    }

    public function getChampionNameAttribute(): string
    {
        return $this->championable->name ?? 'Unknown';
    }

    public function isChampion(): bool
    {
        return $this->position === 1;
    }
}
