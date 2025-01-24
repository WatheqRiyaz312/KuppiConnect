<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id'); // Primary key for the modules table
            $table->unsignedInteger('tutor_id'); // Match tutors_registration tutor_id
            $table->string('name'); // Module name
            $table->string('description'); // Module description
            $table->string('date'); // Date of the module
            $table->string('time'); // Time of the module
            $table->json('resources')->nullable(); // JSON column for resources (can store multiple resources)
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('tutor_id')
                ->references('tutor_id') // Column in tutors_registration
                ->on('tutors_registration') // Related table
                ->onDelete('cascade'); // Cascade delete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
