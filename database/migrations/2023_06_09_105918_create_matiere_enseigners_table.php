<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatiereEnseignersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matiere_enseigners', function (Blueprint $table) {
            $table->bigIncrements('mat_esn_id');
            $table->string('annee');
            $table->unsignedBigInteger('enseignantid');
            $table->unsignedBigInteger('matiere_id');
            $table->timestamps();
            $table->foreign('matiere_id')->references('matiere_id')->on('matieres')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('enseignantid')->references('enseignant_id')->on('enseignants')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matiere_enseigners');
    }
}
