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
        Schema::create('tbl_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('garage_id')->constrained('tbl_garages');
            $table->dateTime('opening_time');
            $table->dateTime('closing_time')->nullable();
            $table->double('total');
            $table->foreignId('car_in_by_user_id')->constrained('tbl_users');
            $table->foreignId('car_out_by_user_id')->nullable()->constrained('tbl_users');
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
        Schema::dropIfExists('tbl_garage_transactions');
    }
}
