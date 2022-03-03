<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->increments('id');
            $table->string("Code")->unique();
            $table->string("Description")->nullable();
            $table->decimal("Amount", 10, 2)->nullable();
            $table->decimal("Early_Price", 10, 2)->nullable();
            $table->decimal("Regular_Price", 10, 2)->nullable();
            $table->boolean("Fixed_Amount")->nullable();
            $table->string("G_L_Account")->nullable();
            $table->string("VAT_Bus_Posting_Group")->nullable();
            $table->string("VAT_Prod_Posting_Group")->nullable();
            $table->string("Gen_Bus_Posting_Group")->nullable();
            $table->string("Gen_Prod_Posting_Group")->nullable();
            $table->string("Remarks")->nullable();
            $table->decimal("Total_Income", 10, 2)->nullable();
            $table->date("Date_Filter")->nullable();
            $table->boolean("Recover_First")->nullable();
            $table->decimal("Total_Billing", 10, 2)->nullable();
            $table->string("Reg_ID_Filter")->nullable();
            $table->string("Student_No_Filter")->nullable();
            $table->boolean("Show")->nullable();
            $table->string("Currency")->nullable();
            $table->string("Settlement_Type_Filter")->nullable();
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
        Schema::dropIfExists('charges');
    }
}
