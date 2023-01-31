<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPatientMedicinesTable extends Migration
{
    public function up()
    {
        Schema::table('patient_medicines', function (Blueprint $table) {
            $table->unsignedBigInteger('medicine_id')->nullable();
            $table->foreign('medicine_id', 'medicine_fk_7952705')->references('id')->on('medicines');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id', 'patient_fk_7952706')->references('id')->on('patients');
        });
    }
}
