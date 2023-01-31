<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientMedicinesTable extends Migration
{
    public function up()
    {
        Schema::create('patient_medicines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dose')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->boolean('is_continuous')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
