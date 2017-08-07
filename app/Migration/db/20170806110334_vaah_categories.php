<?php

use \Vaah\Migration\Migration;

class VaahCategories extends Migration
{

    public function up()
    {
        $this->schema->create('vaah_categories', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });
    }

    //-----------------------------------------------------

    public function down()
    {
        $this->schema->drop('vaah_categories');
    }

}
