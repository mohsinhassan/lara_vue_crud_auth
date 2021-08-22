<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developers', function (Blueprint $table) {
                $table->id();

                //First name, Last name, Email, Phone number, Address, Avatar (image)
                $table->string('fname');
                $table->string('lname');
                $table->string('email');
                $table->string('phone_number');
                $table->string('avatar');
                $table->text('address');            
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
        Schema::dropIfExists('developers');
    }
}
