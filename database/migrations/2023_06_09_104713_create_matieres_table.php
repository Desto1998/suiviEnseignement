<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matieres', function (Blueprint $table) {
            $table->bigIncrements('matiere_id');
            $table->string('code_mat');
            $table->string('intitule_mat');
            $table->unsignedBigInteger('filiere_id');
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('matieres');
    }
}
