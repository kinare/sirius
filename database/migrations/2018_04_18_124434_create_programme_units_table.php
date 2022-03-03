<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgrammeUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programme_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Programme_Code')->nullable();
            $table->string('Stage_Code')->nullable();
            $table->string('Code')->unique();
            $table->string('Description')->nullable();
            $table->decimal('Credit_Hours', 6, 2)->nullable();
            $table->string('G_L_Account')->nullable();
            $table->string('Department')->nullable();
            $table->string('Remarks')->nullable();
            $table->string('Prerequisite')->nullable();
            $table->integer('Students_Registered')->nullable();
            $table->enum('Unit_Type', [
                'Core',
                'Elective',
                'Required',
            ])->nullable();
            $table->boolean('Common_Unit')->nullable();
            $table->decimal('No_Units', 6, 2)->nullable();
            $table->integer('Registered_Students')->nullable();
            $table->boolean('Time_Table')->nullable();
            $table->string('Programme_Filter')->nullable();
            $table->string('Stage_Filter')->nullable();
            $table->string('Unit_Filter')->nullable();
            $table->string('Semester_Filter')->nullable();
            $table->string('Student_Type_Filter')->nullable();
            $table->date('Date_Filter')->nullable();
            $table->string('Exam_Filter')->nullable();
            $table->string('Student_No_Filter')->nullable();
            $table->boolean('Mandatory_Unit')->nullable();
            $table->decimal('Unit_Fees', 10, 2)->nullable();
            $table->decimal('Exemption_Fees', 10, 2)->nullable();
            $table->decimal('Deferral_Fees', 10, 2)->nullable();
            $table->date('Exam_Date')->nullable();
            $table->time('From')->nullable();
            $table->time('To')->nullable();
            $table->timestamps();

            $table->foreign('Programme_Code')->references('Code')->on('programmes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programme_units');
    }
}
