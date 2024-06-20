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
        Schema::create('asset_damages', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('asset_item_id')->constrained('asset_items')->cascadeOnDelete();
            $table->string('status')->nullable();
            $table->string('reason')->nullable();
            $table->string('reported_by')->nullable();
            $table->string('location_of_damage')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_damages');

    }
};
