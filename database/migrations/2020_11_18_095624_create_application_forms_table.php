<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('scholarships_applications', function (Blueprint $table) {
            $table->id();
            $table->string('studentName');
            $table->string('studentEmail');
            $table->string('studentPhone');
            $table->string('studentCity');
            $table->string('university');
            $table->string('faculty');
            $table->string('department');
            $table->year('graduation');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('study_id'); // programming / math / etc..
            $table->enum('status',['approved','canceled','pending'])->default('pending');
            $table->string('id_card')->unique();
            $table->string('birthdate_certificate')->unique();
            $table->string('school_certificate')->unique();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('study_id')->references('id')->on('studies')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_forms');
    }
}
