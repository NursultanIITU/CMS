<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=\App\User::where('email', 'nurs@gmail.com')->first();
        if(!$user)
        {
            \App\User::create([
               'name' =>'Nursultan Serikbay',
               'email' => 'nurs@gmail.com',
               'role'  => 'admin',
               'password' => \Illuminate\Support\Facades\Hash::make('password')
            ]);
        }
    }
}
