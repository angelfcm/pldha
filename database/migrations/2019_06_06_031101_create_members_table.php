<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('folio')->nullable(true)->default(null)->unique()->index();
            $table->string('fullname')->unique();
            $table->unsignedTinyInteger('ocuppation_code');
            $table->string('country_abbr', 4);
            $table->unsignedTinyInteger('state_code');
            $table->unsignedSmallInteger('town_code');
            $table->string('official_id_photo_back');
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
        Schema::dropIfExists('members');
    }
}
