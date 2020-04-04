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
        User::truncate();
        User::create([
            'name' => 'su',
            'email' => 'su@test.com',
            'password' => bcrypt('123123'),
        ]);
        User::create([
            'name' => 'Administrador 1',
            'email' => 'admin1@pldhamexico.org',
            'password' => bcrypt('detp!6C84gIC'),
        ]);
        User::create([
            'name' => 'Administrador 2',
            'email' => 'admin2@pldhamexico.org',
            'password' => bcrypt('vKDa0CA#@qOp'),
        ]);
        User::create([
            'name' => 'Administrador 3',
            'email' => 'admin3@pldhamexico.org',
            'password' => bcrypt('e3CRRx1iD!CL'),
        ]);
        User::create([
            'name' => 'Administrador 4',
            'email' => 'admin4@pldhamexico.org',
            'password' => bcrypt('lHAPh&QFA#!^'),
        ]);
        User::create([
            'name' => 'Administrador 5',
            'email' => 'admin5@pldhamexico.org',
            'password' => bcrypt('i7n^!6Z!nty#'),
        ]);
    }
}
