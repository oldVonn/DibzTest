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
            $table->enum('day',['monday','tuesday','wednesday','thursday','friday','saturday','sunday']);
            $table->time('opening_time');
            $table->time('closing_time');
            $table->enum('type',['flat','hourly']);
            $table->double('rate');
            $table->enum('status',['open','close']);
            $table->double('succeeding_rate');
            $table->foreignId('garage_id')->constrained('tbl_garages');
            $table->timestamps();
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
        Schema::dropIfExists('tbl_garage_rates');
    }
}
