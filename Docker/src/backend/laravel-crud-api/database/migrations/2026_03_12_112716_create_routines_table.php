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
        Schema::create('routines', function (Blueprint $table) {
            $table->id('CodR');
            $table->string('Name', 50);
            $table->integer('Dias');
            $table->integer('Duracion');
            $table->integer('Nivel');
            $table->string('Musculos', 50);
            $table->text('Descripcion');
            $table->unsignedBigInteger('CodU');
            $table->timestamps();

            $table->foreign('CodU')->references('CodU')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routines');
    }
};
