<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('title');
            $table->string('brief');
            $table->string('cover');
            $table->string('location');
            $table->text('content');
            $table->text('body_parsed');
            $table->tinyInteger('is_passed')->default(0);
            $table->integer('vote_count')->index()->default(0);
            $table->integer('comment_count')->index()->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
