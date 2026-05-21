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
        Schema::create('pastor_role_ids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pastor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pastor_role_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['pastor_id', 'pastor_role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pastor_role_ids');
    }
};
