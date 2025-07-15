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
       Schema::create('trajets', function (Blueprint $table) {
    $table->id();
    $table->double('km');
    $table->string('typeRoute');
    $table->foreignId('lieu_depart_id')->constrained('lieux')->onDelete('cascade');
    $table->foreignId('lieu_arrive_id')->constrained('lieux')->onDelete('cascade');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};
