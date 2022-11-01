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
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('shift_type_id');
            $table->date('date');
            $table->date('paid_at')->nullable();

            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->foreign('shift_type_id')->references('id')->on('shift_types')->onDelete('cascade');
           
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
