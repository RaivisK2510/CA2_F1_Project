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
        Schema::create('championships', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'drivers' or 'constructors'
            $table->integer('position');
            $table->integer('points');
            $table->integer('wins');
            $table->integer('podiums')->default(0);
            $table->integer('pole_positions')->default(0);
            $table->integer('fastest_laps')->default(0);
            $table->integer('races_participated');
            $table->integer('races_completed');
            $table->text('notes')->nullable();
            
            // Foreign keys
            $table->foreignId('season_id')->constrained()->onDelete('cascade');
            
            // Polymorphic relationships for driver or team
            $table->morphs('championable'); // championable_type and championable_id
            
            // Ensure unique combination of season, type, and participant
            $table->unique(['season_id', 'type', 'championable_type', 'championable_id'], 'champ_season_type_unique');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('championships');
    }
};
