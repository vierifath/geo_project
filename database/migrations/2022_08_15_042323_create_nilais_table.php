<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mahasiswa_id')->unique();
            $table->unsignedBigInteger('geologi');
            $table->unsignedBigInteger('geofisika_dasar');
            $table->unsignedBigInteger('petrofisika');
            $table->unsignedBigInteger('geofisika_terapan');
            $table->unsignedBigInteger('geofisika_komputasi');
            $table->string('geologi_1')->nullable();
            $table->string('geologi_2')->nullable();
            $table->string('geologi_3')->nullable();
            $table->string('geologi_4')->nullable();
            $table->string('geofisika_dasar_1')->nullable();
            $table->string('geofisika_dasar_2')->nullable();
            $table->string('geofisika_dasar_3')->nullable();
            $table->string('geofisika_dasar_4')->nullable();
            $table->string('petrofisika_1')->nullable();
            $table->string('petrofisika_2')->nullable();
            $table->string('petrofisika_3')->nullable();
            $table->string('petrofisika_4')->nullable();
            $table->string('geofisika_terapan_1')->nullable();
            $table->string('geofisika_terapan_2')->nullable();
            $table->string('geofisika_terapan_3')->nullable();
            $table->string('geofisika_terapan_4')->nullable();
            $table->string('geofisika_komputasi_1')->nullable();
            $table->string('geofisika_komputasi_2')->nullable();
            $table->string('geofisika_komputasi_3')->nullable();
            $table->string('geofisika_komputasi_4')->nullable();
            $table->string('penguasaan_materi_1')->nullable();
            $table->string('penguasaan_materi_2')->nullable();
            $table->string('penguasaan_materi_3')->nullable();
            $table->string('penguasaan_materi_4')->nullable();
            $table->string('cara_komunikasi_1')->nullable();
            $table->string('cara_komunikasi_2')->nullable();
            $table->string('cara_komunikasi_3')->nullable();
            $table->string('cara_komunikasi_4')->nullable();
            $table->string('materi_ppt_1')->nullable();
            $table->string('materi_ppt_2')->nullable();
            $table->string('materi_ppt_3')->nullable();
            $table->string('materi_ppt_4')->nullable();
            $table->string('laporan_1')->nullable();
            $table->string('laporan_2')->nullable();
            $table->string('laporan_3')->nullable();
            $table->string('laporan_4')->nullable();
            $table->string('nilai_pembimbingan_1')->nullable();
            $table->string('nilai_pembimbingan_2')->nullable();

            $table->foreign('mahasiswa_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('geologi')->references('id')->on('soals')->cascadeOnDelete();
            $table->foreign('geofisika_dasar')->references('id')->on('soals')->cascadeOnDelete();
            $table->foreign('petrofisika')->references('id')->on('soals')->cascadeOnDelete();
            $table->foreign('geofisika_terapan')->references('id')->on('soals')->cascadeOnDelete();
            $table->foreign('geofisika_komputasi')->references('id')->on('soals')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilais');
    }
}
