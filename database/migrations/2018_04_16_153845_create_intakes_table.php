<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intakes', function (Blueprint $table) {
            $table->increments('id');
            $table->string("Intake_Year")->nullable();
            $table->string("Code")->unique();
            $table->string("Description")->nullable();
            $table->string("Remarks")->nullable();
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
        Schema::dropIfExists('intakes');
    }
}
