<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'su',
            'email' => 'su@test.com',
            'password' => bcrypt('123'),
        ]);
        User::create([
            'name' => 'Administrador 1',
            'email' => 'admin1@pldhamexico.org',
            'password' => bcrypt('Admin2019abc!'),
        ]);
        User::create([
            'name' => 'Administrador 2',
            'email' => 'admin2@pldhamexico.org',
            'password' => bcrypt('Admin2027abc!zn'),
        ]);
        User::create([
            'name' => 'Administrador 3',
            'email' => 'admin3@pldhamexico.org',
            'password' => bcrypt('Admin2020!37b'),
        ]);
        User::create([
            'name' => 'Administrador 4',
            'email' => 'admin4@pldhamexico.org',
            'password' => bcrypt('Admin2018dbca'),
        ]);
        User::create([
            'name' => 'Administrador 5',
            'email' => 'admin5@pldhamexico.org',
            'password' => bcrypt('Admin3892019'),
        ]);
    }
}
