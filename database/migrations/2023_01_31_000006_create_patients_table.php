<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('weight', 15, 2)->nullable();
            $table->float('height', 15, 2)->nullable();
            $table->boolean('smoking')->default(0)->nullable();
            $table->string('blood_type')->nullable();
            $table->string('avg_blood_pressure')->nullable();
            $table->string('name');
            $table->string('identity_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
