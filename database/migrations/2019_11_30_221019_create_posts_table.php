<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {

            ///data 
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->string('address')->nullable();
            $table->string('lng');
            $table->string('lat');
            $table->string('phone');
            $table->string('space');
            $table->string('price_per_meter');
            $table->string('refused_reason')->nullable();
            $table->string('bedroom_number')->nullable();
            $table->string('bathroom_number')->nullable();
            $table->string('floor_number')->nullable();
            $table->string('real_estate_number')->nullable();
            $table->date('build_date')->nullable();
            ///options
            $table->enum('active', ['active', 'not_active'])->default('not_active');
            $table->enum('has_garden', ['yes', 'no'])->default('no');
            $table->enum('furnished', ['yes', 'no'])->default('no');
            $table->enum('has_parking', ['yes', 'no'])->default('no');
            $table->enum('type', ['sale', 'rent'])->default('sale');
            $table->enum('payment_method', ['cash', 'installment'])->default('cash');
            $table->enum('status', ['accepted', 'pending', 'refused', 'user_trash'])->default('pending');
            $table->enum('owner_type', ['owner', 'developer', 'mediator'])->default('owner');
            $table->enum('finishing_type', ['extra_super_lux', 'super_lux', 'lux', 'semi_finished', 'without_finished', 'core&chel'])->default('without_finished');
           
           
           ////realated tables
            $table->integer('category_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('area_id')->nullable();
           
           
            
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
        Schema::dropIfExists('posts');
    }
}
