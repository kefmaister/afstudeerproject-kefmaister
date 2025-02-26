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
        Schema::disableForeignKeyConstraints();

        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->text('firstname');
            $table->text('lastname');
            $table->string('password');
            $table->text('email');
            $table->string('class');
            $table->unsignedBigInteger('studyfield_id');
            $table->foreign('studyfield_id')->references('id')->on('studyfield');
            $table->integer('year');
            $table->unsignedBigInteger('proposal_id')->nullable();
            $table->bigInteger('cv_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
