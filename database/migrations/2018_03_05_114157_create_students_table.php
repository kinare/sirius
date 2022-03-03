<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatestudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('No',50)->unique();
            $table->integer('user_id',false,true)->nullable();
            $table->string('Customer_No')->nullable();
            $table->string('Other_Names')->nullable();
            $table->string('Search_Name')->nullable();
            $table->date('Date_Created')->nullable();
            $table->date('Application_Date')->nullable();
            $table->string('Surname', 50)->nullable();
            $table->enum('Status',[
                'New',
                'Received',
                'Application',
                'Reviewed',
                'Current',
                'Inactive',
                'Blocked',
                'Deceased',
                'ToBeConfirmed',
                'Registration',
                'UnitBooking',
            ])->nullable();
            $table->string("Parent_Institution_Customer")->nullable();
            $table->decimal("Billing_Amount", 10, 2)->nullable();
            $table->string("Currency_Code")->nullable();
            $table->string("Certificate_No")->nullable();
            $table->date("Date_Of_Birth")->nullable();
            $table->enum("Gender", ["Male", "Female"])->nullable();
            $table->enum("Marital_Status", ["Single", "Married"])->nullable();
            $table->string("Nationality")->nullable();
            $table->string("ID_Number", 10)->nullable();
            $table->string("PIN_Registration_No")->nullable();
            $table->string("Pass_Port_No")->nullable();
            $table->string("No_Series")->nullable();
            $table->string("Country_Region_Code")->nullable();
            $table->string("Global_Dimension_1_Code")->nullable();
            $table->string("Global_Dimension_2_Code")->nullable();
            $table->string("Global_Dimension_3_Code")->nullable();
            $table->integer("Dimension_SetID")->nullable();
            $table->boolean("Conviction")->nullable();
            $table->string("Offence")->nullable();
            $table->string("Date_and_Place")->nullable();
            $table->string("Sentence")->nullable();
            $table->string("Referee_Name")->nullable();
            $table->string("Referee_Address")->nullable();
            $table->string("Referee_Telephone")->nullable();
            $table->string("Referee_Email")->nullable();
            $table->string("E_mail")->nullable();
            $table->string("Phone_No")->nullable();
            $table->string("Mobile_No")->nullable();
            $table->string("Address")->nullable();
            $table->string("Address_2")->nullable();
            $table->string("City")->nullable();
            $table->string("Post_Code")->nullable();
            $table->string("County")->nullable();
            $table->string("Home_Page")->nullable();
            $table->string("Contact")->nullable();
            $table->string("Fax_No")->nullable();
            $table->string("Exam_Billing_Type")->nullable();
            $table->string("Student_Type")->nullable();
            $table->string("Application_No")->nullable();
            $table->string("Current_Registration_No")->nullable();
            $table->string("Review_Recommendation")->nullable();
            $table->date("Review_Date")->nullable();
            $table->date("Date_Of_Meeting")->nullable();
            $table->date("Date_Sent_for_Approval")->nullable();
            $table->enum("Source", [
                "Manual",
                "_WebEntry",
            ])->nullable();
            $table->string("Current_Intake_Period")->nullable();
            $table->date("Graduation_Date")->nullable();
            $table->string("Programme_Filter")->nullable();
            $table->string("Stage_Filter")->nullable();
            $table->string("Unit_Filter")->nullable();
            $table->string("Semester_Filter")->nullable();
            $table->string("Student_Type_Filter")->nullable();
            $table->date("Date_Filter")->nullable();
            $table->string("Last_Modified_By")->nullable();
            $table->boolean("Synched")->nullable();
            $table->dateTime("Last_TimeStamp")->nullable();
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
        Schema::dropIfExists('students');
    }
}
