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

        Schema::create('proposal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained(
                table: 'student',
                column: 'id',
            );
            $table->foreignId('stage_id')->constrained(
                table: 'stage',
                column: 'id',
            );
            $table->text('tasks');
            $table->text('motivation');
            $table->tinyInteger('status');
            $table->text('feedback')->nullable();
            $table->foreignId('coordinator_id')->constrained(
                table: 'coordinator',
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
        Schema::dropIfExists('proposal');
    }
};
