<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChequesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cheques', function(Blueprint $table) {
            $table->increments('id');
            $table->string('numero');
            $table->string('name');
            $table->date('date');
            $table->text('detalle');
            $table->decimal('monto', 20, 2);
            $table->integer('departamentos_id')->unsigned()->index();
            $table->foreign('departamentos_id')->references('id')->on('departamentos')->onDelete('no action');
            $table->integer('bancos_id')->unsigned()->index();
            $table->foreign('bancos_id')->references('id')->on('bancos')->onDelete('no action');
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
        Schema::drop('cheques');
    }

}