<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('jabatan_id')->nullable();
            $table->string('nama_karyawan')->nullable();
            $table->longText('slug_karyawan')->nullable();
            $table->string('telp_karyawan')->nullable();
            $table->string('tempatlahir_karyawan')->nullable();
            $table->string('tanggallahir_karyawan')->nullable();
            $table->string('alamat_karyawan')->nullable();
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
        Schema::dropIfExists('karyawans');
    }
}
