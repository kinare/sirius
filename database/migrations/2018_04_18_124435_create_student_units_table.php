<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Registration_ID', 20);
            $table->string('Student_No');
            $table->string('Programme');
            $table->string('Semester', 20);
            $table->string('Stage');
            $table->string('Unit', 20);
            $table->enum('Register_for', [
                'Stage',
                'Unit_Subject',
            ])->nullable();
            $table->string('Intake_Semester')->nullable();
            $table->string('Intake_Year')->nullable();
            $table->boolean('Taken')->nullable();
            $table->integer('UnitCount')->nullable();
            $table->boolean('Exempted')->nullable();
            $table->decimal('Attendance', 10, 2)->nullable();
            $table->boolean('Allow_Supplementary')->nullable();
            $table->boolean('Sat_Supplementary')->nullable();
            $table->boolean('Repeat_Unit')->nullable();
            $table->string('Remarks')->nullable();
            $table->boolean('Failed')->nullable();
            $table->boolean('Audit')->nullable();
            $table->enum('Project_Status', [
                '_blank__blank_',
                'Proposal',
                'Approval',
                'Research',
                'Exam',
            ])->nullable();
            $table->decimal('Final_Score', 10, 2)->nullable();
            $table->string('Created_by')->nullable();
            $table->string('Edited_By')->nullable();
            $table->date('Date_created')->nullable();
            $table->date('Date_Edited')->nullable();
            $table->decimal('Total_Marks', 10, 2)->nullable();
            $table->boolean('External_Unit')->nullable();
            $table->boolean('System_Created')->nullable();
            $table->boolean('Multiple')->nullable();
            $table->time('Time_Created')->nullable();
            $table->time('Time_Edited')->nullable();
            $table->decimal('Repeat_Marks', 10, 2)->nullable();
            $table->boolean('Re_Take')->nullable();
            $table->string('Programme_Filter')->nullable();
            $table->string('Stage_Filter')->nullable();
            $table->string('Unit_Filter')->nullable();
            $table->string('Semester_Filter')->nullable();
            $table->string('Student_Type_Filter')->nullable();
            $table->date('Date_Filter')->nullable();
            $table->boolean('Confirmed')->nullable();
            $table->string('Confirmed_By')->nullable();
            $table->date('Date_Confirmed')->nullable();
            $table->time('Time_Confirmed')->nullable();
            $table->timestamps();

            $table->foreign('Student_No')->references("No")->on("students")->onDelete('cascade');
            $table->foreign('Programme')->references("Code")->on("programmes")->onDelete('cascade');
            $table->foreign('Semester')->references("Code")->on("semesters")->onDelete('cascade');
            $table->foreign('Unit')->references("Code")->on("programme_units")->onDelete('cascade');
            $table->unique([
                'Registration_ID',
                'Semester',
                'Unit',
                'Date_created',
            ], 'student_units_composite_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_units');
    }
}
