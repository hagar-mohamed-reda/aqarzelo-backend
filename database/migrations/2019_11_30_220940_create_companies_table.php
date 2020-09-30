<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            //personal data 
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('active', ['active', 'not_active'])->default('not_active');
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->string('cover')->nullable(); 
            $table->string('lng')->nullable();
            $table->string('lat');

            ///realated tables have relations with them
            $table->integer('templete_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->integer('service_id')->nullable();

            ///Soical media links for website create
            $table->string('attached_file')->nullable();
            $table->string('about')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('youtube_video')->nullable();
            $table->string('twitter')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('website')->nullable();
            $table->date('website_available_days')->nullable();
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
