<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string("Code")->unique();
            $table->string("Description")->nullable();
            $table->boolean("Default")->nullable();
            $table->string("Dimension_Code")->nullable();
            $table->string("Global_Dimension_Code")->nullable();
            $table->string("Cust_Posting_Group")->nullable();
            $table->string("Gen_Bus_Post_Group")->nullable();
            $table->string("VAT_Bus_Posting_Group")->nullable();
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
        Schema::dropIfExists('student_types');
    }
}
