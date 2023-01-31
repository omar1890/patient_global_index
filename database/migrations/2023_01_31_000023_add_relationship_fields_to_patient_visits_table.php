<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPatientVisitsTable extends Migration
{
    public function up()
    {
        Schema::table('patient_visits', function (Blueprint $table) {
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->foreign('hospital_id', 'hospital_fk_7952788')->references('id')->on('hospitals');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id', 'patient_fk_7952789')->references('id')->on('patients');
        });
    }
}
