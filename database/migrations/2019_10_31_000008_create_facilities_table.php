<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitiesTable extends Migration
{
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('price')->nullable();

            $table->longText('description')->nullable();

            $table->longText('how_it_work')->nullable();

            $table->longText('why_use_us')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
