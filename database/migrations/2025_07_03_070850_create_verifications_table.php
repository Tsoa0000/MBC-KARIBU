<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            $table->date('dateVerif');
            $table->boolean('papierVehi');
            $table->boolean('huileMoteur');
            $table->boolean('lockeed');
            $table->boolean('eau');
            $table->boolean('pneu');
            $table->string('obs');
            $table->unsignedBigInteger('voiture_id')->nullable();
            $table->foreign('voiture_id')->references('id')->on('voitures')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifications');
    }
};
