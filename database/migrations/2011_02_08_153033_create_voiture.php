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
        Schema::create('voiture', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trajet_id')->constrained('trajet');
            $table->string('immatriculation');
            $table->string('type_vehicule');
            $table->unsignedInteger('seats')->default(6);
            $table->boolean('is_hide')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voiture');
    }
};
