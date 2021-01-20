<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
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
        $us = [
            [
                'username' => "admin",
                'name' => "Администратор",
                'email' => "admin",
                'password' => Hash::make("admin123"),
            ]
        ];

        $adminRole = config('roles.models.role')::where('slug', '=', 'admin')->first();
        foreach ($us as $v) {
            $u = User::where('username', $v['username'])->first();
            if($u === null){
                $n = User::create($v);
                $n->attachRole(1);
            }
        }
    }
}
