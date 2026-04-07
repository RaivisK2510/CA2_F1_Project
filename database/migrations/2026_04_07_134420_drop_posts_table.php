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
        Schema::dropIfExists('posts');
    }

    public function down(): void
    {
        // Since we're removing blog functionality, we don't need to recreate the posts table
        // This migration is irreversible
    }
};
