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
            $table->foreignId('studyfield_id')->constrained(
                table: 'studyfield',
                column: 'id',
            );
            $table->integer('year');
            $table->foreignId('proposal_id')->nullable()->constrained(
                table: 'proposal',
                column: 'id',
            );
            $table->foreignId('cv_id')->nullable()->constrained(
                table: 'cv',
                column: 'id',
            );
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
