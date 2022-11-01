<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            
            $table->string('employee');
            $table->string('employer');
            $table->string('hours');
            $table->string('rate_per_hour');
            $table->boolean('taxable');
            $table->date('date');
            $table->dateTime('paid_at')->nullable();
            $table->string('status');
            $table->string('shift_type');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
