<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGarageTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_garage_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreign('garage_id')->references('id')->on('tbl_garages');
            $table->timestamps('opening_time');
            $table->timestamps('closing_time');
            $table->double('total');
            $table->foreign('car_in_by_user_id')->references('id')->on('tbl_users');
            $table->foreign('car_out_by_user_id')->references('id')->on('tbl_users');
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
        Schema::dropIfExists('tbl_garage_transactions');
    }
}
