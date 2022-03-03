<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->increments('id');
            $table->string("Code")->unique();
            $table->string("Description")->nullable();
            $table->enum("Status",[
                "_blank_",
                "Registration",
                "Current",
                "Allumnae",
                "Dropped",
            ])->nullable();
            $table->string("Faculty")->nullable();
            $table->decimal("Total_Income", 10,2 )->nullable();
            $table->integer("Registered_Students")->nullable();
            $table->integer("Paid_Students")->nullable();
            $table->integer("Min_No_of_Courses")->nullable();
            $table->integer("Max_No_of_Courses")->nullable();
            $table->integer("Mandatory_Units")->nullable();
            $table->integer("Min_Pass_Units")->nullable();
            $table->enum("Category",[
                "_blank_",
                "Diploma",
                "Undergraduate",
                "Postgraduate",
                "Course_List",
            ])->nullable();

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
        Schema::dropIfExists('programmes');
    }
}
