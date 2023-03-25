<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("entity_id");
            $table->json("data");
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete("cascade");
            $table->timestamps();
        });
    }
};
