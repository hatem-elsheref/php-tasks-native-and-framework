<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->string('source');
            $table->unsignedBigInteger('study_id'); // programming / math / etc..
            $table->string('degree');
            $table->integer('vacanciesNumber');
            $table->date('endDate');
            $table->string('manual');
            $table->timestamps();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('study_id')->references('id')->on('studies')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
}
