<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChecksTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('checks', function(Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->string('name');
            $table->date('date');
            $table->text('detail');
            $table->decimal('amount', 20, 2);
            $table->integer('church_id')->unsigned()->index();
            $table->foreign('church_id')->references('id')->on('churches')->onDelete('no action');
            $table->engine = 'InnoDB';
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('checks');
    }

}
