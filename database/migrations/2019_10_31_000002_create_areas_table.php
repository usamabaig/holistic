<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('lat')->nullable();

            $table->string('lng')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
