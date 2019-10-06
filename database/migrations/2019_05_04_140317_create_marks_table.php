<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('marks')) {
        Schema::create('marks', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('student_id')->unsigned();
                $table->integer('exam_id')->unsigned();
                $table->integer('subject_id')->unsigned();
                $table->integer('mark');
                $table->timestamps();
               // this will be added  to exams_marks table
               // $table->integer('rank');
                //$table->integer('avarage');
               // $table->string('grade');
               // $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marks');
    }
}
