<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostAccessList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_access_list', function (Blueprint $table) {
            $table->integer('post_id')->unsigned();
            $table->integer('user_id')->unsigned();         
            //SETTING THE PRIMARY KEYS
            $table->primary(['post_id','user_id']);
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
        Schema::dropIfExists('post_access_list');
    }
}
