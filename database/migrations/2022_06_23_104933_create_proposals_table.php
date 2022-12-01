<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('dosen_pembimbing_1_id');
            $table->unsignedBigInteger('dosen_pembimbing_2_id')->nullable();
            $table->unsignedBigInteger('dosen_pembimbing_luar')->nullable();
            $table->unsignedBigInteger('dosen_penguji_1_id')->nullable();
            $table->unsignedBigInteger('dosen_penguji_2_id')->nullable();
            $table->unsignedBigInteger('dosen_penguji_3_id')->nullable();
            $table->unsignedBigInteger('dosen_penguji_4_id')->nullable();
            $table->unsignedBigInteger('rmk_id');
            $table->string('status_soal')->nullable();
            $table->string('judul');
            $table->string('bidang_ilmu');
            $table->text('abstrak');
            $table->text('metodologi');
            $table->string('file');
            $table->string('file_ta')->nullable();
            $table->string('pomits')->nullable();
            $table->string('jurnal')->nullable();
            $table->string('status_pomits')->nullable();
            $table->string('status_jurnal')->nullable();
            $table->string('status');
            $table->string('status_teks')->nullable();
            $table->string('status_revisi_ta')->nullable();
            $table->string('revisi_dosen_pembimbing_1')->nullable();
            $table->string('revisi_dosen_pembimbing_2')->nullable();
            $table->string('revisi_dosen_penguji_1')->nullable();
            $table->string('revisi_dosen_penguji_2')->nullable();
            $table->string('lokasi_sidang_proposal')->nullable();
            $table->string('lokasi_sidang_ta')->nullable();
            $table->string('tanggal_sidang_proposal')->nullable();
            $table->string('tanggal_sidang_ta')->nullable();
            $table->string('created_at');

            $table->foreign('rmk_id')->references('id')->on('rmks')->cascadeOnDelete();
            $table->foreign('mahasiswa_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('dosen_pembimbing_1_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('dosen_pembimbing_2_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('dosen_penguji_1_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('dosen_penguji_2_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('dosen_penguji_3_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('dosen_penguji_4_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposals');
    }
}
