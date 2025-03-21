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
            $table->foreignId('user_id')->constrained(
                table: 'users',
                column: 'id',
            );
            $table->text('company_name');
            $table->text('street');
            $table->smallInteger('streetNr');
            $table->text('town');
            $table->string('zip');
            $table->text('country');
            $table->text('website');
            $table->tinyInteger('accepted');
            $table->integer('max_students');
            $table->integer('student_amount');
            $table->text('logo');
            $table->text('company_vat')->nullable();
            $table->text('reason')->nullable();
            $table->integer('employee_count')->nullable();


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
