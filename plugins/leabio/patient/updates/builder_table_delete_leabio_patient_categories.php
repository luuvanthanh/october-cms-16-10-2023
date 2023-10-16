<?php namespace Leabio\Patient\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteLeabioPatientCategories extends Migration
{
    public function up()
    {
        Schema::dropIfExists('leabio_patient_categories');
    }
    
    public function down()
    {
        Schema::create('leabio_patient_categories', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name', 255);
            $table->string('image', 255)->nullable();
        });
    }
}
