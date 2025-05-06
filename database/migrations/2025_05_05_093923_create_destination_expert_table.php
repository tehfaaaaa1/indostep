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
        Schema::create('destination_experts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->nullable()->constrained(
                table:'destinations',
                indexName:'destiantion_expert_destination_id'
            )->nullOnDelete();
            $table->foreignId('expert_id')->nullable()->constrained(
                table:'experts',
                indexName:'destiantion_experts_expert_id'
            )->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_expert');
    }
};
