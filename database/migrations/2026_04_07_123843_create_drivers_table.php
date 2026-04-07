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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('code', 3)->unique(); // 3-letter driver code
            $table->integer('driver_number')->unique();
            $table->date('date_of_birth');
            $table->string('nationality');
            $table->string('place_of_birth');
            $table->integer('height_cm')->nullable();
            $table->integer('weight_kg')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_image')->nullable();
            $table->date('debut_year')->nullable();
            $table->date('retirement_year')->nullable();
            $table->integer('wins')->default(0);
            $table->integer('podiums')->default(0);
            $table->integer('pole_positions')->default(0);
            $table->integer('fastest_laps')->default(0);
            $table->integer('career_points')->default(0);
            $table->integer('world_championships')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
