<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('ext_id');
            $table->string('weather_main');
            $table->string('weather_description');
            $table->string('weather_icon');
            $table->string('base');
            $table->float('main_temp');
            $table->float('main_feels_like');
            $table->float('main_temp_min');
            $table->float('main_temp_max');
            $table->integer('main_pressure');
            $table->integer('main_humidity');
            $table->integer('visibility');
            $table->float('wind_speed');
            $table->integer('wind_deg');
            $table->float('wind_gust')->nullable();
            $table->integer('clouds_all');
            $table->string('sys_country');
            $table->bigInteger('sys_sunrise');
            $table->bigInteger('sys_sunset');
            $table->integer('timezone');
            $table->string('name');
            $table->timestamps();
        });
    }
};
