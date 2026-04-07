<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Race extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'full_name',
        'official_name',
        'round_number',
        'race_date',
        'race_time',
        'laps',
        'race_distance_km',
        'fastest_lap_time',
        'fastest_lap_driver_id',
        'pole_position_time',
        'pole_position_driver_id',
        'weather_conditions',
        'race_report',
        'race_image',
        'is_completed',
        'is_cancelled',
        'is_active',
        'season_id',
        'circuit_id',
    ];

    protected $casts = [
        'round_number' => 'integer',
        'race_date' => 'date',
        'race_time' => 'datetime',
        'laps' => 'integer',
        'race_distance_km' => 'decimal:3',
        'is_completed' => 'boolean',
        'is_cancelled' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function circuit(): BelongsTo
    {
        return $this->belongsTo(Circuit::class);
    }

    public function raceResults(): HasMany
    {
        return $this->hasMany(RaceResult::class);
    }

    public function fastestLapDriver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'fastest_lap_driver_id');
    }

    public function polePositionDriver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'pole_position_driver_id');
    }

    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('is_completed', false)->where('race_date', '>', now());
    }

    public function scopeBySeason($query, int $seasonYear)
    {
        return $query->whereHas('season', function ($q) use ($seasonYear) {
            $q->where('year', $seasonYear);
        });
    }

    public function getStatusAttribute(): string
    {
        if ($this->is_cancelled) {
            return 'Cancelled';
        }

        if ($this->is_completed) {
            return 'Completed';
        }

        if ($this->race_date < now()) {
            return 'In Progress';
        }

        return 'Upcoming';
    }
}
