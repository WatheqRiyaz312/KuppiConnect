<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorsRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutors_registration', function (Blueprint $table) {
            $table->increments('tutor_id'); // auto increment primary key
            $table->string('name', 100); // tutor's name
            $table->string('email', 255); // email
            $table->string('password', 255); // password
            $table->enum('gender', ['male', 'female']); // gender
            $table->string('image', 255)->nullable(); // image
            $table->text('bio')->nullable(); // bio
            $table->text('achievements')->nullable(); // achievements
            $table->timestamp('created_at')->useCurrent(); // created timestamp
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // updated timestamp
            $table->enum('department', ['Computer Science', 'Cyber Security', 'Software Engineering']); // department
            $table->string('phone_number', 20); // phone number
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutors_registration');
    }
}
