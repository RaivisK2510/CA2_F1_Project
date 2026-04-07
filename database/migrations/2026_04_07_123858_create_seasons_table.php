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
            $table->integer('year')->unique();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('total_races')->default(0);
            $table->integer('completed_races')->default(0);
            $table->foreignId('champion_driver_id')->nullable()->constrained('drivers')->nullOnDelete();
            $table->foreignId('champion_team_id')->nullable()->constrained('teams')->nullOnDelete();
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
