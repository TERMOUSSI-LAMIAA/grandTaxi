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
        Schema::create('taxi_trajet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('taxi_id')->constrained('taxis');
            $table->foreignId('trajet_id')->constrained('trajets');
            $table->time('hr_dep');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxi_trajet');
    }
};
