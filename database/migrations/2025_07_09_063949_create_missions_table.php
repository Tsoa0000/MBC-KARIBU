<?php

// database/migrations/xxxx_xx_xx_create_missions_table.php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voiture_id')->constrained()->onDelete('cascade');
            $table->foreignId('chauffeur_id')->constrained('detail_chauffs')->onDelete('cascade');
            $table->unsignedBigInteger('lieu_depart_id');
            $table->unsignedBigInteger('lieu_arrive_id');
            $table->date('date_depart');
            $table->date('date_arrive');
            $table->text('objet');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('missions');
    }
};

