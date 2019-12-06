<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubServicesTable extends Migration
{
    public function up()
    {
        Schema::create('sub_services', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();

            $table->string('charges')->nullable();

            $table->longText('description')->nullable();

            $table->string('why_use_us')->nullable();

            $table->string('how_it_work')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
