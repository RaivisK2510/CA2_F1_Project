<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RaceResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'position_text',
        'grid_position',
        'laps_completed',
        'race_time',
        'time_gap',
        'interval',
        'points',
        'status',
        'fastest_lap',
        'fastest_lap_time',
        'average_speed',
        'notes',
        'race_id',
        'driver_id',
        'team_id',
    ];

    protected $casts = [
        'position' => 'integer',
        'grid_position' => 'integer',
        'laps_completed' => 'integer',
        'race_time' => 'datetime',
        'points' => 'integer',
        'fastest_lap' => 'boolean',
    ];

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function scopeFinished($query)
    {
        return $query->where('status', 'Finished');
    }

    public function scopeDnf($query)
    {
        return $query->where('status', 'DNF');
    }

    public function scopePodium($query)
    {
        return $query->whereIn('position', [1, 2, 3]);
    }

    public function scopePoints($query)
    {
        return $query->where('points', '>', 0);
    }

    public function getPositionDisplayAttribute(): string
    {
        if ($this->status !== 'Finished') {
            return $this->position_text;
        }

        return $this->position;
    }

    public function getPointsEarnedAttribute(): int
    {
        $points = $this->points;

        // Add fastest lap point if applicable (1 point for fastest lap in top 10)
        if ($this->fastest_lap && $this->position <= 10) {
            $points += 1;
        }

        return $points;
    }
}
