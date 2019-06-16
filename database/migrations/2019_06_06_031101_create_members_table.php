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
            $table->string('fullname')->nullable(true)->default(null);
            $table->string('phone_number')->nullable(true)->default(null);
            $table->string('email')->nullable(true)->default(null);
            $table->string('country_abbr', 4)->nullable(true)->default(null);
            $table->unsignedTinyInteger('state_code')->nullable(true)->default(null);
            $table->unsignedSmallInteger('town_code')->nullable(true)->default(null);
            $table->string('credential_photo')->nullable(true)->default(null);
            $table->string('official_id_photo_back')->nullable(true)->default(null);
            $table->string('official_id_photo_front')->nullable(true)->default(null);
            $table->string('other_official_id_photo')->nullable(true)->default(null);
            $table->unsignedTinyInteger('occupation_code')->nullable(true)->default(null);
            $table->string('occupation')->nullable(true)->default(null);
            $table->string('member_comment')->nullable(true)->default(null);
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
