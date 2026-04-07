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
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->year('year')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('total_races');
            $table->integer('completed_races')->default(0);
            $table->string('champion_driver_id')->nullable();
            $table->string('champion_team_id')->nullable();
            $table->text('description')->nullable();
            $table->string('season_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
