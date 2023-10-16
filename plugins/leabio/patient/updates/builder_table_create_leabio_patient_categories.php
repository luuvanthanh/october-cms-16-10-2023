<?php namespace Leabio\Patient\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateLeabioPatientCategories extends Migration
{
    public function up()
    {
        Schema::create('leabio_patient_categories', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('leabio_patient_categories');
    }
}
