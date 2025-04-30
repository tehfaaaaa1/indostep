<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservation_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expedition_id')->constrained(
                table:'expeditions',
                indexName:'reservation_groups_expedition_id'
            );
            $table->foreignId('accomodation_id')->constrained(
                table:'accomodations',
                indexName:'reservation_groups_accomodation_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_groups');
    }
};
