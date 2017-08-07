<?php

use \Vaah\Migration\Migration;

class VaahTasks extends Migration
{

    public function up()
    {
        $this->schema->create('vaah_tasks', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('vaah_catogary_id')->nullable();
            $table->timestamps();
        });
    }

    //-----------------------------------------------------

    public function down()
    {
        $this->schema->drop('vaah_tasks');
    }

}
