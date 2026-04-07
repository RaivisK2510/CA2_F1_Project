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
        Schema::create('race_results', function (Blueprint $table) {
            $table->id();
            $table->integer('position');
            $table->string('position_text', 10); // For positions like DNF, DNS, etc.
            $table->integer('grid_position');
            $table->integer('laps_completed');
            $table->time('race_time')->nullable();
            $table->string('time_gap', 20)->nullable(); // Time gap to winner
            $table->string('interval', 20)->nullable(); // Interval to car ahead
            $table->integer('points');
            $table->string('status', 50); // Finished, DNF, DNS, etc.
            $table->integer('fastest_lap')->default(0); // 1 if driver had fastest lap
            $table->string('fastest_lap_time')->nullable();
            $table->string('average_speed')->nullable();
            $table->text('notes')->nullable();
            
            // Foreign keys
            $table->foreignId('race_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            
            // Ensure unique combination of race and driver
            $table->unique(['race_id', 'driver_id']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('race_results');
    }
};
