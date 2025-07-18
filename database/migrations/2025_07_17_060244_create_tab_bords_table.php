<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabBordsTable extends Migration
{
    public function up()
    {
        Schema::create('tab_bords', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idChauff');
            $table->foreign('idChauff')->references('id')->on('users')->onDelete('cascade');

            $table->date('date');
            $table->string('point_depart', 100);
            $table->string('destination', 100);
            $table->string('motif', 100)->nullable();

            $table->double('dep_km');
            $table->double('arr_km');
            $table->time('heure_depart');
            $table->time('heure_arrivee');
            $table->double('km_effec');
            $table->boolean('signature');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tab_bords');
    }
}
