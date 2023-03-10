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
            Schema::create('blogs',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('blog_name');
            $table->string('blog_desc');
            $table->string('blog_link');
            $table->string('blog_img');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
