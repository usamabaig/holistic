<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaFacilityPivotTable extends Migration
{
    public function up()
    {
        Schema::create('area_facility', function (Blueprint $table) {
            $table->unsignedInteger('facility_id');

            $table->foreign('facility_id', 'facility_id_fk_464159')->references('id')->on('facilities')->onDelete('cascade');

            $table->unsignedInteger('area_id');

            $table->foreign('area_id', 'area_id_fk_464159')->references('id')->on('areas')->onDelete('cascade');
        });
    }
}
