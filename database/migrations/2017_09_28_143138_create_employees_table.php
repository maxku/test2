<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('full_name', 45);
            $table->string('position', 45);
            $table->dateTime('emp_start_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('salary')->default('0');
            $table->integer('boss_id')->default('0');
            $table->string('image', 100)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employees');
    }
}
