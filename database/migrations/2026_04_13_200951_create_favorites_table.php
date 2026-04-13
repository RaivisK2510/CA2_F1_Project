<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("favorites", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("favoritable_id");
            $table->string("favoritable_type");
            $table->timestamps();

            // Foreign key constraint
            $table
                ->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade");

            // Unique constraint: a user can only favorite an item once
            $table->unique(["user_id", "favoritable_id", "favoritable_type"]);

            // Index for faster queries
            $table->index(["favoritable_id", "favoritable_type"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("favorites");
    }
};
