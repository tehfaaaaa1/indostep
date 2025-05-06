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
        Schema::create('destination_accomodations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->nullable()->constrained(
                table:'destinations',
                indexName:'destiantion_accomodations_destination_id'
            )->nullOnDelete();
            $table->foreignId('accomodation_id')->nullable()->constrained(
                table:'accomodations',
                indexName:'destiantion_accomodations_accomodation_id'
            )->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_accomodation');
    }
};
