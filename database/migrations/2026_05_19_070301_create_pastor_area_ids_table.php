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
        Schema::create('pastor_area_ids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pastor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('area_id')->constrained('carecell_areas')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['pastor_id', 'area_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pastor_area_ids');
    }
};
