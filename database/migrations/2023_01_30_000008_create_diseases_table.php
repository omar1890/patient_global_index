<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasesTable extends Migration
{
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->boolean('is_chronic')->default(0)->nullable();
            $table->boolean('is_from_parents')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
