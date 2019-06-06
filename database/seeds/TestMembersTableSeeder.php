<?php

use Illuminate\Database\Seeder;

class TestMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Member::class, 15)->create();
    }
}
