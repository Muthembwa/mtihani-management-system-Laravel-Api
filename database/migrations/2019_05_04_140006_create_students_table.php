<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('students')) {
            Schema::create('students', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('adm_no')->nullable()->unsigned();
                $table->string('student_name')->nullable();
                $table->string('parents_name')->nullable();
                $table->string('parents_email')->nullable();
                $table->integer('parents_phone_no')->nullable(); 
                $table->timestamps();
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
        Schema::dropIfExists('students');
    }
}
