<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('password');
            $table->unsignedBigInteger('rmk_id')->nullable();
            $table->string('role', 1);
            $table->string('remember_token')->nullable();

            $table->foreign('rmk_id')
            ->references('id')
            ->on('rmks')
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
