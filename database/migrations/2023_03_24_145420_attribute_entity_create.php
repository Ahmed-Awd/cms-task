<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('attribute_entity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("attribute_id");
            $table->unsignedBigInteger("entity_id");
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete("cascade");
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete("cascade");
            $table->timestamps();
        });
    }
};
