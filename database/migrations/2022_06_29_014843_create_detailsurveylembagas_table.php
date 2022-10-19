<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsurveylembagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('detailsurveylembagas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surveylembaga_id')->nullable();
            $table->string('nama_santri')->nullable();
            $table->string('tempatlahir_santri')->nullable();
            $table->string('tanggallahir_santri')->nullable();
            $table->string('orangtua_santri')->nullable();
            $table->string('status_orang_tua_santri')->nullable();
            $table->string('phone_orangtua')->nullable();
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
        Schema::dropIfExists('detailsurveylembagas');
    }
}
