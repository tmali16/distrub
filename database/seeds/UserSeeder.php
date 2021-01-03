<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'=>"admin",
            'name'=>"Администратор",
            'email'=>"admin",
            'password'=>Hash::make("admin123"),
        ]);
    }
}
