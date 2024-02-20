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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passenger_id')->constrained('users');
            $table->foreignId('taxi_trajet_id')->constrained('taxi_trajet');
            $table->date('jour');
            $table->decimal('total_prix');
            $table->unsignedInteger('number_of_seats');
            $table->unsignedInteger('rating')->nullable();
            $table->string('comment')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
