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

        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->text('company_name');
            $table->text('street');
            $table->smallInteger('streetNr');
            $table->text('town');
            $table->string('zip');
            $table->bigInteger('mentor_id');
            $table->boolean('accepted');
            $table->integer('max_students');
            $table->integer('student_amount');
            $table->unsignedBigInteger('logo_id');
            $table->foreign('logo_id')->references('id')->on('logo');

            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
