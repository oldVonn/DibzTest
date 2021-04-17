<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGaragePhotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_garage_photos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('width');
            $table->double('height');
            $table->enum('extension',['jpg','png']);
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
        Schema::dropIfExists('tbl_garage_photos');
    }
}
