<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_role', function (Blueprint $table) {
            $table->unsignedBigInteger('profil_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            $table->foreign('profil_id')->references('id')->on('profils');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profil_role');
    }
}
