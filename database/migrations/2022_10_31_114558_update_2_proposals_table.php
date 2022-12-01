<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Update2ProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->string('revisi_proposal_dosen_pembimbing_1')->nullable();
            $table->string('revisi_proposal_dosen_pembimbing_2')->nullable();
            $table->string('revisi_proposal_dosen_luar')->nullable();
            $table->string('revisi_proposal_dosen_penguji_1')->nullable();
            $table->string('revisi_proposal_dosen_penguji_2')->nullable();
            $table->string('revisi_dosen_luar')->after('revisi_dosen_pembimbing_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn('revisi_proposal_dosen_pembimbing_1');
            $table->dropColumn('revisi_proposal_dosen_pembimbing_2');
            $table->dropColumn('revisi_proposal_dosen_luar');
            $table->dropColumn('revisi_proposal_dosen_penguji_1');
            $table->dropColumn('revisi_proposal_dosen_penguji_2');
            $table->dropColumn('revisi_dosen_pembimbing_2');
        });
    }
}
