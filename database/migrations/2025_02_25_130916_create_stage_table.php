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

        Schema::create('stage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained(
                table: 'company',
                column: 'id',
            );
            $table->tinyInteger('active');
            $table->text('title');
            $table->text('tasks');
            // Removed student_id since a stage can be used in multiple proposals
            $table->foreignId('studyfield_id')->constrained(
                table: 'studyfield',
                column: 'id',
            );
            $table->text('reason')->nullable();

            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stage');
    }
};
