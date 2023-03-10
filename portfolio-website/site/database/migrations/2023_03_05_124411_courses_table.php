<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('course_name');
            $table->string('course_desc');
            $table->string('course_fee');
            $table->string('course_totalEncroll');
            $table->string('course_totalClass');
            $table->string('course_link');
            $table->string('course_img');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
