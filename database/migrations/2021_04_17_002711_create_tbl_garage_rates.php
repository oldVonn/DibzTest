<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGarageRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_garage_rates', function (Blueprint $table) {
            $table->id();
            $table->string('day',['monday','tuesday','wednesday','thursday','friday','saturday','sunday']);
            $table->timestamps('opening_time');
            $table->timestamps('closing_time');
            $table->string('type',['flat','hourly']);
            $table->double('rate');
            $table->string('status',['open','close']);
            $table->double('succeeding_rate');
            $table->foreign('garage_id')->references('id')->on('tbl_garages');
            $table->timestamps();
            $table->dropSoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_garage_rates');
    }
}
