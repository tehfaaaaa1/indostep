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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('island_id')->nullable()->constrained(
                table:'islands',
                indexName:'destinations_island_id'
            )->nullOnDelete();
            $table->foreignId('expert_id')->nullable()->constrained(
                table:'experts',
                indexName:'destinations_expert_id'
            )->nullOnDelete();
            $table->foreignId('trip_type_id')->nullable()->constrained(
                table:'trip_types',
                indexName:'destinations_trip_type_id'
            )->nullOnDelete();
            $table->foreignId('accomodation_id')->nullable()->constrained(
                table:'accomodations',
                indexName:'destinations_accomodation_id'
            );
            $table->string('address');
            $table->text('overview');
            $table->text('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinasis');
    }
};
