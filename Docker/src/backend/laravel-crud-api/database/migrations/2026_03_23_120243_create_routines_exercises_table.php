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
        Schema::create('routines_exercises', function (Blueprint $table) {
            $table->unsignedBigInteger('CodR');
            $table->unsignedBigInteger('CodE');

            $table->foreign('CodR')->references('CodR')->on('routines')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('CodE')->references('CodE')->on('exercises')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['CodR', 'CodE']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routines_exercises');
    }
};
