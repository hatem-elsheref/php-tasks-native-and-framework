<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_applications', function (Blueprint $table) {
            $table->id();
            $table->string('studentName');
            $table->string('studentEmail');
            $table->string('studentPhone');
            $table->string('studentCity');
            $table->string('department');
            $table->year('graduation');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('mission_id');
            $table->enum('status',['approved','canceled','pending'])->default('pending');
            $table->string('id_card')->unique();
            $table->string('birthdate_certificate')->unique();
            $table->string('school_certificate')->unique();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('mission_id')->references('id')->on('missions')->onDelete('cascade');

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
        Schema::dropIfExists('mission_applications');
    }
}
