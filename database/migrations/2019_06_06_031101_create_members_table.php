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
            $table->string('id_number')->nullable(true)->default(null)->unique()->index();
            $table->string('fullname');
            $table->string('phone_number')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('country_abbr', 4);
            $table->unsignedTinyInteger('state_code');
            $table->unsignedSmallInteger('town_code');
            $table->string('credential_photo');
            $table->string('official_id_photo_back');
            $table->string('official_id_photo_front');
            $table->string('other_official_id_photo');
            $table->unsignedTinyInteger('occupation_code');
            $table->string('occupation')->nullable(true);
            $table->string('member_comment');
            $table->boolean('verified')->default(false);
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
