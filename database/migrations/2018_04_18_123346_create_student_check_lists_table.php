<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCheckListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_check_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Questionnaire_Code')->nullable();
            $table->integer('Line_No')->nullable();
            $table->string('Intake')->nullable();
            $table->string('Student_ID');
            $table->boolean('Satisfied')->nullable();
            $table->string('Description')->nullable();
            $table->string('Remarks')->nullable();
            $table->string('TransactionID')->nullable();
            $table->boolean('Confirmed')->nullable();
            $table->string('Confirmed_By')->nullable();
            $table->date('Date_Confirmed')->nullable();
            $table->time('Time_Confirmed')->nullable();
            $table->timestamps();

            $table->foreign('Student_ID')->references("No")->on("students")->onDelete('cascade');
            $table->foreign('Intake')->references("Code")->on("intakes")->onDelete('cascade');
            $table->foreign('Questionnaire_Code')->references("Code")->on("check_lists")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_check_lists');
    }
}
