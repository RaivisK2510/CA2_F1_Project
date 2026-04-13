<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "full_name",
        "code",
        "country",
        "headquarters",
        "team_chief",
        "technical_chief",
        "chassis",
        "power_unit",
        "description",
        "logo",
        "car_image",
        "founded_year",
        "disbanded_year",
        "world_championships",
        "race_wins",
        "pole_positions",
        "fastest_laps",
        "podiums",
        "is_active",
    ];

    protected $casts = [
        "founded_year" => "date",
        "disbanded_year" => "date",
        "world_championships" => "integer",
        "race_wins" => "integer",
        "pole_positions" => "integer",
        "fastest_laps" => "integer",
        "podiums" => "integer",
        "is_active" => "boolean",
    ];

    protected static function booted(): void
    {
        static::creating(function (Team $team) {
            if (empty($team->code)) {
                $team->code = self::generateNextCode();
            }
        });
    }

    public static function generateNextCode(): string
    {
        $lastCode = self::orderByDesc("code")->value("code");
        $next = is_numeric($lastCode) ? intval($lastCode) + 1 : 1;

        return str_pad($next, 3, "0", STR_PAD_LEFT);
    }

    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class);
    }

    public function raceResults(): HasMany
    {
        return $this->hasMany(RaceResult::class);
    }

    public function championships(): MorphMany
    {
        return $this->morphMany(Championship::class, "championable");
    }

    /**
     * Get all favorites for this team.
     */
    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, "favoritable");
    }

    public function scopeActive($query)
    {
        return $query->where("is_active", true);
    }

    public function scopeByCountry($query, string $country)
    {
        return $query->where("country", $country);
    }
}
