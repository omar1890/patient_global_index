<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurgeriesTable extends Migration
{
    public function up()
    {
        Schema::create('surgeries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('reason');
            $table->longText('description')->nullable();
            $table->string('type');
            $table->string('doctor_name');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
