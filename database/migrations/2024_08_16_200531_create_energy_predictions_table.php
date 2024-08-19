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
        Schema::create('energy_predictions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Assuming predictions are user-specific
            $table->date('prediction_date');
            $table->float('predicted_value');
            $table->float('actual_value')->nullable(); // For comparing predictions with actuals later
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('energy_predictions');
    }
};
