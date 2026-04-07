<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Circuit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'full_name',
        'country',
        'city',
        'address',
        'latitude',
        'longitude',
        'length_km',
        'lap_record_seconds',
        'lap_record_driver',
        'lap_record_year',
        'corners',
        'drs_zones',
        'direction',
        'description',
        'circuit_image',
        'layout_image',
        'first_grand_prix',
        'last_grand_prix',
        'races_held',
        'is_active',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'length_km' => 'decimal:3',
        'lap_record_seconds' => 'integer',
        'lap_record_year' => 'integer',
        'corners' => 'integer',
        'drs_zones' => 'integer',
        'first_grand_prix' => 'integer',
        'last_grand_prix' => 'integer',
        'races_held' => 'integer',
        'is_active' => 'boolean',
    ];

    public function races(): HasMany
    {
        return $this->hasMany(Race::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCountry($query, string $country)
    {
        return $query->where('country', $country);
    }

    public function getLapRecordTimeAttribute(): string
    {
        if (!$this->lap_record_seconds) {
            return 'N/A';
        }

        $minutes = floor($this->lap_record_seconds / 60);
        $seconds = $this->lap_record_seconds % 60;
        $milliseconds = round(($this->lap_record_seconds - floor($this->lap_record_seconds)) * 1000);

        return sprintf('%d:%02d.%03d', $minutes, $seconds, $milliseconds);
    }
}
