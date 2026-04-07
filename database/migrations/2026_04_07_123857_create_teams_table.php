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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('full_name');
            $table->string('code', 3)->unique(); // 3-letter team code
            $table->string('country');
            $table->string('headquarters');
            $table->string('team_chief')->nullable();
            $table->string('technical_chief')->nullable();
            $table->string('chassis')->nullable();
            $table->string('power_unit')->nullable();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('car_image')->nullable();
            $table->date('founded_year');
            $table->date('disbanded_year')->nullable();
            $table->integer('world_championships')->default(0);
            $table->integer('race_wins')->default(0);
            $table->integer('pole_positions')->default(0);
            $table->integer('fastest_laps')->default(0);
            $table->integer('podiums')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
