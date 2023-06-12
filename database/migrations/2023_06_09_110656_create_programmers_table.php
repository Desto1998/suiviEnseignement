<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmers', function (Blueprint $table) {
            $table->bigIncrements('programmer_id');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->integer('nombre_heure');
            $table->date('date_passage');
            $table->text('description')->nullable();
            $table->boolean('est_dispenser')->default(0);
            $table->unsignedBigInteger('cours_id');
            $table->unsignedBigInteger('salle_id');
            $table->dateTime('deleted_at')->nullable();
            $table->foreign('cours_id')->references('cours_id')->on('cours')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('salle_id')->references('salle_id')->on('salles')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programmers');
    }
}
