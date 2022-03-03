<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_programmes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Registration_ID', 20)->nullable();
            $table->string('Student_No', 10)->nullable();
            $table->string('Transaction_ID')->unique();
            $table->string('Programme')->nullable();
            $table->string('Intake_Semester')->nullable();
            $table->string('Intake_Stage')->nullable();
            $table->date('Date')->nullable();
            $table->string('Remarks')->nullable();
            $table->string('Exam_Center')->nullable();
            $table->boolean('Notification_Sent')->nullable();
            $table->string('Notification_DateTime')->nullable();
            $table->integer('Units_Taken')->nullable();
            $table->string('Noitification_UserID')->nullable();
            $table->enum('Status',[
                'New',
                'Registration',
                'Current',
                'Completed',
                'Dropped',
                'Reviewed',
                'ToBeConfirmed',
                'UnitBooking',
                'InActive',
            ])->nullable();
            $table->string('No_Series')->nullable();
            $table->string('Reg_Series')->nullable();
            $table->boolean('Register')->nullable();
            $table->boolean('Units_Allocated')->nullable();
            $table->string('Intake_Year')->nullable();
            $table->boolean('Blocked')->nullable();
            $table->string('Programme_Filter')->nullable();
            $table->string('Stage_Filter')->nullable();
            $table->string('Unit_Filter')->nullable();
            $table->string('Semester_Filter')->nullable();
            $table->string('Student_Type_Filter')->nullable();
            $table->date('Date_Filter')->nullable();
            $table->string('Questionnaire_Code')->nullable();
            $table->boolean('Generate_Charges')->nullable();
            $table->boolean('Assign_Registration')->nullable();
            $table->date('Date_Created')->nullable();
            $table->time('Time_Created')->nullable();
            $table->integer('Total_Taken_Units')->nullable();
            $table->string('Total_Exempted_Units')->nullable();
            $table->timestamps();

            $table->foreign('Student_No')->references("No")->on("students")->onDelete('cascade');
            $table->foreign('Programme')->references("Code")->on("programmes")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_programmes');
    }
}
