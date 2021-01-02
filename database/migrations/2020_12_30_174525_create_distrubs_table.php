<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distrubs', function (Blueprint $table) {
            $table->id();
            $table->date("dates");
            $table->time("times");
            $table->text("descript");
            $table->enum('whom', ['prison', 'employee']);
            $table->bigInteger("serviced");
            $table->string("reg_num");
            $table->date("reg_date");
            $table->enum('dvr_type', ['dvr', 'bwc']);
            $table->string("dvr_num");
            $table->string("distrub_type");
            $table->bigInteger("prision_id");
            $table->bigInteger("operator_id");
            $table->bigInteger("user_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distrubs');
    }
}
