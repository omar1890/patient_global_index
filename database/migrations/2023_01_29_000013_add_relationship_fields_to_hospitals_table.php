<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHospitalsTable extends Migration
{
    public function up()
    {
        Schema::table('hospitals', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id', 'admin_fk_7945907')->references('id')->on('users');
        });
    }
}
