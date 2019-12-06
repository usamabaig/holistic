<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitySubServicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('facility_sub_service', function (Blueprint $table) {
            $table->unsignedInteger('sub_service_id');

            $table->foreign('sub_service_id', 'sub_service_id_fk_468946')->references('id')->on('sub_services')->onDelete('cascade');

            $table->unsignedInteger('facility_id');

            $table->foreign('facility_id', 'facility_id_fk_468946')->references('id')->on('facilities')->onDelete('cascade');
        });
    }
}
