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
        Schema::create('pastor_leader_ids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pastor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('leader_id')->constrained('carecell_leaders')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['pastor_id', 'leader_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pastor_leader_ids');
    }
};
