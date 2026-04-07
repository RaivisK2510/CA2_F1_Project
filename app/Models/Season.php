<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'start_date',
        'end_date',
        'total_races',
        'completed_races',
        'champion_driver_id',
        'champion_team_id',
        'description',
        'season_image',
        'is_active',
    ];

    protected $casts = [
        'year' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'total_races' => 'integer',
        'completed_races' => 'integer',
        'is_active' => 'boolean',
    ];

    public function races(): HasMany
    {
        return $this->hasMany(Race::class);
    }

    public function championships(): HasMany
    {
        return $this->hasMany(Championship::class);
    }

    public function championDriver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'champion_driver_id');
    }

    public function championTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'champion_team_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByYear($query, int $year)
    {
        return $query->where('year', $year);
    }

    public function getCompletionPercentageAttribute(): float
    {
        if ($this->total_races === 0) {
            return 0;
        }

        return round(($this->completed_races / $this->total_races) * 100, 2);
    }
}
