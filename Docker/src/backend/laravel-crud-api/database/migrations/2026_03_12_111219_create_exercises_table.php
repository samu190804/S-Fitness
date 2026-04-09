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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id('CodE');
            $table->string('Name', 50)->nullable();
            $table->string('Musculo', 50)->nullable();
            $table->integer('Series');
            $table->integer('Repeticiones');
            $table->text('Descripcion');
            $table->text('Video');
            $table->unsignedBigInteger('CodU');
            $table->timestamps();

            $table->foreign('CodU')->references('CodU')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
