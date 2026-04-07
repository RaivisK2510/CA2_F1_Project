<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('full_name');
            $table->string('official_name');
            $table->integer('round_number');
            $table->date('race_date');
            $table->time('race_time')->nullable();
            $table->integer('laps');
            $table->decimal('race_distance_km', 8, 3);
            $table->string('fastest_lap_time')->nullable();
            $table->string('fastest_lap_driver_id')->nullable();
            $table->string('pole_position_time')->nullable();
            $table->string('pole_position_driver_id')->nullable();
            $table->text('weather_conditions')->nullable();
            $table->text('race_report')->nullable();
            $table->string('race_image')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->boolean('is_cancelled')->default(false);
            $table->boolean('is_active')->default(true);
            
            // Foreign keys
            $table->foreignId('season_id')->constrained()->onDelete('cascade');
            $table->foreignId('circuit_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};
