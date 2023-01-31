<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientVisitsTable extends Migration
{
    public function up()
    {
        Schema::create('patient_visits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('doctor_name');
            $table->longText('diagnosis');
            $table->datetime('date');
            $table->string('division')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
