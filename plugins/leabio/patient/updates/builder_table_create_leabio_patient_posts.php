<?php namespace Leabio\Patient\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLeabioPatientPosts extends Migration
{
    public function up()
    {
        Schema::create('leabio_patient_posts', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('category_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('leabio_patient_posts');
    }
}
