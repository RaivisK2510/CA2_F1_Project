<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'code',
        'driver_number',
        'date_of_birth',
        'nationality',
        'place_of_birth',
        'height_cm',
        'weight_kg',
        'bio',
        'profile_image',
        'debut_year',
        'retirement_year',
        'wins',
        'podiums',
        'pole_positions',
        'fastest_laps',
        'career_points',
        'world_championships',
        'is_active',
        'team_id',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'debut_year' => 'date',
        'retirement_year' => 'date',
        'height_cm' => 'integer',
        'weight_kg' => 'integer',
        'wins' => 'integer',
        'podiums' => 'integer',
        'pole_positions' => 'integer',
        'fastest_laps' => 'integer',
        'career_points' => 'integer',
        'world_championships' => 'integer',
        'is_active' => 'boolean',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function raceResults(): HasMany
    {
        return $this->hasMany(RaceResult::class);
    }

    public function championships(): MorphMany
    {
        return $this->morphMany(Championship::class, 'championable');
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByNationality($query, string $nationality)
    {
        return $query->where('nationality', $nationality);
    }
}
