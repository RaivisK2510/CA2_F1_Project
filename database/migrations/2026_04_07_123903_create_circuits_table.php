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
        Schema::create('circuits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('full_name');
            $table->string('country');
            $table->string('city');
            $table->text('address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->decimal('length_km', 5, 3); // Circuit length in km
            $table->integer('lap_record_seconds')->nullable();
            $table->string('lap_record_driver')->nullable();
            $table->year('lap_record_year')->nullable();
            $table->integer('corners')->default(0);
            $table->integer('drs_zones')->default(0);
            $table->string('direction')->default('clockwise'); // clockwise or anti-clockwise
            $table->text('description')->nullable();
            $table->string('circuit_image')->nullable();
            $table->string('layout_image')->nullable();
            $table->year('first_grand_prix');
            $table->year('last_grand_prix')->nullable();
            $table->integer('races_held')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circuits');
    }
};
