<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('department_id');
            $table->bigInteger('designation_id');
            $table->bigInteger('branch_id');
            $table->string('id_number', 100)->nullable();
            $table->string('blood_group', 15)->nullable();
            $table->string('gender', 25)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number', 100)->nullable();
            $table->date('joining_date')->nullable();
            $table->mediumText('educational_background')->nullable();
            $table->string('profile_picture')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('employees');
    }
}
