<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->bigIncrements('cours_id');
            $table->integer('duree');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->text('description')->nullable();
            $table->string('libelle');
            $table->boolean('est_dispenser')->default(0);
            $table->unsignedBigInteger('enseignant_id');
            $table->unsignedBigInteger('matiere_id');
            $table->unsignedBigInteger('filiere_id');
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
            $table->foreign('enseignant_id')->references('enseignant_id')->on('enseignants')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('matiere_id')->references('matiere_id')->on('matieres')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('filiere_id')->references('filiere_id')->on('filieres')
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
        Schema::dropIfExists('cours');
    }
}
